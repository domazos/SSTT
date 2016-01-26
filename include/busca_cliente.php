<?php

require("../class/mysql.class.php");
$bd = new DB;

$a_json = array();
$a_json_row = array();

$term 	= trim(strip_tags($_GET['term'])); //retrieve the search term that autocomplete sends

$qstring = "SELECT * FROM clientes WHERE ((rut LIKE '%".$term."%') OR (cod_cliente_ex LIKE '%".$term."%') OR (nombre LIKE '%".$term."%'))";

$result = $bd->query($qstring); //query the database for entries containing the term
$cuantos = mysql_num_rows($result);

if ($cuantos > 0)
{
	for($i=0; $i<$cuantos; $i++)
	{
		$row = $bd->fetchObj(); //loop through the retrieved values
		{
			$a_json_row['value'] 	= htmlentities(stripslashes($row->nombre));
			$a_json_row['id']		= htmlentities(stripslashes($row->id_cliente));
			$a_json_row['label']	= htmlentities(stripslashes($row->nombre));
			array_push($a_json, $a_json_row);
		}
	}
	
	$json = json_encode($a_json);
	print $json;
	
}
else echo "No existen resultados";

?>