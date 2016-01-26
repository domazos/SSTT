<?php

require_once("../class/mysql.class.php");
$bd = new DB;

$id_contrato 	= trim(strip_tags($_POST['id_contrato'])); 
$etapa			= trim(strip_tags($_POST['etapa']));

$sql = "SELECT * FROM imagenes_contrato WHERE id_contrato = ".$id_contrato." AND etapa = '".$etapa."'";


if (($bd->query($sql)) and ($bd->resultCount() > 0))
{
	
	#$img_table 	= '<table>';
	$ruta 		= '/uploads/'.$id_contrato.'/'.$etapa;
	$img_table = "";
	
	for($i=0; $i<$bd->resultCount(); $i++)
	{
		$img = $bd->fetchObj();
	
		#$img_table	.= 	'<tr>';
		$img_table	.= 	'
							<a href="'.$ruta.'/'.$img->nombre.'" title="" class="fancybox" rel="gallery">
								<img src="'.$ruta.'/'.$img->nombre.'" width="50" heigth="50">
							</a>
						';
		#$img_table	.= 	'</tr>';
	}
	
	#$img_table	.= 	'</table>';
	
	echo $img_table;	
	
}
else 
	echo "NO";
?>