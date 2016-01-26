<?php

extract($_POST);

require("../class/Contratos.php");

$contrato = new Contratos;

if($contrato->guardaPago($id_contrato_pagar, $boleta_contrato))
	echo "OK";
else
	echo "ERROR";

?>