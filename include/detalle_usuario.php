<?php
include("../class/Usuarios.php");
	
$usuario 	= new Usuarios;
$bd 		= new DB;


$id_usuario = trim(strip_tags($_POST['id_usuario'])); 

$sql = "SELECT * FROM usuarios WHERE id_usuario = ".$id_usuario." AND id_tipo_usuario != 1";


if (($bd->query($sql)) and ($bd->resultCount() > 0))
{
	$row = $bd->fetchObj(); 
	
	
	$tipo	 	= $usuario->tiposUsuario($row->id_tipo_usuario);
	
	$sel_estado	= "selected='selected'";
	
	if($row->activo == 1)
		$opt_estado 	= 	"<option value='1' selected='selected'>Activo</option><option value='0'>Inactivo</option>";
	else
		$opt_estado 	= 	"<option value='1'>Activo</option><option value='0' selected='selected'>Inactivo</option>";
	
	
	
	$a_json = array
						(	
							'id_usuario'	=> htmlentities(stripslashes($row->id_usuario)),
							'tipo_usuario'	=> $tipo,
							'nombre'		=> htmlentities(stripslashes($row->nombre)),
							'correo'		=> htmlentities(stripslashes($row->correo)),
							'telefono'		=> htmlentities(stripslashes($row->telefono)),
							'login'			=> htmlentities(stripslashes($row->usuario)),
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