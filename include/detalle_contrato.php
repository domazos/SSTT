<?php
include("../class/Contratos.php");
	
$contrato 	= new Contratos;
$bd 		= new DB;

extract($_POST);

$id_contrato = trim(strip_tags($_POST['id_contrato'])); 


		$sql_ppto = "SELECT id_presupuesto FROM presupuesto WHERE id_contrato = ".$id_contrato;

		if(($bd->query($sql_ppto)) and ($bd->resultCount() > 1))
			#$and_sql = 'AND p.id_estado_ppto != 4 AND d.fecha_inicio = (SELECT MAX(dd.fecha_inicio) FROM diagnostico dd WHERE dd.id_contrato = '.$id_contrato.')';
			$and_sql = "AND p.id_estado_ppto != 4 AND d.id_diagnostico = (SELECT dd.id_diagnostico FROM diagnostico dd WHERE dd.id_contrato = ".$id_contrato." AND dd.fecha_inicio = (SELECT MAX(fecha_inicio) FROM diagnostico WHERE id_contrato = ".$id_contrato.")) AND p.id_presupuesto = (SELECT pp.id_presupuesto FROM presupuesto pp WHERE pp.id_contrato = ".$id_contrato." AND pp.fecha_presupuesto = (SELECT MAX(fecha_presupuesto) FROM presupuesto WHERE id_contrato = ".$id_contrato."))";
			
		else
			$and_sql = '';
			


	$sql = "	SELECT 	c.id_contrato, c.id_cliente, c.num_serie, c.modelo, c.descripcion, c.falla_cliente, c.id_tipo_contrato, DATE_FORMAT(c.fecha_recepcion, '%d-%m-%Y %H:%i') as fecha_recepcion,
						c.id_familia, c.garantia, c.buscar_iphone, c.marca, c.falla_cliente, c.rayas, c.golpes, c.abolladuras, c.marcas, c.liquido, c.intervenido, c.cod_vendedor, c.num_boleta,
						DATE_FORMAT(c.fecha_boleta, '%d-%m-%Y') AS fecha_boleta, DATE_FORMAT(c.fecha_tent_diagnostico, '%d-%m-%Y') AS fecha_tent_diagnostico, 
						DATE_FORMAT(c.fecha_tent_entrega, '%d-%m-%Y') AS fecha_tent_entrega, 
						cl.nombre, cl.telefono, cl.correo, cl.direccion, cl.id_tipo_cliente, cl.cod_cliente_ex, cl.id_tienda, cl.rut, cl.contacto, cl.celular, cl.id_region, cl.id_comuna, 
						d.id_diagnostico, d.aplica_garantia, d.fecha_inicio, d.fecha_termino, d.id_respuesta, d.otra_respuesta, 
						d.diagnostico_cliente, d.diagnostico_interno, d.num_gsx,
						p.id_presupuesto, p.fecha_presupuesto, p.id_estado_ppto, p.observaciones, p.sub_total, p.iva, p.total, p.total_pagar,
						u.nombre as tecnico_asignado, u.id_usuario, e.descripcion as estado_contrato, p.num_boleta as boleta_ppto, 
						c.id_estado as id_estado_contrato, c.observacion_final, 
						DATE_FORMAT(c.fecha_respuesta_final, '%d-%m-%Y') as fecha_respuesta_final, c.id_respuesta as id_respuesta_fin, 
						c.otra_respuesta as otra_respuesta_fin, p.id_respuesta_rechazo, rt.respuesta as respuesta_rechazo,
						p.sub_total_c, p.iva_c, p.total_c, p.total_pagar_c, p.rebaja_apple 
				FROM 	contratos_reparacion c 
				LEFT JOIN	clientes cl ON c.id_cliente = cl.id_cliente
				LEFT JOIN	diagnostico d ON d.id_contrato = c.id_contrato
				LEFT JOIN	presupuesto p ON p.id_contrato = c.id_contrato
				LEFT JOIN	usuarios	u ON u.id_usuario = c.id_usuario 
				LEFT JOIN	estados_contrato e ON e.id_estado = c.id_estado 
				LEFT JOIN	respuestas_tipo_rechazo rt ON rt.id_respuesta = p.id_respuesta_rechazo
				WHERE 	c.id_contrato = ".$id_contrato." ".$and_sql;


	if (($bd->query($sql)) and ($bd->resultCount() > 0))
	{
		$row = $bd->fetchObj(); 
		
		
		$sql_repuestos = "	
							SELECT 	p.id, p.id_repuesto, p.cod_repuesto, p.des_repuesto, p.precio_repuesto, p.cant_repuesto, p.tipo_repuesto, p.precio_core 
							FROM 	presupuesto_repuestos p 
							WHERE 	p.id_presupuesto = ".$row->id_presupuesto;
		
		if (($bd->query($sql_repuestos)) and ($bd->resultCount() > 0))
		{
			$cuantos_repuestos = $bd->resultCount();
			
			for($i=0; $i<$cuantos_repuestos; $i++)
			{
				$rep = $bd->fetchObj();	
				
				
				// Precio total por cada repuesto ingresado
				$total_repuesto_core	= (int) (((($rep->precio_repuesto * 0.7) - $rep->precio_core) / 0.7) * $rep->cant_repuesto);
				
				$repuestos[]	= array(
														"id"				=> $rep->id,
														"id_repuesto" 		=> $rep->id_repuesto,
														"tipo_repuesto" 	=> $rep->tipo_repuesto,
														"cod_repuesto"		=> $rep->cod_repuesto,
														"des_repuesto"		=> $rep->des_repuesto,
														"prec_repuesto"		=> $rep->precio_repuesto,
														"cant_repuesto"		=> $rep->cant_repuesto,
														"total_repuesto"	=> ($rep->cant_repuesto * $rep->precio_repuesto),
														"core_repuesto"		=> $rep->precio_core,
														#"total_core"		=> ($rep->cant_repuesto * $rep->precio_core)
														"total_core"		=> $total_repuesto_core
													);
			}
				
		}
		else
		{
			$cuantos_repuestos = 0;
			$repuestos = array();
		}
		
		
		$a_json = array
							(	
								'id_contrato'		=> html_entity_decode(stripslashes($row->id_contrato)),
								'id_cliente'		=> html_entity_decode(stripslashes($row->id_cliente)),
								'num_serie'			=> html_entity_decode(stripslashes($row->num_serie)),
								'modelo'			=> html_entity_decode(stripslashes($row->modelo)),
								'descripcion'		=> html_entity_decode(stripslashes($row->descripcion)),
								'falla_cliente'		=> html_entity_decode(stripslashes($row->falla_cliente)),
								'nombre'			=> html_entity_decode(stripslashes($row->nombre)),
								'telefono'			=> html_entity_decode(stripslashes($row->telefono)),
								'correo'			=> html_entity_decode(stripslashes($row->correo)),
								'direccion'			=> html_entity_decode(stripslashes($row->direccion)),
								'id_diagnostico'	=> html_entity_decode(stripslashes($row->id_diagnostico)),
								'garantia'			=> html_entity_decode(stripslashes($row->aplica_garantia)),
								'fecha_inicio_d'	=> html_entity_decode(stripslashes(date("Y-m-j H:i", strtotime($row->fecha_inicio)))),
								'fecha_termino_d'	=> html_entity_decode(stripslashes(date("Y-m-j", strtotime($row->fecha_termino)))),
								'id_presupuesto'	=> html_entity_decode(stripslashes($row->id_presupuesto)),
								'id_respuesta'		=> html_entity_decode(stripslashes($row->id_respuesta)),
								'otra_respuesta'	=> html_entity_decode(stripslashes($row->otra_respuesta)),
								'diagnostico_c'		=> html_entity_decode(stripslashes($row->diagnostico_cliente)),
								'diagnostico_i'		=> html_entity_decode(stripslashes($row->diagnostico_interno)),
								'num_gsx'			=> html_entity_decode(stripslashes($row->num_gsx)),
								'fecha_ppto'		=> html_entity_decode(stripslashes(date("Y-m-j H:i", strtotime($row->fecha_presupuesto)))),
								'estado_ppto'		=> html_entity_decode(stripslashes($row->id_estado_ppto)),
								'observaciones'		=> html_entity_decode(stripslashes($row->observaciones)),
								'cuantos_repuestos'	=> html_entity_decode(stripslashes($cuantos_repuestos)),
								'repuestos'			=> $repuestos,
								'sub_total'			=> html_entity_decode(stripslashes($row->sub_total)),
								'iva'				=> html_entity_decode(stripslashes($row->iva)),
								'total'				=> html_entity_decode(stripslashes($row->total)),
								'total_pagar'		=> html_entity_decode(stripslashes($row->total_pagar)),
								'tipo_cliente'		=> html_entity_decode(stripslashes($row->id_tipo_cliente)),
								'cod_cliente'		=> html_entity_decode(stripslashes($row->cod_cliente_ex)),
								'tienda_cliente'	=> html_entity_decode(stripslashes($row->id_tienda)),
								'rut_cliente'		=> html_entity_decode(stripslashes($row->rut)),
								'contacto_cliente'	=> html_entity_decode(stripslashes($row->contacto)),
								'celular_cliente'	=> html_entity_decode(stripslashes($row->celular)),
								'region_cliente'	=> html_entity_decode(stripslashes($row->id_region)),
								'comuna_cliente'	=> html_entity_decode(stripslashes($row->id_comuna)),
								'tipo_contrato'		=> html_entity_decode(stripslashes($row->id_tipo_contrato)),
								'fecha_recepcion'	=> html_entity_decode(stripslashes($row->fecha_recepcion)),
								'familia_contrato'	=> html_entity_decode(stripslashes($row->id_familia)),
								'garantia_contrato'	=> html_entity_decode(stripslashes($row->garantia)),
								'buscar_iphone'		=> html_entity_decode(stripslashes($row->buscar_iphone)),
								'marca'				=> html_entity_decode(stripslashes($row->marca)),
								'rayas'				=> html_entity_decode(stripslashes($row->rayas)),
								'golpes'			=> html_entity_decode(stripslashes($row->golpes)),
								'abolladuras'		=> html_entity_decode(stripslashes($row->abolladuras)),
								'marcas'			=> html_entity_decode(stripslashes($row->marcas)),
								'liquido'			=> html_entity_decode(stripslashes($row->liquido)),
								'intervenido'		=> html_entity_decode(stripslashes($row->intervenido)),
								'cod_vendedor'		=> html_entity_decode(stripslashes($row->cod_vendedor)),
								'num_boleta'		=> (html_entity_decode(stripslashes($row->num_boleta)) == 0) ? '' : html_entity_decode(stripslashes($row->num_boleta)),
								'fecha_boleta'		=> html_entity_decode(stripslashes($row->fecha_boleta)),
								'tecnico_asignado'	=> html_entity_decode(stripslashes($row->tecnico_asignado)),
								'id_usuario'		=> html_entity_decode(stripslashes($row->id_usuario)),
								'fecha_tent_diag'	=> html_entity_decode(stripslashes($row->fecha_tent_diagnostico)),
								'fecha_tent_entre'	=> html_entity_decode(stripslashes($row->fecha_tent_entrega)),
								'fecha_inicio_d2'	=> html_entity_decode(stripslashes(date("d-m-Y H:i", strtotime($row->fecha_inicio)))),
								'fecha_termino_d2'	=> html_entity_decode(stripslashes(date("d-m-Y", strtotime($row->fecha_termino)))),
								'estado_contrato'	=> html_entity_decode(stripslashes($row->estado_contrato)),
								'boleta_ppto'		=> html_entity_decode(stripslashes($row->boleta_ppto)),
								'id_estado_cont'	=> html_entity_decode(stripslashes($row->id_estado_contrato)),
								#'observacion_final'	=> html_entity_decode(stripslashes(utf8_encode($row->observacion_final))),
								'id_respuesta_fin'	=> html_entity_decode(stripslashes($row->id_respuesta_fin)),
								'otra_respuesta_fin'	=> html_entity_decode(stripslashes($row->otra_respuesta_fin)),
								'fecha_res_final'	=> html_entity_decode(stripslashes($row->fecha_respuesta_final)),
								'resultado'			=> html_entity_decode(stripslashes('OK')),
								'respuesta_rechazo'	=> html_entity_decode(stripslashes($row->respuesta_rechazo)),
								'id_respuesta_rechazo'	=> html_entity_decode(stripslashes($row->id_respuesta_rechazo)),
								'rebaja_apple'		=> html_entity_decode(stripslashes($row->rebaja_apple)),
								'sub_total_c'		=> html_entity_decode(stripslashes($row->sub_total_c)),
								'iva_c'				=> html_entity_decode(stripslashes($row->iva_c)),
								'total_c'			=> html_entity_decode(stripslashes($row->total_c)),
								'total_pagar_c'		=> html_entity_decode(stripslashes($row->total_pagar_c))
							);
	
		
		$json = json_encode($a_json);
		echo $json;
		
	}
	else 
	{
		$a_json = array(
							'error' 	=> html_entity_decode(stripslashes("No existen resultados")),
							'resultado'	=> html_entity_decode(stripslashes('ERROR'))	
						);
		
		$json = json_encode($a_json);
		echo $json;
	}


?>