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

$fecha_hoy 		= date("Y-m-d");
$id_contrato 	= $_REQUEST["id"];
$paso			= $_REQUEST["paso"];


#$targetDir 	= dirname(__FILE__).'../uploads/'.$id_contrato.'/'.$paso;

$targetDir 		= $_SERVER["DOCUMENT_ROOT"]."/uploads/".$id_contrato."/".$paso;
#$targetDir 		= "E:\web\sstt\uploads\\".$id_contrato."\\".$paso;

$cleanupTargetDir = true; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds


// Create target dir
if (!file_exists($targetDir)) {
	$oldmask = umask(0);
	mkdir($targetDir, 0777, true);
	umask($oldmask);

}

list($usec, $sec) = explode(' ', microtime());

$seed = (float) $sec + ((float) $usec * 100000);
srand($seed);

$id_rand = rand();



// Get a file name
#if (isset($_REQUEST["name"])) {
#	$fileName = $_REQUEST["name"];
#	$ext = strtolower(pathinfo($_REQUEST["name"], PATHINFO_EXTENSION));
if (!empty($_FILES)) {
	$ext = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
	$fileName = md5($_FILES["file"]["name"].$id_rand).'.'.$ext;

} else {
	$fileName = NULL;
	$ext = NULL;
	die("Error al generar nombre de imagen");
}

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;



// Chunking might be enabled
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

include("../class/mysql.class.php");

$bd = new DB;

if(move_uploaded_file($_FILES['file']['tmp_name'], $filePath))
{
	#crear_thumb($targetDir.$fecha_hoy, $fileName, 100, $ext, $fecha_hoy);
	$oldmask = umask(0);
	chmod($filePath, 0777);
	umask($oldmask);
	switch($ext)
	{
		case "jpg":
			$img = imagecreatefromjpeg($filePath);
			break;
		case "png":
			$img = imagecreatefrompng($filePath);
			break;
	}
	$ancho_imagen 	= imagesx($img);
	$alto_imagen 	= imagesy($img);
	
	$sql = "INSERT INTO imagenes_contrato(id_contrato, nombre, ubicacion, etapa) VALUES(".$id_contrato.", '".$fileName."', '".$targetDir."', '".$paso."')";
	
	if(@$bd->query($sql))
	{
		echo "OK";
	}
	else
	{
		@unlink($filePath);
		echo "ERROR 1.2";
	}
	
}
else
	echo "ERROR 1.1";