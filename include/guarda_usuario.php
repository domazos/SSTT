<?php

extract($_POST);

require("../class/Usuarios.php");

$usuarios = new Usuarios;


switch ($accion)
{
	case "guardar" 	: 	if($usuarios->guardarUsuario($tipo_usuario, $nombre_usuario, $correo_usuario, $telefono_usuario, $login_usuario, $pass_usuario))
							echo "OK";
						else
							echo "ERROR GUARDA USUARIO";
						break;
						
	case "editar"	:	if($usuarios->editarUsuario($id_usuario_edit, $tipo_usuario_edit, $nombre_usuario_edit, $correo_usuario_edit, $telefono_usuario_edit, $login_usuario_edit, $estado_usuario_edit))
							echo "OK";
						else
							echo "ERROR EDITA USUARIO";
						break;
						
	case "pass" 	: 	if($usuarios->passUsuario($id_usuario_pass, $pass_usuario_p))
							echo "OK";
						else
							echo "ERROR PASS USUARIO";
						break;
						
	default			: 	echo "DEFAULT";
}
?>