<?php

extract($_POST);

require("../class/Contratos.php");

$contrato = new Contratos;

if($contrato->cancelarContrato($id_contrato_cancelar, $respuesta_tipo_cancelar, $observacion_otra_respuesta_cancelar))
	echo "OK";
else
	echo "ERROR";

?>