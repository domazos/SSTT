<?php

extract($_POST);

require("../class/Contratos.php");

$contrato = new Contratos;

if($contrato->finalizarOC($num_oc))
	echo "OK";
else
	echo "ERROR";

?>