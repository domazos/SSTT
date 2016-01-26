<?php

extract($_POST);

require("../class/Contratos.php");

$contrato = new Contratos;


switch ($accion)
{
	case "acepta" 	: 	
						$acepta_ppto = $contrato->aceptaPresupuesto($i, $descuento);
						
						if($acepta_ppto == "OK")
							echo "OK";
						else
							echo "CORREO";
						break;
						
	case "rechaza"	:	
						$rechaza_ppto = $contrato->rechazaPresupuesto($i, $respuesta);
						
						if($rechaza_ppto == "OK")
							echo "OK";
						else
							echo "CORREO";
						break;
						
	default			: 	echo "DEFAULT";
}
?>