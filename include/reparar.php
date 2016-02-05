<?php
include("../class/Contratos.php");
	
$contrato 	= new Contratos;
$bd 		= new DB;

extract($_POST);

$id_contrato = trim(strip_tags($_POST['id_contrato'])); 

$sql = "UPDATE contratos_reparacion SET id_estado = 6 WHERE id_contrato = ".$id_contrato;

$sql_max = "SELECT pp.id_presupuesto FROM presupuesto pp WHERE pp.id_contrato = ".$id_contrato." AND pp.fecha_presupuesto = (SELECT MAX(fecha_presupuesto) FROM presupuesto WHERE id_contrato = ".$id_contrato.")";

if($bd->query($sql_max))
{
	$max = $bd->fetchObj();
	$sql2 = "UPDATE presupuesto SET id_estado_ppto = 10 WHERE id_contrato = ".$id_contrato." AND id_presupuesto = ".$max->id_presupuesto;
}
else
	$sql2 = "UPDATE presupuesto SET id_estado_ppto = 10 WHERE id_contrato = ".$id_contrato;




if(($bd->query($sql)) and ($bd->query($sql2)))
{
	
	session_name('sstt');
	session_start();
	extract($_SESSION);
						
	$contrato->seguimientoContrato($id_contrato, $userid, 6); 
	
	
	$correo = "";
			
	$sql_cliente = "SELECT 	c.id_cliente, d.fecha_inicio
					FROM 	contratos_reparacion c 
					JOIN	diagnostico d ON d.id_contrato = c.id_contrato
					WHERE 	c.id_contrato = ".$id_contrato;
	
	if(($bd->query($sql_cliente)) and ($bd->resultCount() > 0))
	{
		$cliente = $bd->fetchObj();
		$id_cliente = $cliente->id_cliente;
	}
	else
	{
		$cliente = NULL;
		$id_cliente = 0;
	}
	
	if($id_cliente != 0)
	{
		
		$sql_usr = "SELECT nombre, correo FROM clientes WHERE id_cliente = ".$id_cliente;
	
		if(($bd->query($sql_usr)) and ($bd->resultCount() > 0))
		{
			$cl = $bd->fetchObj();
			
			$para 			= array($cl->correo);
			$nombre_desde	= $cl->nombre;
			$asunto_c		= "Comienzo Reparacion Contrato de Trabajo ".$id_contrato;
								
			$cuerpo_c		= "Estimado(a) ".utf8_encode($cl->nombre).": ";
			$cuerpo_c 		.= "<br><br>Junto con saludar, informamos a usted que con fecha <strong>".date('d-m-Y')."</strong> se ha comenzado la reparacion de su contrato de reparacion N&deg;: ".$id_contrato.".";
			$cuerpo_c 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
			$cuerpo_c		.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
			
			
			if($contrato->enviarCorreo($para, $cc = NULL, $nombre_desde, $asunto_c, $cuerpo_c, $adjunto = NULL))
			{
				die("OK");
			}
			else
			{
				die("CORREO");
			}
		}
		else
		{
			die("ERR1");
		}
	}
	else
	{
		die("ERR2");
	}
	
}
else
{
	die("ERROR");
}

?>