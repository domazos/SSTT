<?php

extract($_POST);

require("../class/Contratos.php");

$contrato = new Contratos;


if(isset($garantia))
	$garantia = ($garantia == 'si') ? 1 : 0;
else
	$garantia = 0;
	
if(isset($buscar_iphone))
	$buscar_iphone = ($buscar_iphone == 'si_b') ? 1 : 0;
else
	$buscar_iphone = 0;

if(isset($rayas))
	$rayas = ($rayas == 'on') ? 1 : 0;
else
	$rayas = 0;
	
if(isset($golpes))
	$golpes = ($golpes == 'on') ? 1 : 0;
else
	$golpes = 0;
	
	
if(isset($abolladuras))
	$abolladuras = ($abolladuras == 'on') ? 1 : 0;
else
	$abolladuras = 0;
	
if(isset($marcas))
	$marcas = ($marcas == 'on') ? 1 : 0;
else
	$marcas = 0;
	
if(isset($liquido))
	$liquido = ($liquido == 'on') ? 1 : 0;
else
	$liquido = 0;
	
if(isset($intervenido))
	$intervenido = ($intervenido == 'on') ? 1 : 0;
else
	$intervenido = 0;

if(isset($aplica_garantia))
{
	$aplica_garantia = ($aplica_garantia == 'si_g') ? 1 : 0;

	if($aplica_garantia == 1)
		$estado_ppto = 8; # ACEPTADO POR CLIENTE (GARANTIA)
	else
		$estado_ppto = 2; # INFORMADO
}
else
	$aplica_garantia = 0;


if(isset($fecha_recepcion))
{
	$aux 				= explode(" ", $fecha_recepcion);
	$aux_fecha_r 		= explode("/", $aux[0]);
	$aux_hora_r			= explode(":", $aux[1]);
	
	$fecha_recepcion	= $aux_fecha_r[2]."-".$aux_fecha_r[1]."-".$aux_fecha_r[0]." ".$aux_hora_r[0].":".$aux_hora_r[1];
}

if(isset($fecha_boleta))
{
	$aux_fecha_b 		= explode("/", $fecha_boleta);
	$fecha_boleta		= $aux_fecha_b[2]."-".$aux_fecha_b[1]."-".$aux_fecha_b[0];
}
else if($fecha_boleta == "--")
{
	$fecha_boleta		= "0000-00-00";	
}

if(isset($fecha_diagnostico))
{
	$aux_fecha_d 		= explode("/", $fecha_diagnostico);
	$fecha_diagnostico	= $aux_fecha_d[2]."-".$aux_fecha_d[1]."-".$aux_fecha_d[0];
}

if(isset($fecha_entrega))
{
	$aux_fecha_e 		= explode("/", $fecha_entrega);
	$fecha_entrega		= $aux_fecha_e[2]."-".$aux_fecha_e[1]."-".$aux_fecha_e[0];
}

if(isset($fecha_inicio_d))
{
	$aux 				= explode(" ", $fecha_inicio_d);
	$aux_fecha_d 		= explode("/", $aux[0]);
	$aux_hora_d			= explode(":", $aux[1]);
	
	$fecha_inicio_d		= $aux_fecha_d[2]."-".$aux_fecha_d[1]."-".$aux_fecha_d[0]." ".$aux_hora_d[0].":".$aux_hora_d[1];
}

if(isset($fecha_termino_d))
{
	$aux_fecha_td 		= explode("/", $fecha_termino_d);
	$fecha_termino_d	= $aux_fecha_td[2]."-".$aux_fecha_td[1]."-".$aux_fecha_td[0];
}

if(isset($fecha_ppto))
{
	$aux 				= explode(" ", $fecha_ppto);
	$aux_fecha_p 		= explode("/", $aux[0]);
	$aux_hora_p			= explode(":", $aux[1]);
	
	$fecha_ppto			= $aux_fecha_p[2]."-".$aux_fecha_p[1]."-".$aux_fecha_p[0]." ".$aux_hora_p[0].":".$aux_hora_p[1];
}

if(!isset($num_boleta) or empty($num_boleta))
{
	$num_boleta = 0;
}

# Reviso campos de repuestos

if(isset($cant_filas) and !empty($cant_filas))
{
	for($i=1; $i<=$cant_filas; $i++)
	{
	
		$campo_cod = "cod_repuesto_".$i;
			
		if(!empty($_POST[$campo_cod]))
		{
			$campo_id_p		= "id_".$i;
			$campo_id		= "id_repuesto_".$i;
			$campo_tipo		= "tipo_repuesto_".$i;
			$campo_cant 	= "cant_repuesto_".$i;
			$campo_des	 	= "des_repuesto_".$i;
			$campo_cod 		= "cod_repuesto_".$i;
			$campo_prec		= "unit_repuesto_limpio_".$i;
			$campo_total	= "total_repuesto_limpio_".$i;
			
			$repuestos[]	= array(
														"id"				=> $_POST[$campo_id_p],
														"id_repuesto" 		=> $_POST[$campo_id],
														"tipo_repuesto" 	=> $_POST[$campo_tipo],
														"cod_repuesto"		=> $_POST[$campo_cod],
														"des_repuesto"		=> $_POST[$campo_des],
														"cant_repuesto"		=> $_POST[$campo_cant],
														"prec_repuesto"		=> $_POST[$campo_prec],
														"total_repuesto"	=> $_POST[$campo_total]
													);
		}
	}
}

switch ($accion)
{
	case "guardar" 				: 	$guarda_contrato = $contrato->guardaContrato($familia_contrato, 1, $id_cliente, $tipo_ingreso, $id_tecnico, $fecha_recepcion, $num_serie, $modelo, $descripcion, $garantia, $buscar_iphone, $marca = '0', $falla_cliente, $rayas, $golpes, $abolladuras, $marcas, $liquido, $intervenido, $cod_vendedor = 0, $num_boleta, $fecha_boleta, $fecha_diagnostico, $fecha_entrega);
	
									echo $guarda_contrato;		
						
									break;
						
	case "guardar_diagnostico"	:	$guarda_diagnostico = $contrato->guardaDiagnostico($accion, $id_contrato, $aplica_garantia, $fecha_inicio_d, $fecha_termino_d, $respuesta_tipo, $observacion_otra_respuesta, $diagnostico_cliente, $diagnostico_interno, $num_gsx, $fecha_ppto, $estado_ppto, $observaciones_ppto, $repuestos, $sub_total_limpio, $iva_limpio, $total_final_limpio, $total_pagar_limpio, 0, 0, $id_cliente, $tipo_guardar);
									
									echo $guarda_diagnostico;	
									
									break;
									
	case "editar_diagnostico"	:	$edita_diagnostico = $contrato->guardaDiagnostico($accion, $id_contrato, $aplica_garantia, $fecha_inicio_d, $fecha_termino_d, $respuesta_tipo, $observacion_otra_respuesta, $diagnostico_cliente, $diagnostico_interno, $num_gsx, $fecha_ppto, $estado_ppto, $observaciones_ppto, $repuestos, $sub_total_limpio, $iva_limpio, $total_final_limpio, $total_pagar_limpio, $id_diagnostico, $id_presupuesto, $id_cliente, $tipo_guardar);
									
									echo $edita_diagnostico;
									break;
														
	default			: 	echo "DEFAULT|";
}
?>