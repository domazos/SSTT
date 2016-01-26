<?php

require("../class/mysql.class.php");
$bd = new DB;


$sql = $bd->query("SELECT * FROM tiendas WHERE activo = 1");
if($sql)
{
	#echo '<option value="">[Selecciona una Tienda]</option>';
	for($i=0; $i<$bd->resultCount();$i++)
	{
		$tienda = $bd->fetchObj();
	
		echo '<option value="'.$tienda->id_tienda.'">'.utf8_encode($tienda->nombre).'</option>';
	
	}
}
?>