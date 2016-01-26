<?php
if($_SERVER['REQUEST_URI'] != '/gestion_contratos.php')
	include(dirname(__FILE__) . '/../class/mysql.class.php');

class Clientes
{
	public function listarClientes()
	{
		$bd 	= new DB;
		
		$sql 	= 	"	SELECT		cl.id_cliente, cl.nombre, cl.direccion, cl.correo, cl.contacto, cl.telefono, cl.celular, DATE_FORMAT(cl.fecha_creacion, '%d-%m-%Y') fecha_creacion, 
									DATE_FORMAT(cl.fecha_modificacion, '%d-%m-%Y') fecha_modificacion, cl.activo, cl.id_tipo_cliente
						FROM 		clientes cl
						LEFT JOIN	regiones r 	ON cl.id_region = r.id_region 
						LEFT JOIN	comunas c	ON cl.id_comuna = c.id_comuna
					";
					
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
	
	
	public function cuantosClientes()
	{
		$bd = new DB;
		
		$query = $bd->query("SELECT COUNT(*) as cuantos FROM clientes");
		
		if(($query))
		{
			$res = $bd->fetchObj();
			return $res->cuantos;
		}
		else
			return $bd->get_errors();
			
	}
	
	public function cargaTipos($seleccionado)
	{
		$bd = new DB;
		
		$sql = $bd->query("SELECT * FROM tipos_clientes");	
		
		if($sql)
		{			
			$cuantos = $bd->resultCount();
			
			#$options = '<option value="">[Selecciona un Tipo]</option>';
			$options = "";
			
			for($i=0; $i<$cuantos; $i++)
			{
				$res = $bd->fetchObj();
				
				if(($seleccionado != 0) and ($res->id_tipo_cliente == $seleccionado))
					$sel = "selected='selected'";
				else
					$sel = "";
				
				$options .= '<option value="'.$res->id_tipo_cliente.'"'.$sel.'>'.utf8_encode($res->descripcion).'</option>';
			}

			return $options;
		}
		else
			return $bd->get_errors();
	}

	
	public function cargaRegiones($seleccionado)
	{
		$bd = new DB;
		
		$sql = $bd->query("SELECT * FROM regiones WHERE activo = 1");	
		
		if($sql)
		{			
			$cuantos = $bd->resultCount();
			
			#$options = '<option value="">[Selecciona una Regi&oacute;n]</option>';
			$options = '';
			
			for($i=0; $i<$cuantos; $i++)
			{
				$res = $bd->fetchObj();
				
				if(($seleccionado != 0) and ($res->id_region == $seleccionado))
					$sel = "selected='selected'";
				else
					$sel = "";
				
				$options .= '<option value="'.$res->id_region.'" '.$sel.'>'.utf8_encode($res->nombre).'</option>';
			}

			return $options;
		}
		else
			return $bd->get_errors();
	}
	
	
	public function cargaComunas($id_region, $seleccionado)
	{
		$bd = new DB;
		
		$sql = $bd->query("SELECT id_comuna, nombre FROM comunas WHERE id_region = ".$id_region);	
		
		if($sql)
		{			
			$cuantos = $bd->resultCount();
			
			#$options = '<option value="">[Selecciona una Comuna]</option>';
			$options = '';
			
			for($i=0; $i<$cuantos; $i++)
			{
				$res = $bd->fetchObj();
				
				if(($seleccionado != 0) and ($res->id_comuna == $seleccionado))
					$sel = "selected='selected'";
				else
					$sel = "";
				
				$options .= '<option value="'.$res->id_comuna.'" '.$sel.'>'.utf8_encode($res->nombre).'</option>';
			}

			return $options;
		}
		else
			return $bd->get_errors();
	}
	
	
	public function guardarCliente($tipo_cliente, $rut_cliente, $cod_cliente, $id_tienda, $nombre_cliente, $direccion_cliente, $region_cliente, $comuna_cliente, $correo_cliente, $contacto_cliente, $telefono_cliente, $celular_cliente)
	{
		$bd 	= new DB;
		
		$contacto_cliente	= (empty($contacto_cliente)) ? "" : $contacto_cliente;
		$telefono_cliente 	= (empty($telefono_cliente)) ? "" : $telefono_cliente;
		$id_tienda 			= (empty($id_tienda)) ? 0 : $id_tienda;
		
		$sql	=	"	INSERT INTO clientes (id_region, id_comuna, id_tipo_cliente, id_tienda, rut, cod_cliente_ex, nombre, direccion, correo, contacto, telefono, celular, fecha_creacion, fecha_modificacion, activo)
						VALUES	(".$region_cliente.", ".$comuna_cliente.", ".$tipo_cliente.", ".$id_tienda.", '".str_replace(".", "", $rut_cliente)."', ".$cod_cliente.", '".addslashes($nombre_cliente)."', '".addslashes($direccion_cliente)."',
								 '".addslashes($correo_cliente)."', '".addslashes($contacto_cliente)."', '".$telefono_cliente."', '".$celular_cliente."', '".date("Y-m-d H:i:s")."', 
								 '".date("Y-m-d H:i:s")."', 1
								 )
					"; 	

		if($bd->query($sql))
			return $bd->fetchLastInsertId();
		else
			return NULL;
	}
	
	
	public function editarCliente($id_cliente, $tipo_cliente, $rut_cliente, $cod_cliente, $id_tienda, $nombre_cliente, $direccion_cliente, $region_cliente, $comuna_cliente, $correo_cliente, $contacto_cliente, $telefono_cliente, $celular_cliente, $estado_cliente)
	{
		$bd 	= new DB;
		
		$sql	=	"	UPDATE 	clientes
						SET 	id_region 			= ".$region_cliente.", 
								id_comuna			= ".$comuna_cliente.", 
								id_tipo_cliente		= ".$tipo_cliente.", 
								id_tienda			= ".$id_tienda.",
								rut					= '".str_replace(".", "", $rut_cliente)."', 
								cod_cliente_ex		= ".$cod_cliente.",
								nombre				= '".addslashes($nombre_cliente)."', 
								direccion			= '".addslashes($direccion_cliente)."',
								correo				= '".addslashes($correo_cliente)."', 
								contacto			= '".addslashes($contacto_cliente)."', 
								telefono			= '".$telefono_cliente."', 
								celular				= '".$celular_cliente."', 
								fecha_modificacion	= '".date("Y-m-d H:i:s")."',
								activo				= ".$estado_cliente."
						WHERE	id_cliente			= ".$id_cliente; 	
		
		if($bd->query($sql))
			return true;
		else
			return false;
	}
	
	public function clienteNuevo($tipo_cliente, $rut_cliente, $cod_cliente, $id_tienda, $nombre_cliente, $direccion_cliente, $region_cliente, $comuna_cliente, $correo_cliente, $contacto_cliente, $telefono_cliente, $celular_cliente)
	{
		$bd 	= new DB;
		
		$sql	=	"
						SELECT	id_cliente 
						FROM	clientes 
						WHERE
								id_region 			= ".$region_cliente." AND  
								id_comuna			= ".$comuna_cliente." AND 
								id_tipo_cliente		= ".$tipo_cliente." AND 
								id_tienda			= ".$id_tienda." AND 
								rut					= '".str_replace(".", "", $rut_cliente)."' AND 
								cod_cliente_ex		= ".$cod_cliente." AND 
								nombre				= '".addslashes($nombre_cliente)."' AND 
								direccion			= '".addslashes($direccion_cliente)."' AND 
								correo				= '".addslashes($correo_cliente)."' AND 
								contacto			= '".addslashes($contacto_cliente)."' AND 
								telefono			= '".$telefono_cliente."' AND 
								celular				= '".$celular_cliente."' 
					"; 	
		
		if($bd->query($sql))
		{
			if($bd->resultCount() > 0)
			{
				# Encuentro un cliente igual, devuelvo el id
				$cliente = $bd->fetchObj();
				
				return	$cliente->id_cliente;
				
			}
			else
			{
				# No encuentro cliente igual, lo guardo
				return $this->guardarCliente($tipo_cliente, $rut_cliente, $cod_cliente, $tienda_cliente, $nombre_cliente, $direccion_cliente, $region_cliente, $comuna_cliente, $correo_cliente, $contacto_cliente, $telefono_cliente, $celular_cliente);
				
			}
		}
			
		else
			return NULL;
	}
	
}
?>