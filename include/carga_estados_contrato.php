<?php

require("../class/mysql.class.php");
$bd = new DB;

extract($_POST);

$where = "";

if($id_estado_actual == 2)
	$where = " WHERE id_estado NOT IN(7,1)";
else if($id_estado_actual == 1)
	$where = " WHERE id_estado NOT IN(7)";
else if(($id_estado_actual == 3) or ($id_estado_actual == 4))
	$where = " WHERE id_estado NOT IN(7,1,2)";
else if(($id_estado_actual == 9))
	$where = " WHERE id_estado NOT IN(7,1,2,3,4)";
else
	$where = "";

$sql = $bd->query("SELECT * FROM estados_contrato ".$where);
if($sql)
{
	#echo '<option value="">[Selecciona un Estado]</option>';
	for($i=0; $i<$bd->resultCount();$i++)
	{
		$estado = $bd->fetchObj();
	
		echo '<option value="'.$estado->id_estado.'">'.utf8_encode($estado->descripcion).'</option>';
	
	}
}
?>