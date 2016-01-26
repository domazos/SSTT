<?php

extract($_POST);

require("../class/Clientes.php");

$clientes = new Clientes;


switch ($accion)
{
	case "guardar" 	: 	
						$guarda_cliente = $clientes->guardarCliente($tipo_cliente, $rut_cliente, $cod_cliente, $tienda_cliente, $nombre_cliente, $direccion_cliente, $region_cliente, $comuna_cliente, $correo_cliente, $contacto_cliente, $telefono_cliente, $celular_cliente);
						
						if(!is_null($guarda_cliente))
							echo "OK|".$guarda_cliente;
						else
							echo "ERROR GUARDA CLIENTE|";
						break;
						
	case "editar"	:	
						if($clientes->editarCliente($id_cliente_edit, $tipo_cliente_edit, $rut_cliente_edit, $cod_cliente_edit, 0,  $nombre_cliente_edit, $direccion_cliente_edit, $region_cliente_edit, $comuna_cliente_edit, $correo_cliente_edit, $contacto_cliente_edit, $telefono_cliente_edit, $celular_cliente_edit, $estado_cliente_edit))
							echo "OK";
						else
							echo "ERROR EDITA CLIENTE";
						break;
						
	case "nuevo"	:	$guarda_cliente_nuevo = $clientes->clienteNuevo($tipo_cliente, $rut_cliente, $cod_cliente, $tienda_cliente, $nombre_cliente, $direccion_cliente, $region_cliente, $comuna_cliente, $correo_cliente, $contacto_cliente, $telefono_cliente, $celular_cliente);
						
						if(!is_null($guarda_cliente_nuevo))
							echo "OK|".$guarda_cliente_nuevo;
						else
							echo "ERROR GUARDA CLIENTE NUEVO|";
						break;
						
	default			: 	echo "DEFAULT";
}
?>