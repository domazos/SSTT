<?php

require("../class/mysql.class.php");
$bd = new DB;

extract($_POST);

$sql = $bd->query("SELECT * FROM comunas WHERE id_region = ".$id_region." ORDER BY nombre");
if($sql)
{
	#echo '<option value="">[Selecciona una Comuna]</option>';
	for($i=0; $i<$bd->resultCount();$i++)
	{
		$comuna = $bd->fetchObj();
	
		echo '<option value="'.$comuna->id_comuna.'">'.utf8_encode($comuna->nombre).'</option>';
	
	}
}
?>