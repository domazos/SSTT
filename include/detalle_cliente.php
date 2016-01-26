<?php
include("../class/Clientes.php");
	
$cliente 	= new Clientes;
$bd 		= new DB;


$id_cliente = trim(strip_tags($_POST['id_cliente'])); 

$sql = "SELECT * FROM clientes WHERE id_cliente = ".$id_cliente;


if (($bd->query($sql)) and ($bd->resultCount() > 0))
{
	$row = $bd->fetchObj(); 
	
	
	$tipo	 	= $cliente->cargaTipos($row->id_tipo_cliente);
	$regiones	= $cliente->cargaRegiones($row->id_region);
	$comunas	= $cliente->cargaComunas($row->id_region, $row->id_comuna);
	
	$sel_estado	= "selected='selected'";
	
	if($row->activo == 1)
		$opt_estado 	= 	"<option value='1' selected='selected'>Activo</option><option value='0'>Inactivo</option>";
	else
		$opt_estado 	= 	"<option value='1'>Activo</option><option value='0' selected='selected'>Inactivo</option>";
	
	
	
	$a_json = array
						(	
							'id_cliente'	=> htmlentities(stripslashes($row->id_cliente)),
							'region'		=> $regiones,
							'comuna'		=> $comunas,
							'tipo_cliente'	=> $tipo,
							'rut'			=> htmlentities(stripslashes(str_replace("-", "", $row->rut))),
							'cod_cliente'	=> htmlentities(stripslashes($row->cod_cliente_ex)),
							'nombre'		=> htmlentities(stripslashes($row->nombre)),
							'direccion'		=> htmlentities(stripslashes($row->direccion)),
							'correo'		=> htmlentities(stripslashes($row->correo)),
							'contacto'		=> htmlentities(stripslashes($row->contacto)),
							'telefono'		=> htmlentities(stripslashes($row->telefono)),
							'celular'		=> htmlentities(stripslashes($row->celular)),
							'estado'		=> $opt_estado,
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