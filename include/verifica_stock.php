<?php

require("../class/mysql.class.php");
$bd = new DB;


$codigo 	= trim(strip_tags($_POST['codigo'])); 
$cantidad	= trim(strip_tags($_POST['cantidad']));


$qstring = "SELECT stock FROM repuestos WHERE codigo_repuesto = '".$codigo."'";

$result = $bd->query($qstring); 
$cuantos = mysql_num_rows($result);

if ($cuantos > 0)
{
	$row = $bd->fetchObj(); 
	
	$stock_total = $row->stock;
	
	if($stock_total <= 0)
		echo "NO";
	else if($cantidad > $stock_total)
		echo "MAYOR";
	else
		echo "OK";
	
}
else echo "No existen resultados";

?>