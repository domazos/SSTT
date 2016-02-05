<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/mysql.class.php");	
	
			
	$archivo 		= $_POST['file'];
	$ubicacion 		= $_POST['path'];
	$fecha			= $_POST['fecha'];
	$hoy			= date("Y-m-d H:i:s");
	
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Excel/reader.php");
	
	$data 			= new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('CP1251');
	
	$bd				= new DB;
	$bd->connect();
			
				
	$ruta 			= $_SERVER['DOCUMENT_ROOT'] . "/uploads/repuestos/".$fecha;
		
	$data->read($ruta."/".$archivo);
	
	# Restamos 1, para no considerar la cabecera del excel
	
	$cuantos_excel 	= (int)$data->sheets[0]['numRows'] - 1;
	

	for ($i = 1; $i <= 1; $i++) 
	{
				
		if( (trim($data->sheets[0]['cells'][$i][1]) != "Part Number") or 
			(trim($data->sheets[0]['cells'][$i][2]) != "Part Description") or
			(trim($data->sheets[0]['cells'][$i][3]) != "PDistb") or
			(trim($data->sheets[0]['cells'][$i][4]) != "PCore"))
		{
			
			if(unlink($ruta."/".$archivo))	
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
	
	# Si el contador actualizados + insertados = cantidad total registros excel y error = 0, se procesaron todos los registros correctamente
	
	if((($actualizados + $insertados) == $cuantos_excel) and ($error == 0))
	{
		# Hago el COMMIT
		
		mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
		
		session_name('sstt');
		session_start();
		extract($_SESSION);
		
		$sqlInsertFile	= "INSERT INTO archivos_cargados (id_usuario, fecha, ruta) VALUES (".$userid.", '".$hoy."', '/uploads/repuestos/".$fecha."/".$archivo."')";
					
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
	
		
?>