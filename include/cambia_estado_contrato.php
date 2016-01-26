<?php

extract($_POST);

require("../class/Contratos.php");

$contrato = new Contratos;

if($contrato->cambiaEstado($id_contrato_estado, $estado_nuevo))
	echo "OK";
else
	echo "ERROR";

?>