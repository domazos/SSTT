<?php

include(dirname(__FILE__) . '/../class/mysql.class.php');

class Usuarios
{
	public function listarUsuarios()
	{
		$bd 	= new DB;
		
		# Se listarán todos los usuarios, excepto los SuperAdmin (para evitar su edición)
		
		if($_SESSION['tipoUser'] == 1)
			$where = " WHERE	u.id_tipo_usuario != 1";
		else
			$where = "";
		
		$sql 	= 	"	SELECT	u.id_usuario, u.nombre, u.correo, u.telefono, u.usuario, u.activo, 
								t.descripcion
						FROM 	usuarios u
						JOIN	tipos_usuario t ON u.id_tipo_usuario = t.id_tipo_usuario
					".$where;
					
		if($bd->query($sql))
		{
			$array_res = array();
			
			$cuantos = $bd->resultCount();
			
			for($i=0; $i<$cuantos; $i++)
			{
				$res = $bd->fetchObj();
				array_push($array_res, $res);
			}

			return $array_res;
		}
		else
			return $bd->get_errors();
		
	}
	
	
	public function cuantosUsuarios()
	{
		$bd = new DB;
		
		if($_SESSION['tipoUser'] == 1)
			$where = " WHERE	id_tipo_usuario != 1";
		else
			$where = "";
			
		$query = $bd->query("SELECT COUNT(*) as cuantos FROM usuarios ".$where);
		
		if(($query))
		{
			$res = $bd->fetchObj();
			return $res->cuantos;
		}
		else
			return $bd->get_errors();
			
	}
	
	
	public function tiposUsuario($seleccionado)
	{
		$bd 	= new DB;
		
		$query 	= $bd->query("SELECT * FROM tipos_usuario WHERE id_tipo_usuario > 1");
		
		$opt 	= "";

		if(($query) and ($bd->resultCount() > 0))
		{
			for($i=0; $i<$bd->resultCount(); $i++)
			{
				$tipos 	= $bd->fetchObj();

				if(($seleccionado != 0) and ($tipos->id_tipo_usuario == $seleccionado))
					$sel = "selected='selected'";
				else
					$sel = "";
					
				$opt 	.= "<option value='".$tipos->id_tipo_usuario."' ".$sel.">".utf8_encode($tipos->descripcion)."</option>";			
			}
		}
		else
			$opt .= "<option value='0'>No existen tipos de usuario disponibles</option>";
			
		return $opt;
		
	}
	
	public function guardarUsuario($tipo, $nombre, $correo, $telefono, $usuario, $pass)
	{
		$bd 	= new DB;
		
		$sql	=	"	INSERT INTO usuarios (id_tipo_usuario, nombre, correo, telefono, usuario, pass, activo)
						VALUES	(".$tipo.", '".addslashes($nombre)."', '".addslashes($correo)."', '".addslashes($telefono)."', '".addslashes($usuario)."', '".md5(addslashes($pass))."', 1)
					"; 	
		
		if($bd->query($sql))
			return true;
		else
			return false;
	}
	
	
	public function editarUsuario($id_usuario, $tipo, $nombre, $correo, $telefono, $usuario, $estado_usr)
	{
		$bd 	= new DB;
		
		$sql	=	"	UPDATE 	usuarios 
						SET 	id_tipo_usuario = ".$tipo.", 
								nombre 		= '".addslashes($nombre)."', 
								correo		= '".addslashes($correo)."', 
								telefono	= '".addslashes($telefono)."', 
								usuario		= '".addslashes($usuario)."', 
								activo		= ".$estado_usr."
						WHERE	id_usuario	= ".$id_usuario; 	

		if($bd->query($sql))
			return true;
		else
			return false;
	}
	
	public function passUsuario($id_usuario, $pass)
	{
		$bd 	= new DB;
		
		$sql	=	"	UPDATE 	usuarios 
						SET 	pass		= '".md5(addslashes($pass))."'
						WHERE	id_usuario	= ".$id_usuario; 	
	
		
		if($bd->query($sql))
			return true;
		else
			return false;
	}
	
	
}

?>