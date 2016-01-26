<?php

require("../class/mysql.class.php");
$bd = new DB;

$a_json = array();
$a_json_row = array();

$term 	= trim(strip_tags($_GET['term'])); //retrieve the search term that autocomplete sends

$qstring = "SELECT * FROM repuestos WHERE ((codigo_repuesto LIKE '%".$term."%') OR (descripcion_repuesto LIKE '%".$term."%'))";

$result = $bd->query($qstring); //query the database for entries containing the term
$cuantos = mysql_num_rows($result);

if ($cuantos > 0)
{
	for($i=0; $i<$cuantos; $i++)
	{
		$row = $bd->fetchObj(); //loop through the retrieved values
		{
			$a_json_row['value'] 	= htmlentities(stripslashes($row->descripcion_repuesto));
			$a_json_row['id']		= htmlentities(stripslashes($row->id_repuesto));
			$a_json_row['label']	= htmlentities(stripslashes($row->codigo_repuesto." - ".$row->descripcion_repuesto));
			array_push($a_json, $a_json_row);
		}
	}
	
	$json = json_encode($a_json);
	print $json;
	
}
else echo "No existen resultados";

?>