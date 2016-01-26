<?php

include("class/Contratos.php");

$contrato = new Contratos;

$para 			= array("jdomazos@reif.cl", "domazos@gmail.com");

$asunto			= "Test de correo";

$nombre_desde	= "Jorge Domazos";
$cuerpo 		= "Hola, esto es una prueba.";

$cuerpo			.= "<br>Probando el env&iacute;o de <strong>correo html</strong>";

if($contrato->enviarCorreo($para, $cc = NULL, $nombre_desde, $asunto, $cuerpo, $adjunto = NULL))
	echo "OK";
else
	echo "NO";


#echo DIRECTORY_SEPARATOR;

?>