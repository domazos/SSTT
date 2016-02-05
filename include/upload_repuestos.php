<?php
/**
 * upload.php
 *
 * Copyright 2013, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */

#!! IMPORTANT: 
#!! this file is just an example, it doesn't incorporate any security checks and 
#!! is not recommended to be used in production environment as it is. Be sure to 
#!! revise it and customize to your needs.


// Make sure file is not cached (as it happens for example on iOS devices)
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");



/* 
// Support CORS
header("Access-Control-Allow-Origin: *");
// other CORS headers if any...
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	exit; // finish preflight CORS requests here
}
*/

// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Settings
#$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";

$fecha_hoy = date("d-m-Y");

$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/repuestos/';


$cleanupTargetDir = true; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds


// Create target dir
if (!file_exists($targetDir.$fecha_hoy)) {
	$oldmask = umask(0);
	@mkdir($targetDir.$fecha_hoy, 0777);
	umask($oldmask);

}

// Get a file name
#if (isset($_REQUEST["name"])) {
#	$fileName = $_REQUEST["name"];
#	$ext = strtolower(pathinfo($_REQUEST["name"], PATHINFO_EXTENSION));


include("../class/mysql.class.php");

$bd = new DB;

if (!empty($_FILES)) {
	
	$fileName = $_FILES["file"]["name"];
	#$fileName = md5($_FILES["file"]["name"].mt_rand()).'.'.$ext;
	 
	
} else {
	$fileName = NULL;
	$ext = NULL;
}

$filePath = $targetDir . $fecha_hoy . DIRECTORY_SEPARATOR . $fileName;


		if(move_uploaded_file($_FILES['file']['tmp_name'], $filePath))
		{
			#crear_thumb($targetDir.$fecha_hoy, $fileName, 100, $ext, $fecha_hoy);
			$oldmask = umask(0);
			chmod($filePath, 0777);
			umask($oldmask);
			
			
			
			require_once($_SERVER['DOCUMENT_ROOT'] . "/Excel/reader.php");
	
			$data 			= new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('CP1251');
			
			$bd				= new DB;
			$bd->connect();
					
			
					
			$ruta 			= $_SERVER['DOCUMENT_ROOT'] . "/uploads/repuestos/".$fecha_hoy;
				
			$data->read($ruta."/".$fileName);
			
			# Restamos 1, para no considerar la cabecera del excel
			
			$cuantos_excel 	= (int)$data->sheets[0]['numRows'] - 1;
			
		
			for ($i = 1; $i <= 1; $i++) 
			{
						
				if( (trim($data->sheets[0]['cells'][$i][1]) != "Part Number") or 
					(trim($data->sheets[0]['cells'][$i][2]) != "Part Description") or
					(trim($data->sheets[0]['cells'][$i][3]) != "PDistb") or
					(trim($data->sheets[0]['cells'][$i][4]) != "PCore"))
				{
					
					if(unlink($ruta."/".$fileName))	
					{
						echo 99;
						die;
					}
					
				}
		
			
			}
			
			
			
			$insertados 	= 0;
			$actualizados	= 0;
			$error			= 0;
			$mensaje		= "";
			
			# Comienzo una transacción. Para deshabilitar el modo de Autocommit. Si todo está OK inserto o modifico (commit), sino se hace un Rollback.
			mysql_query("START TRANSACTION;") or die ("Error Start_Transaction: ".mysql_error());
			
			for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) 
			{
						
				$part_number 		= addslashes(trim($data->sheets[0]['cells'][$i][1]));
				$part_description	= addslashes(trim($data->sheets[0]['cells'][$i][2]));
				$pdistb				= ((int)$data->sheets[0]['cells'][$i][3] != "") ? (int)$data->sheets[0]['cells'][$i][3] : 0;		
				$pcore				= ((int)$data->sheets[0]['cells'][$i][4] != "") ? (int)$data->sheets[0]['cells'][$i][4] : 0;				
				
				
				if($part_number != "")
				{
				
					# Consulto si el repuesto ya existe en la base de datos. Si existe, lo actualizo. Sino lo agrego.
					
					$sqlConsulta	= mysql_query("SELECT * FROM repuestos WHERE codigo_repuesto = '".$part_number."'") or die ("Error consulta repuesto: ".mysql_error());
					
					if($sqlConsulta)
					{
							$res_rep 	= mysql_fetch_object($sqlConsulta);
							$cuantos	= mysql_num_rows($sqlConsulta);
							
							if($cuantos > 0)
							{		
								# Actualizo la información del repuesto encontrado
							
								$sqlActualizo 	= mysql_query("UPDATE repuestos SET descripcion_repuesto = '".$part_description."', precio_venta = ".$pdistb.", precio_core = ".$pcore." WHERE id_repuesto = ".$res_rep->id_repuesto);
								
								if($sqlActualizo)
									$actualizados++;
								else
									$actualizados--;
							}
							else
							{
								# Inserto el nuevo repuesto
								
								$sqlInserto		= mysql_query("	INSERT INTO repuestos (codigo_repuesto, descripcion_repuesto, precio_venta, precio_core) 
																VALUES ('".$part_number."', '".$part_description."', ".$pdistb.", ".$pcore.")");
								
								if($sqlInserto)
									$insertados++;
								else
									$insertados--;
									
							}
							
					}
					else
						$error++;
				}
				else
					$insertados++;
				
			}
			
			# Si el contador actualizados + insertados = cantidad total registros excel y error = 0, se procesaron todos los registros correctamente
			
			if((($actualizados + $insertados) == $cuantos_excel) and ($error == 0))
			{
				# Hago el COMMIT
				
				mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
				
				session_name('sstt');
				session_start();
				extract($_SESSION);
				
				$sqlInsertFile	= "INSERT INTO archivos_cargados (id_usuario, fecha, ruta) VALUES (".$userid.", '".date('Y-m-d H:i:s')."', '/uploads/repuestos/".$fecha."/".$fileName."')";
							
				$bd->query($sqlInsertFile);
				
				$mensaje = "OK";
			}
			else
			{
				# Hago el ROLLBACK
				
				mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
				
				$mensaje = "ERROR";
			}
			
			
			echo $mensaje;
			
			
			
		}
		else
			echo "<span class=\"server_resp\">Aviso: No se pudo mover el fichero ".$fileName." al destino</span><br>";