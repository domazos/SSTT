<?php

require("../class/Contratos.php");

$contrato 	= new Contratos;

extract($_POST);

date_default_timezone_set('America/Santiago');


$feriados	= $contrato->listarFeriados();

$hoy 		= date('Y-m-j');


$startDate	= $contrato->add_business_days($hoy, 2, $feriados, 'Y-m-j');
$fecha_fin	= $contrato->add_business_days($startDate, $dias, $feriados, 'Y-m-j');

echo date("Y-m-j", strtotime($fecha_fin));
?>