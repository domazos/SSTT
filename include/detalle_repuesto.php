<?php

require_once("../class/mysql.class.php");
$bd = new DB;

$id_repuesto = trim(strip_tags($_POST['id_repuesto'])); 

$sql = "SELECT * FROM repuestos WHERE id_repuesto = ".$id_repuesto;


if (($bd->query($sql)) and ($bd->resultCount() > 0))
{
	$row = $bd->fetchObj(); 
	
	$a_json = array
						(	
							'id_repuesto'			=> htmlentities(stripslashes($row->id_repuesto)),
							'tipo_repuesto'			=> htmlentities(stripslashes($row->tipo_repuesto)),
							'codigo_repuesto'		=> htmlentities(stripslashes(utf8_encode($row->codigo_repuesto))),
							'descripcion_repuesto'	=> htmlentities(stripslashes(utf8_encode($row->descripcion_repuesto))),
							'precio_repuesto'		=> htmlentities(stripslashes($row->precio_venta)),
							'resultado'		=> htmlentities(stripslashes('OK'))
						);

	
	$json = json_encode($a_json);
	echo $json;
	
}
else 
{
	$a_json = array(
						'error' 	=> htmlentities(stripslashes("No existen resultados")),
						'resultado'	=> htmlentities(stripslashes('ERROR'))	
					);
	
	$json = json_encode($a_json);
	echo $json;
}

?>