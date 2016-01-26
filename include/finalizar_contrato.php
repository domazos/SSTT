<?php

extract($_POST);

require("../class/Contratos.php");

$contrato = new Contratos;

if($contrato->finalizarContrato($id_contrato_fin, $respuesta_tipo_final, $observacion_otra_respuesta_fin))
	echo "OK";
else
	echo "ERROR";

?>