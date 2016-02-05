<?php

extract($_POST);

include("../class/Contratos.php");
	
$contrato 	= new Contratos;
$bd 		= new DB;

# Recupero información para enviar correo a técnico
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
		
		$sql_param		= "SELECT link_vb FROM parametros";
		if(($bd->query($sql_param)) and ($bd->resultCount() > 0))
		{
			$param 		= $bd->fetchObj();	
			$link_vb	= $param->link_vb."?i=".base64_encode($id_contrato);
		}
		else
		{
			$param 		= NULL;
			$link_vb 	= '[Problema al generar el link, favor solicitelo en nuestro Call Center]';
		}
		
		
		$para 			= array($cl->correo);
		$nombre_desde	= $cl->nombre;
		$asunto_c		= "Diagnostico Contrato de Trabajo ".$id_contrato;
							
		$cuerpo_c		= "Estimado(a) ".utf8_encode($cl->nombre).": ";
		$cuerpo_c 		.= "<br><br>Junto con saludar, informamos a usted que con fecha <strong>".date('d-m-Y', strtotime($cliente->fecha_inicio))."</strong> se ha realizado el diagnostico y presupuesto de su contrato de reparacion N&deg;: ".$id_contrato.".";
		$cuerpo_c		.= "<br>Le solicitamos revisarlo y si esta de acuerdo, confirmar el presupuesto para que nuestros tecnicos puedan proceder con la reparacion.";
		$cuerpo_c 		.= "<br><br>Puede revisar el detalle del diagnostico y presupuesto en el siguiente link: ". $link_vb;
		$cuerpo_c 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
		$cuerpo_c		.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
		
		
		if($contrato->enviarCorreo($para, $cc = NULL, $nombre_desde, $asunto_c, $cuerpo_c, $adjunto = NULL))
		{
			$sql_cont	=	"UPDATE contratos_reparacion SET id_estado = 2 WHERE id_contrato = ".$id_contrato;
			if($bd->query($sql_cont))
			{
				$correo 	= "OK";
				
				session_name('sstt');
				session_start();
				extract($_SESSION);
									
				$contrato->seguimientoContrato($id_contrato, $userid, 2);
			}
			else
				echo "ERROR_ENV";
		}
		else
			$correo		= "NO1";
	}
	else
		$correo = "NO2";
}
else
	$correo = "NO3";

#echo $correo;

if($correo == "OK")
	echo "OK";
else
	echo "ERROR";

?>