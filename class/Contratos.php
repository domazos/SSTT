<?php

include_once(dirname(__FILE__) . '/../class/mysql.class.php');

class Contratos
{
	public function listarContratos($id_usuario)
	{
		$bd 	= new DB;
		
		$where 	= "";
		
		if($id_usuario != 0)
			$where = "WHERE c.id_usuario = ".$id_usuario;
		
		
		$sql 	= 	"	SELECT		c.id_contrato, DATE_FORMAT(c.fecha_recepcion, '%d-%m-%Y %H:%i') fecha_recepcion, DATE_FORMAT(c.fecha_tent_diagnostico, '%d-%m-%Y') fecha_tent_diagnostico, 
									DATE_FORMAT(c.fecha_tent_entrega, '%d-%m-%Y') fecha_tent_entrega, cl.nombre as nombre_cliente, c.garantia, IFNULL(d.id_diagnostico, 0) as id_diagnostico,
									e.descripcion as estado_contrato, c.id_estado, d.aplica_garantia
						FROM 		contratos_reparacion c 
						JOIN		clientes cl ON cl.id_cliente = c.id_cliente 
						LEFT JOIN	diagnostico d ON c.id_contrato = d.id_contrato
						LEFT JOIN 	estados_contrato e ON e.id_estado = c.id_estado 
						GROUP BY 	c.id_contrato
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
	
	
	
	public function cuantosContratos($id_usuario)
	{
		$bd = new DB;
		
		$where 	= "";
		
		if($id_usuario != 0)
			$where = "WHERE id_usuario = ".$id_usuario;
			
			
		$query = $bd->query("SELECT COUNT(*) as cuantos FROM contratos_reparacion ".$where);
		
		if(($query))
		{
			$res = $bd->fetchObj();
			return $res->cuantos;
		}
		else
			return $bd->get_errors();
			
	}
	
	public function tiposContrato($seleccionado)
	{
		$bd = new DB;
		
		$sql =	"SELECT * FROM tipos_contrato";
		
		if($bd->query($sql))
		{
			$array_res = array();
			
			$cuantos = $bd->resultCount();
			
			#$options = '<option value="">[Selecciona un Tipo]</option>';
			$options = '';
			
			for($i=0; $i<$cuantos; $i++)
			{
				$res = $bd->fetchObj();
				
				if(($seleccionado != 0) and ($res->id_tipo_contrato == $seleccionado))
					$sel = "selected='selected'";
				else
					$sel = "";
				
				$options .= '<option value="'.$res->id_tipo_contrato.'" '.$sel.'>'.utf8_encode($res->descripcion).'</option>';
			}

			return $options;
		}
		else
			return $bd->get_errors();
		
	}
	
	public function familiaContrato($seleccionado)
	{
		$bd = new DB;
		
		$sql =	"SELECT * FROM familias";
		
		if($bd->query($sql))
		{
			$array_res = array();
			
			$cuantos = $bd->resultCount();
			
			#$options = '<option value="">[Selecciona una Familia]</option>';
			$options = '';
			
			for($i=0; $i<$cuantos; $i++)
			{
				$res = $bd->fetchObj();
				
				if(($seleccionado != 0) and ($res->id_familia == $seleccionado))
					$sel = "selected='selected'";
				else
					$sel = "";
				
				$options .= '<option value="'.$res->id_familia.'" '.$sel.'>'.utf8_encode($res->descripcion).'</option>';
			}

			return $options;
		}
		else
			return $bd->get_errors();
		
	}
	
	public function add_business_days($startdate, $buisnessdays, $holidays, $dateformat)
	{
		$i 		= 1;
	  	$dayx 	= strtotime($startdate);
	  	
		while($i < $buisnessdays)
		{
	   		$day 	= date('N',$dayx);
	   		$date 	= date('Y-m-j',$dayx);
	   		if($day <= 5 && !in_array($date, $holidays))
				$i++;
	   		
			$dayx = strtotime($date.' +1 day');
	  	}
	  	
		return date($dateformat,$dayx);
	}
	
	
	public function listarFeriados()
	{
		$bd 	= new DB;
		
		$sql 	= 	"	SELECT	fecha
						FROM 	feriados
						WHERE	activo = 1 
					";
					
		if($bd->query($sql))
		{
			$array_res = array();
			
			$cuantos = $bd->resultCount();
			
			for($i=0; $i<$cuantos; $i++)
			{
				$res = $bd->fetchObj();
				array_push($array_res, $res->fecha);
			}

			return $array_res;
		}
		else
			return $bd->get_errors();
		
	}
	
	
	public function guardaContrato($id_familia, $id_estado, $id_cliente, $id_tipo_contrato, $id_usuario, $fecha_recepcion, $num_serie, $modelo, $descripcion, $garantia, $buscar_iphone, $marca, $falla_cliente, $rayas, $golpes, $abolladuras, $marcas, $liquido, $intervenido, $cod_vendedor = 0, $num_boleta, $fecha_boleta, $fecha_tent_diagnostico, $fecha_tent_entrega)
	{
		$bd = new DB;
		
		$correo 	= "";
		$correo_c	= "";
		
		$sql = 	"	INSERT INTO contratos_reparacion
					(	id_familia, id_estado, id_cliente, id_tipo_contrato, id_usuario, fecha_recepcion, num_serie, modelo, descripcion, garantia, 
						buscar_iphone, marca, falla_cliente, rayas, golpes, abolladuras, marcas, liquido, intervenido, cod_vendedor, num_boleta, 
						fecha_boleta, fecha_tent_diagnostico, fecha_tent_entrega
					)
					VALUES
					(
						".$id_familia.",
						".$id_estado.",
						".$id_cliente.",
						".$id_tipo_contrato.",
						".$id_usuario.",
						'".$fecha_recepcion."',
						'".$num_serie."',
						'".$modelo."',
						'".$descripcion."',
						".$garantia.",
						".$buscar_iphone.",
						'".$marca."',
						'".$falla_cliente."',
						".$rayas.",
						".$golpes.",
						".$abolladuras.",
						".$marcas.",
						".$liquido.",
						".$intervenido.",
						".$cod_vendedor.",
						".$num_boleta.",
						'".$fecha_boleta."',
						'".$fecha_tent_diagnostico."',
						'".$fecha_tent_entrega."'
					)
				";

		if($bd->query($sql))
		{
			$id_contrato = $bd->fetchLastInsertId();
			
			# Recupero información para enviar correo a técnico
			
			$sql_tecnico = "SELECT nombre, correo FROM usuarios WHERE id_usuario = ".$id_usuario;
			
			if(($bd->query($sql_tecnico)) and ($bd->resultCount() > 0))
			{
				$tecnico = $bd->fetchObj();
				
				$para 			= array($tecnico->correo);
				$nombre_desde	= $tecnico->nombre;
				$asunto			= "Nuevo contrato de trabajo";
				
				$cuerpo			= "Estimado(a) ".utf8_encode($tecnico->nombre).": ";
				$cuerpo 		.= "<br><br>Junto con saludar, informamos que tienes asignado el contrato de reparacion N&deg;: ".$id_contrato.".";
				$cuerpo			.= "<br>Fecha de creacion: ".date('d-m-Y H:i', strtotime($fecha_recepcion));
				$cuerpo 		.= "<br><br>Recuerda diagnosticar a la brevedad.";
				$cuerpo 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
				$cuerpo			.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
				
				if($this->enviarCorreo($para, $cc = NULL, $nombre_desde, $asunto, $cuerpo, $adjunto = NULL))
					$correo 	= "OK";
				else
					$correo		= "NO";
				
				# Recupero información para enviar correo a cliente
				
				$sql_cliente = "SELECT nombre, correo FROM clientes WHERE id_cliente = ".$id_cliente;
				
				if(($bd->query($sql_cliente)) and ($bd->resultCount() > 0))
				{
					$cliente 		= $bd->fetchObj();
					
					$sql_param 		= $bd->query("SELECT link_vb FROM parametros");
					if($sql_param)
					{
						$param = $bd->fetchObj();
						$link_vb = $param->link_vb."?i=".base64_encode($id_contrato);
					}
					else
						$link_vb = "[Ha ocurrido un error al generar el link. Contactese con su tecnico asignado]";
					
					
					$para_c			= array($cliente->correo);
					$nombre_desde_c	= "Servicio Tecnico Reifschneider";
					$asunto_c		= "Contrato de Trabajo ".$id_contrato;
					
					$cuerpo_c		= "Estimado(a) ".utf8_encode($cliente->nombre).": ";
					$cuerpo_c 		.= "<br><br>Junto con saludar, informamos a usted que con fecha <strong>".date('d-m-Y', strtotime($fecha_recepcion))."</strong> se ha ingresado a nuestro sistema el contrato de reparacion N&deg;: ".$id_contrato.".";
					#$cuerpo_c 		.= "<br><br>Puede revisar el detalle del contrato de reparacion en el siguiente link: ".$link_vb;
					$cuerpo_c 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
					$cuerpo_c		.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
					
					if($this->enviarCorreo($para_c, $cc_c = NULL, $nombre_desde_c, $asunto_c, $cuerpo_c, $adjunto = NULL))
						$correo_c 	= "OK";
					else
						$correo_c 	= "NO";
				}
				else
					$correo_c = "NO";
					
			}
			else
			{
				$correo 	= "NO";
				$correo_c	= "NO";
			}
			
			$this->seguimientoContrato($id_contrato, $id_usuario, $id_estado);
			
			if(($correo == "OK") and ($correo_c == "OK"))
				return "OK|".$id_contrato;
			else if(($correo == "OK") and ($correo_c == "NO"))
				return "NO CLIENTE|".$id_contrato;
			else if(($correo == "NO") and ($correo_c == "OK"))
				return "NO TECNICO|".$id_contrato;
			else
				return "ERROR CORREO|".$id_contrato;
		}
		else
			return NULL;	
	}
	
	public function enviarCorreo($para, $cc = NULL, $nombre_desde, $asunto, $cuerpo, $adjunto)
	{
		$bd = new DB;
		require_once(dirname(__FILE__) . '/../include/PHPMailer/class.phpmailer.php');
		
		try {
			$mail = new PHPMailer();
		}
		catch (Exception $e) {
			echo "No se pudo instanciar el objeto Mail: ".$e->getMessage()."<br>";
		}
		
		
		$sqlParamCorreo	= $bd->query("SELECT * FROM parametros") or die ("Error parametros: ".mysql_error());
		
		if($sqlParamCorreo)
			$correo	= $bd->fetchObj();	
		else
			$correo = NULL;
		

		$de = $correo->usuario_correo."@reif.cl";	
		
		$mail->IsSMTP();
		$mail->SMTPDebug = 1;
					
		$mail->Host = $correo->host_correo;
							
		$mail->SMTPAuth = true; 
		$mail->Port = $correo->puerto_correo; 
		
		$mail->Username = $correo->usuario_correo;
		$mail->Password = $correo->pass_correo;
					
		$mail->From 	= $de;
		
		$mail->FromName = $nombre_desde;
		$mail->Subject 	= $asunto;
		
		foreach($para as $destino)
		{
			$mail->AddAddress($destino);
		}
		
		if(!is_null($cc))	
		{
			foreach($cc as $destino_cc)
			{
				$mail->AddCC($destino_cc);
			}
		}
		
		if(!is_null($adjunto))
		{
			/*$oldmask = umask(0);
						chmod($adjunto, 0777);
						umask($oldmask);
				sleep(2);		*/
				
			$aux = explode("_",$adjunto);
			$nombre = "OC_".$aux[1]."_".$aux[2];
			$mail->AddAttachment($adjunto, $nombre);	
		}
		
		$mail->IsHTML(true);
		
		$mail->Body = $cuerpo;
		
		if(!$mail->Send())
			return $mail->ErrorInfo;
		else
			return true;

	}
	
	
	public function listarRespuestasTipo($seleccionado)
	{
		$bd 	= new DB;
		
		$sql 	= 	"	SELECT	id_respuesta, respuesta
						FROM 	respuestas_tipo
						WHERE	activo = 1 
					";
					
		if($bd->query($sql))
		{
			$array_res = array();
			
			$cuantos = $bd->resultCount();
			
			#$options = '<option value="">[Selecciona un Tipo]</option>';
			$options = '';
			
			for($i=0; $i<$cuantos; $i++)
			{
				$res = $bd->fetchObj();
				
				if(($seleccionado != 0) and ($res->id_respuesta == $seleccionado))
					$sel = "selected='selected'";
				else
					$sel = "";
				
				$options .= '<option value="'.$res->id_respuesta.'" '.$sel.'>'.utf8_encode($res->respuesta).'</option>';
			}

			return $options;
		}
		else
			return $bd->get_errors();
		
	}
	
	public function listarRespuestasTipoRechazo($seleccionado)
	{
		$bd 	= new DB;
		
		$sql 	= 	"	SELECT	id_respuesta, respuesta
						FROM 	respuestas_tipo_rechazo
						WHERE	activo = 1 
					";
					
		if($bd->query($sql))
		{
			$array_res = array();
			
			$cuantos = $bd->resultCount();
			
			#$options = '<option value="">[Selecciona un Tipo]</option>';
			$options = '';
			
			for($i=0; $i<$cuantos; $i++)
			{
				$res = $bd->fetchObj();
				
				if(($seleccionado != 0) and ($res->id_respuesta == $seleccionado))
					$sel = "selected='selected'";
				else
					$sel = "";
				
				$options .= '<option value="'.$res->id_respuesta.'" '.$sel.'>'.utf8_encode($res->respuesta).'</option>';
			}

			return $options;
		}
		else
			return $bd->get_errors();
		
	}
	
	
	public function listarEstadoPresupuesto($seleccionado)
	{
		$bd 	= new DB;
		
		$sql 	= 	"	SELECT	id_estado_ppto, descripcion
						FROM 	estados_ppto
						WHERE	activo = 1 
					";
					
		if($bd->query($sql))
		{
			$array_res = array();
			
			$cuantos = $bd->resultCount();
			
			#$options = '<option value="">[Selecciona un Tipo]</option>';
			$options = '';
			
			for($i=0; $i<$cuantos; $i++)
			{
				$res = $bd->fetchObj();
				
				if(($seleccionado != 0) and ($res->id_estado_ppto == $seleccionado))
					$sel = "selected='selected'";
				else
					$sel = "";
				
				$options .= '<option value="'.$res->id_estado_ppto.'" '.$sel.'>'.utf8_encode($res->descripcion).'</option>';
			}

			return $options;
		}
		else
			return $bd->get_errors();
		
	}
	
	
	public function guardaDiagnostico($accion, $id_contrato, $garantia_diagnostico, $fecha_inicio_d, $fecha_termino_d, $respuesta_tipo, $observacion_otra_respuesta, $diagnostico_cliente, $diagnostico_interno, $num_gsx, $fecha_ppto, $estado_ppto, $observaciones_ppto, $repuestos, $sub_total_limpio, $iva_limpio, $total_final_limpio, $total_pagar_limpio, $id_diagnostico, $id_presupuesto, $id_cliente, $tipo_guardar)
	{
		$bd 	= new DB;	
		if($accion == 'guardar_diagnostico')
		{
			$sql_diag 	=	"
								INSERT INTO diagnostico (	id_respuesta, id_contrato, otra_respuesta, aplica_garantia, fecha_inicio, fecha_termino, 
															diagnostico_cliente, diagnostico_interno, num_gsx
														)
								VALUES
														(
															".$respuesta_tipo.",
															".$id_contrato.",
															'".$observacion_otra_respuesta."',
															".$garantia_diagnostico.",
															'".$fecha_inicio_d."',
															'".$fecha_termino_d."',
															'".$diagnostico_cliente."',
															'".$diagnostico_interno."',
															'".$num_gsx."'
														)
							";
						
			$sql_ppto	=	"
								INSERT INTO presupuesto ( 	id_estado_ppto, id_contrato, fecha_presupuesto, observaciones, fecha_confirmacion, sub_total, iva, 
															total, total_pagar )
								VALUES
										(
											".$estado_ppto.",
											".$id_contrato.",
											'".$fecha_ppto."',
											'".$observaciones_ppto."',
											'0000-00-00',
											".$sub_total_limpio.",
											".$iva_limpio.",
											".$total_final_limpio.",
											".$total_pagar_limpio."
										)
							";

			$sql_cont	=	"UPDATE contratos_reparacion SET id_estado = 2 WHERE id_contrato = ".$id_contrato;
			
			
			$bd->beginTransaction();
			
			if($bd->query($sql_diag))
			{
				# Si se inserta el diagnostico, insertamos el ppto.	
				
				if($bd->query($sql_ppto))
				{
					# Si se inserta el ppto, insertamos los repuestos.
					
					$id_ppto = $bd->fetchLastInsertId();
									
					$cuantos_rep = count($repuestos);
					
					$rep = 0;
					
					for($i=0; $i<$cuantos_rep; $i++)
					{
						$sql_rep = "
										INSERT INTO presupuesto_repuestos ( id_presupuesto, id_repuesto, tipo_repuesto, cod_repuesto, des_repuesto, cant_repuesto, 
																			precio_repuesto )
										VALUES ( 	".$id_ppto.", ".$repuestos[$i]['id_repuesto'].", ".$repuestos[$i]['tipo_repuesto'].", '".$repuestos[$i]['cod_repuesto']."', 
													'".$repuestos[$i]['des_repuesto']."', ".$repuestos[$i]['cant_repuesto'].", 
													".$repuestos[$i]['prec_repuesto']."
												)
									";
						if($bd->query($sql_rep))
							$rep++;
						else
							$rep--;	
					}
					
					if($rep == $cuantos_rep)
					{
						
						if($garantia_diagnostico == 0)
						{
						
							# Si no aplica garantía, recupero información para enviar correo a cliente con detalle de diagnostico y presupuesto. 
					
							$sql_cliente = "SELECT nombre, correo FROM clientes WHERE id_cliente = ".$id_cliente;
							
							if(($bd->query($sql_cliente)) and ($bd->resultCount() > 0))
							{
								$cliente 		= $bd->fetchObj();
								
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
								
								$para_c			= array($cliente->correo);
								$nombre_desde_c	= "Servicio Tecnico Reifschneider";
								$asunto_c		= "Diagnostico Contrato de Trabajo ".$id_contrato;
								
								$cuerpo_c		= "Estimado(a) ".utf8_encode($cliente->nombre).": ";
								$cuerpo_c 		.= "<br><br>Junto con saludar, informamos a usted que con fecha <strong>".date('d-m-Y', strtotime($fecha_inicio_d))."</strong> se ha realizado el diagnostico y presupuesto de su contrato de reparacion N&deg;: ".$id_contrato.".";
								$cuerpo_c		.= "<br>Le solicitamos revisarlo y si esta de acuerdo, confirmar el presupuesto para que nuestros tecnicos puedan proceder con la reparacion.";
								$cuerpo_c 		.= "<br><br>Puede revisar el detalle del diagnostico y presupuesto en el siguiente link: ". $link_vb;
								$cuerpo_c 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
								$cuerpo_c		.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
								
								
								if($tipo_guardar == 2)
								{
									if($this->enviarCorreo($para_c, $cc_c = NULL, $nombre_desde_c, $asunto_c, $cuerpo_c, $adjunto = NULL))
										$correo_c 	= "OK";
									else
										$correo_c 	= "NO";
								}
								else
								{
									$correo_c = "ENV";	
								}
							}
							else
								$correo_c = "NO";
							
							if($correo_c == "OK")
							{
								if($bd->query($sql_cont))
								{
									mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
									
									session_name('sstt');
									session_start();
									extract($_SESSION);
									
									$this->seguimientoContrato($id_contrato, $userid, $estado_ppto);
									
									echo "OK|".$id_contrato;
								}
								else
								{
									mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
									echo "ERROR|";
								}	
							}
							else if($correo_c == "NO")
							{
								if($bd->query($sql_cont))
								{
									mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
									
									session_name('sstt');
									session_start();
									extract($_SESSION);
									
									$this->seguimientoContrato($id_contrato, $userid, $estado_ppto);
									
									echo "CORREO|".$id_contrato;
								}
								else
								{
									mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
									echo "ERROR|";
								}	
							}
							else
							{
								if($bd->query($sql_cont))
								{
									mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
									
									session_name('sstt');
									session_start();
									extract($_SESSION);
									
									$this->seguimientoContrato($id_contrato, $userid, $estado_ppto);
									
									echo "ENVCORREO|".$id_contrato;
								}
								else
								{
									mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
									echo "ERROR|";
								}	
							}
						}
						else
						{
							# Si aplica garantía, no se envía correo para VB Cliente
							
							if($bd->query($sql_cont))
							{
								mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
								
								session_name('sstt');
								session_start();
								extract($_SESSION);
								
								$this->seguimientoContrato($id_contrato, $userid, $estado_ppto);
								
								echo "OK|".$id_contrato;
							}
							else
							{
								mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
								echo "ERROR|";
							}		
						}
					}
					else
					{
						mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
						echo "ERROR|";
					}		
					
					
				}
				else
				{
					mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
					echo "ERROR2|";
				}
			}
			else
			{
				mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
				echo "ERROR3|";
			}
		}
		else if($accion == 'editar_diagnostico')
		{
			$sql_diag 	=	"
								UPDATE diagnostico SET
									id_respuesta = ".$respuesta_tipo.", 
									otra_respuesta = '".$observacion_otra_respuesta."', 
									aplica_garantia = ".$garantia_diagnostico.", 
									fecha_inicio = '".$fecha_inicio_d."', 
									fecha_termino = '".$fecha_termino_d."', 
									diagnostico_cliente = '".$diagnostico_cliente."', 
									diagnostico_interno = '".$diagnostico_interno."', 
									num_gsx = '".$num_gsx."'
								WHERE id_diagnostico = ".$id_diagnostico;
						
			if($id_presupuesto == -1)
			{
				$sql_ppto_2	=	"
								INSERT INTO presupuesto ( 	id_estado_ppto, id_contrato, fecha_presupuesto, observaciones, fecha_confirmacion, sub_total, iva, 
															total, total_pagar )
								VALUES
										(
											".$estado_ppto.",
											".$id_contrato.",
											'".$fecha_ppto."',
											'".$observaciones_ppto."',
											'0000-00-00',
											".$sub_total_limpio.",
											".$iva_limpio.",
											".$total_final_limpio.",
											".$total_pagar_limpio."
										)
							";

				$sql_cont_2	=	"UPDATE contratos_reparacion SET id_estado = 2 WHERE id_contrato = ".$id_contrato;
				
				#mysql_query("START TRANSACTION;", ) or die ("Error Start_Transaction: ".mysql_error());	
			
				$bd->beginTransaction();
				
				if($bd->query($sql_diag))
				{
					# Si se inserta el diagnostico, insertamos el ppto.	
					
					if($bd->query($sql_ppto_2))
					{
						# Si se inserta el ppto, insertamos los repuestos.
						
						$id_ppto_2 = $bd->fetchLastInsertId();
										
						$cuantos_rep_2 = count($repuestos);
						
						$rep_2 = 0;
						
						for($i=0; $i<$cuantos_rep_2; $i++)
						{
							$sql_rep_2 = "
											INSERT INTO presupuesto_repuestos ( id_presupuesto, id_repuesto, tipo_repuesto, cod_repuesto, des_repuesto, cant_repuesto, 
																				precio_repuesto )
											VALUES ( 	".$id_ppto_2.", ".$repuestos[$i]['id_repuesto'].", ".$repuestos[$i]['tipo_repuesto'].", '".$repuestos[$i]['cod_repuesto']."', 
														'".$repuestos[$i]['des_repuesto']."', ".$repuestos[$i]['cant_repuesto'].", 
														".$repuestos[$i]['prec_repuesto']."
													)
										";
							if($bd->query($sql_rep_2))
								$rep_2++;
							else
								$rep_2--;	
						}
						
						if($rep_2 == $cuantos_rep_2)
						{
							# Recupero información para enviar correo a cliente
					
							$sql_cliente = "SELECT nombre, correo FROM clientes WHERE id_cliente = ".$id_cliente;
							
							if(($bd->query($sql_cliente)) and ($bd->resultCount() > 0))
							{
								$cliente 		= $bd->fetchObj();
								
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
								
								$para_c			= array($cliente->correo);
								$nombre_desde_c	= "Servicio Tecnico Reifschneider";
								$asunto_c		= "Diagnostico Contrato de Trabajo ".$id_contrato;
								
								$cuerpo_c		= "Estimado(a) ".utf8_encode($cliente->nombre).": ";
								$cuerpo_c 		.= "<br><br>Junto con saludar, informamos a usted que con fecha <strong>".date('d-m-Y', strtotime($fecha_inicio_d))."</strong> se ha realizado el diagnostico y presupuesto de su contrato de reparacion N&deg;: ".$id_contrato.".";
								$cuerpo_c		.= "<br>Le solicitamos revisarlo y si esta de acuerdo, confirmar el presupuesto para que nuestros tecnicos puedan proceder con la reparacion.";
								$cuerpo_c 		.= "<br><br>Puede revisar el detalle del diagnostico y presupuesto en el siguiente link: ". $link_vb;
								$cuerpo_c 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
								$cuerpo_c		.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
								
								
								if($tipo_guardar == 2)
								{
									if($this->enviarCorreo($para_c, $cc_c = NULL, $nombre_desde_c, $asunto_c, $cuerpo_c, $adjunto = NULL))
										$correo_c 	= "OK";
									else
										$correo_c 	= "NO";
								}
								else
								{
									$correo_c = "ENV";	
								}
							}
							else
								$correo_c = "NO";
							
							if($correo_c == "OK")
							{
								if($bd->query($sql_cont_2))
								{
									mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
									
									session_name('sstt');
									session_start();
									extract($_SESSION);
									
									$this->seguimientoContrato($id_contrato, $userid,  $estado_ppto);
									
									echo "OK|".$id_contrato;
								}
							}
							else if($correo_c == "NO")
							{
								if($bd->query($sql_cont_2))
								{
									mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
									
									session_name('sstt');
									session_start();
									extract($_SESSION);
									
									$this->seguimientoContrato($id_contrato, $userid, $estado_ppto);
									
									echo "CORREO|".$id_contrato;
								}
							}
							else
							{
								if($bd->query($sql_cont_2))
								{
									mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
									
									session_name('sstt');
									session_start();
									extract($_SESSION);
									
									$this->seguimientoContrato($id_contrato, $userid, $estado_ppto);
									
									echo "ENVCORREO|".$id_contrato;
								}
							}
							
						}
						else
						{
							mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
							echo "ERROR|";
						}		
						
						
					}
					else
					{
						mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
						echo "ERROR2|";
					}
				}
				else
				{
					mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
					echo "ERROR3|";
				}	
			}
			else
			{
			
				$sql_ppto	=	"
									UPDATE presupuesto SET
										id_estado_ppto = ".$estado_ppto.", 
										id_contrato = ".$id_contrato.", 
										fecha_presupuesto = '".$fecha_ppto."', 
										observaciones = '".$observaciones_ppto."', 
										fecha_confirmacion = '0000-00-00',
										sub_total = ".$sub_total_limpio.", 
										iva = ".$iva_limpio.", 
										total = ".$total_final_limpio.",
										total_pagar = ".$total_pagar_limpio."
									WHERE id_presupuesto = ".$id_presupuesto;
			
			
				#mysql_query("START TRANSACTION;") or die ("Error Start_Transaction: ".mysql_error());	
	
				$bd->beginTransaction();
				
				if($bd->query($sql_diag))
				{
					# Si se actualiza el diagnostico, actualizamos el ppto.	
					
					if($bd->query($sql_ppto))
					{
						# Si se actualiza el ppto, actualizamos los repuestos.
						
						$cuantos_rep = count($repuestos);
						
						$rep = 0;
						
						for($i=0; $i<$cuantos_rep; $i++)
						{
							$sql_busca = "	SELECT 	id_repuesto 
											FROM 	presupuesto_repuestos 
											WHERE 	id_repuesto = ".$repuestos[$i]['id_repuesto']." 
												AND id_presupuesto = ".$id_presupuesto."
												AND id = ".$repuestos[$i]['id'];
							
							if(($bd->query($sql_busca)) and ($bd->resultCount() > 0))
							{
								#$hay_rep = $bd->fetchObj();
								
								$sql_rep = "
												UPDATE 	presupuesto_repuestos SET 
															tipo_repuesto = '".$repuestos[$i]['tipo_repuesto']."',
															cod_repuesto = '".$repuestos[$i]['cod_repuesto']."',
															des_repuesto = '".$repuestos[$i]['des_repuesto']."', 
															cant_repuesto = ".$repuestos[$i]['cant_repuesto'].", 
															precio_repuesto = ".$repuestos[$i]['prec_repuesto']."
												WHERE 	id_presupuesto = ".$id_presupuesto."
													AND	id_repuesto = ".$repuestos[$i]['id_repuesto']."
													AND id = ".$repuestos[$i]['id'];
							}
							else
							{
							
								$sql_rep = "
												INSERT INTO presupuesto_repuestos ( id_presupuesto, id_repuesto, tipo_repuesto, cod_repuesto, des_repuesto, cant_repuesto, 
																					precio_repuesto )
												VALUES ( 	".$id_presupuesto.", ".$repuestos[$i]['id_repuesto'].", ".$repuestos[$i]['tipo_repuesto'].",
															'".$repuestos[$i]['cod_repuesto']."', 
															'".$repuestos[$i]['des_repuesto']."', ".$repuestos[$i]['cant_repuesto'].", 
															".$repuestos[$i]['prec_repuesto']."
														)
											";
							}
							if($bd->query($sql_rep))
								$rep++;
							else
								$rep--;	
						}
						
						if($rep == $cuantos_rep)
						{
							# Recupero información para enviar correo a cliente
					
							$sql_cliente = "SELECT nombre, correo FROM clientes WHERE id_cliente = ".$id_cliente;
							
							if(($bd->query($sql_cliente)) and ($bd->resultCount() > 0))
							{
								$cliente 		= $bd->fetchObj();
								
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
								
								$para_c			= array($cliente->correo);
								$nombre_desde_c	= "Servicio Tecnico Reifschneider";
								$asunto_c		= "Diagnostico Contrato de Trabajo ".$id_contrato;
								
								$cuerpo_c		= "Estimado(a) ".utf8_encode($cliente->nombre).": ";
								$cuerpo_c 		.= "<br><br>Junto con saludar, informamos a usted que con fecha <strong>".date('d-m-Y', strtotime($fecha_inicio_d))."</strong> se ha realizado el diagnostico y presupuesto de su contrato de reparacion N&deg;: ".$id_contrato.".";
								$cuerpo_c		.= "<br>Le solicitamos revisarlo y si esta de acuerdo, confirmar el presupuesto para que nuestros tecnicos puedan proceder con la reparacion.";
								$cuerpo_c 		.= "<br><br>Puede revisar el detalle del diagnostico y presupuesto en el siguiente link: ". $link_vb;
								$cuerpo_c 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
								$cuerpo_c		.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
								
								if($tipo_guardar == 2)
								{
									if($this->enviarCorreo($para_c, $cc_c = NULL, $nombre_desde_c, $asunto_c, $cuerpo_c, $adjunto = NULL))
										$correo_c 	= "OK";
									else
										$correo_c 	= "NO";
								}
								else
								{
									$correo_c = "ENV";	
								}
							
								if($correo_c == "OK")
								{
									mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
									
									session_name('sstt');
									session_start();
									extract($_SESSION);
									
									$this->seguimientoContrato($id_contrato, $userid, $estado_ppto);
									
									echo "OK|".$id_contrato;
									
								}
								else if($correo_c == "NO")
								{
									mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
									
									session_name('sstt');
									session_start();
									extract($_SESSION);
									
									$this->seguimientoContrato($id_contrato, $userid, $estado_ppto);
									
									echo "CORREO|".$id_contrato;
									
								}
								else
								{
									mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
									
									session_name('sstt');
									session_start();
									extract($_SESSION);
									
									$this->seguimientoContrato($id_contrato, $userid, $estado_ppto);
									
									echo "ENVCORREO|".$id_contrato;
									
								}
							}
								else
									$correo_c = "NO";
							
							}
						else
						{
							mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
							echo "ERROR|";
						}		
						
						
					}
					else
					{
						mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
						echo "ERROR2|";
					}
				}
				else
				{
					mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
					echo "ERROR3|";
				}
			}
		}
	
	}
	
	
	
	public function detalleContrato($id_contrato)
	{
		$bd = new DB;
		
		$sql =	"
					SELECT 		c.id_contrato, c.id_cliente, c.num_serie, c.modelo, c.descripcion, c.falla_cliente, c.id_estado as estado_contrato,   
								cl.nombre, cl.telefono, cl.correo, cl.direccion,
								d.id_diagnostico, d.aplica_garantia, DATE_FORMAT(d.fecha_inicio, '%d-%m-%Y') as fecha_inicio, d.id_respuesta, 
								d.otra_respuesta, d.diagnostico_cliente, d.num_gsx,
								p.id_presupuesto, DATE_FORMAT(p.fecha_presupuesto, '%d-%m-%Y') as fecha_ppto, p.id_estado_ppto, p.observaciones, 
								p.sub_total, p.iva, p.total, p.total_pagar,
								r.respuesta,
								e.descripcion as estado_contrado_des 
					FROM 		contratos_reparacion c 
					LEFT JOIN	clientes cl ON c.id_cliente = cl.id_cliente
					LEFT JOIN	diagnostico d ON d.id_contrato = c.id_contrato
					LEFT JOIN	presupuesto p ON p.id_contrato = c.id_contrato
					LEFT JOIN	respuestas_tipo r ON r.id_respuesta = d.id_respuesta 
					LEFT JOIN	estados_contrato e ON e.id_estado = c.id_estado
					WHERE 		c.id_contrato = ".$id_contrato." AND	p.id_estado_ppto != 4";

		if(($bd->query($sql)) and ($bd->resultCount() > 0))
		{
			$res = $bd->fetchObj();
			
			$sql_img = "SELECT * FROM imagenes_contrato WHERE id_contrato = ".$id_contrato." AND etapa = 'diagnostico'";
			
			$sql_img_recep = "SELECT * FROM imagenes_contrato WHERE id_contrato = ".$id_contrato." AND etapa = 'recepcion'";


			if (($bd->query($sql_img)) and ($bd->resultCount() > 0))
			{
				$ruta 		= '/uploads/'.$id_contrato.'/diagnostico';
				$img_table = "";
				
				for($i=0; $i<$bd->resultCount(); $i++)
				{
					$img = $bd->fetchObj();
				
					$img_table	.= 	'
										<a href="'.$ruta.'/'.$img->nombre.'" title="" class="fancybox" rel="gallery">
											<img src="'.$ruta.'/'.$img->nombre.'" width="50" heigth="50">
										</a>
									';
				}
				
			}
			else
				$img_table = '';
			
			
			
			if (($bd->query($sql_img_recep)) and ($bd->resultCount() > 0))
			{
				$ruta_2		= '/uploads/'.$id_contrato.'/recepcion';
				$img_table_2 = "";
				
				for($i=0; $i<$bd->resultCount(); $i++)
				{
					$img_2 = $bd->fetchObj();
				
					$img_table_2	.= 	'
										<a href="'.$ruta_2.'/'.$img_2->nombre.'" title="" class="fancybox" rel="gallery">
											<img src="'.$ruta_2.'/'.$img_2->nombre.'" width="50" heigth="50">
										</a>
									';
				}
				
			}
			else
				$img_table_2 = '';
			
			$sql_repuestos = 	"	SELECT 		pr.tipo_repuesto, pr.cod_repuesto, pr.des_repuesto, pr.cant_repuesto, pr.precio_repuesto
									FROM		presupuesto_repuestos pr 
									LEFT JOIN	presupuesto p ON p.id_presupuesto = pr.id_presupuesto 
									WHERE		p.id_contrato = ".$id_contrato." AND	p.id_estado_ppto != 4";
							
			if (($bd->query($sql_repuestos)) and ($bd->resultCount() > 0))
			{
				$cuantos_repuestos = $bd->resultCount();
				
				for($i=0; $i<$cuantos_repuestos; $i++)
				{
					$rep_p = $bd->fetchObj();	
					
					$repuestos[] = array(
											"tipo_repuesto"		=> $rep_p->tipo_repuesto,
											"cod_repuesto"		=> $rep_p->cod_repuesto,
											"des_repuesto"		=> $rep_p->des_repuesto,
											"cant_repuesto"		=> $rep_p->cant_repuesto,
											"precio_repuesto"	=> "$ ".number_format($rep_p->precio_repuesto, 0, '.', '.'),
											"total_repuesto"	=> "$ ".number_format(($rep_p->cant_repuesto * $rep_p->precio_repuesto), 0, '.', '.')
										);
				}
				
			}
			
			
			$array_res = array(
									"id_contrato"		=> $res->id_contrato,
									"id_cliente"		=> $res->id_cliente,
									"num_serie"			=> $res->num_serie,
									"modelo"			=> $res->modelo,
									"descripcion"		=> $res->descripcion,
									"falla_cliente"		=> $res->falla_cliente,
									"nombre_cliente"	=> $res->nombre,
									"telefono_cliente"	=> $res->telefono,
									"correo_cliente"	=> $res->correo,
									"direccion_cliente"	=> $res->direccion,
									"aplica_garantia"	=> $res->aplica_garantia,
									"fecha_inicio_d"	=> $res->fecha_inicio,
									"respuesta"			=> $res->respuesta,
									"otra_respuesta"	=> $res->otra_respuesta,
									"diag_cliente"		=> $res->diagnostico_cliente,
									"imagenes"			=> $img_table,
									"imagenes_recep"	=> $img_table_2,
									"fecha_ppto"		=> $res->fecha_ppto,
									"obs_ppto"			=> $res->observaciones,
									"repuestos"			=> $repuestos,
									"sub_total"			=> "$ ".number_format($res->sub_total, 0, '.', '.'),
									"iva"				=> "$ ".number_format($res->iva, 0, '.', '.'),
									"total"				=> "$ ".number_format($res->total, 0, '.', '.'),
									"total_pagar"		=> "$ ".number_format($res->total_pagar, 0, '.', '.'),
									"estado_contrato"	=> $res->estado_contrato,
									"estado_contrado_des" => $res->estado_contrado_des

								
								);
			
			return $array_res;
			
			
		}
		
	}
	
	
	public function aceptaPresupuesto($id_contrato, $rebaja)
	{
		$bd 	= new DB;
		
		$sql_c 	= 	"UPDATE contratos_reparacion SET id_estado = 3 WHERE id_contrato = ".$id_contrato;
		
		if($rebaja == 1)
			$sql_p	= 	"UPDATE presupuesto SET id_estado_ppto = 3, rebaja_apple = 1 WHERE id_contrato = ".$id_contrato." AND id_estado_ppto != 4";
		else if($rebaja == 0)
			$sql_p	= 	"UPDATE presupuesto SET id_estado_ppto = 3, rebaja_apple = 0 WHERE id_contrato = ".$id_contrato." AND id_estado_ppto != 4";
		else
			$sql_p	= 	"UPDATE presupuesto SET id_estado_ppto = 3 WHERE id_contrato = ".$id_contrato." AND	id_estado_ppto != 4";
		
		#mysql_query("START TRANSACTION;") or die ("Error Start_Transaction: ".mysql_error());	
		
		$bd->beginTransaction();
		
		if($bd->query($sql_c))
		{
			if($bd->query($sql_p))
			{
				mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
				
				
				
				# Recupero información para enviar correo a técnico
				
				$sql_usuario = "SELECT id_usuario FROM contratos_reparacion WHERE id_contrato = ".$id_contrato;
				
				if(($bd->query($sql_usuario)) and ($bd->resultCount() > 0))
				{
					$usr = $bd->fetchObj();
					$id_usuario = $usr->id_usuario;
				}
				else
				{
					$usr = NULL;
					$id_usuario = 0;
				}
				
				
				if($id_usuario != 0)
				{
					
					$sql_tecnico = "SELECT nombre, correo FROM usuarios WHERE id_usuario = ".$id_usuario;
				
					if(($bd->query($sql_tecnico)) and ($bd->resultCount() > 0))
					{
						$tecnico = $bd->fetchObj();
						
						$para 			= array($tecnico->correo);
						$nombre_desde	= "Sistema Servicio Tecnico Reifschneider";
						$asunto			= "Acepta Presupuesto Contrato de Trabajo: ".$id_contrato;
						
						$cuerpo			= "Estimado(a) ".utf8_encode($tecnico->nombre).": ";
						$cuerpo 		.= "<br><br>Junto con saludar, informamos que cliente ha <strong>aprobado</strong> el presupuesto asociado al contrato de reparacion N&deg;: ".$id_contrato.".";
						
						if($rebaja == 1)
							$cuerpo 	.= "<br><br> Ademas, informamos que cliente ha aceptado dejar repuestos en Apple para obtener un descuento";
						
						$cuerpo 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
						$cuerpo			.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
						
						if($this->enviarCorreo($para, $cc = NULL, $nombre_desde, $asunto, $cuerpo, $adjunto = NULL))
							$correo 	= "OK";
						else
							$correo		= "NO";
					}
					else
						$correo = "NO";
				}
				
				
				# Correo a cliente
				
				$sql_cliente = "SELECT 	c.id_cliente
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
						
						/*$sql_param		= "SELECT cuenta, tipo_cuenta, banco, rut_cuenta, nombre_cuenta, correo_cuenta FROM parametros";
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
						*/
						
						$para_c			= array($cl->correo);
						$nombre_desde	= "Sistema Servicio Tecnico Reifschneider";
						$asunto_c		= "Acepta Presupuesto Contrato de Trabajo: ".$id_contrato;
											
						$cuerpo_c		= "Estimado(a) ".utf8_encode($cl->nombre).": ";
						$cuerpo_c 		.= "<br><br>Junto con saludar, informamos a usted que con fecha <strong>".date('d-m-Y')."</strong> ha <strong>aprobado</strong> el presupuesto asociado al contrato de reparacion N&deg;: ".$id_contrato.".";
						
						# Si no es garantía, hay un pago asociado, por ende informo metodos de pago
						$sql_contrato 	= "	SELECT 	d.aplica_garantia, p.total_pagar 
											FROM 	diagnostico d 
											JOIN	presupuesto p ON p.id_contrato = d.id_contrato
											WHERE 	d.id_contrato = ".$id_contrato;
											
						if(($bd->query($sql_contrato)) and ($bd->resultCount() > 0))
						{
							$gar = $bd->fetchObj();
							$aplica_g = $gar->aplica_garantia;
							
							if($aplica_g == 0)
							{
								# No aplica garantia, hay pago
								
								$cuerpo_c 	.= "<br><br>El diagnostico efectuado por el tecnico, indica que no se puede aplicar la garantia del producto.";
								$cuerpo_c	.= "<br>Por lo que existe un precio asociado al presupuesto aprobado por usted, el cual corresponde a <strong>$ ".number_format($gar->total_pagar, 0, '.','.')."</strong>";
								$cuerpo_c	.= "<br><br>Para pagar el presupuesto, puede dirigirse a cualquiera de <a href='http://www.reifstore.cl/tiendas' target='_blank'>nuestras tiendas</a>";
								$cuerpo_c 	.= "<br>O si lo prefiere, puede realizar una transferencia electronica utilizando la siguiente informacion: ";
								$cuerpo_c	.= "<br><br>Cuenta Corriente Numero XXXX del Banco XXX... ";
							}
						}
						
						
						$cuerpo_c 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
						$cuerpo_c		.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
						
						
						if($this->enviarCorreo($para_c, $cc = NULL, $nombre_desde, $asunto_c, $cuerpo_c, $adjunto = NULL))
							$correo_c 	= "OK";
						else
							$correo_c	= "NO";
					}
					else
						$correo_c = "NO";
				}
				else
					$correo_c = "NO";
				
				# Genero OC
				session_name('sstt');
				session_start();
				extract($_SESSION);
						
				if($aplica_g == 1)
				{
					$sql_ppto = "SELECT * FROM presupuesto WHERE id_contrato = ".$id_contrato." AND id_estado_ppto != 4";
			
					if(($bd->query($sql_ppto)) and ($bd->resultCount() > 0))
					{
						$ppto = $bd->fetchObj();
						
						
						
						$this->generarOC($id_contrato, $ppto->id_presupuesto, $userid, date('Y-m-d H:i:s'), 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM'.$id_contrato.')', $ppto->sub_total, $ppto->iva, $ppto->total);
					}		
				}
				
				$this->seguimientoContrato($id_contrato, $userid, 3);
				
				if($correo == "OK")
					return "OK";
				else
					return "CORREO";
				
			}			
			else
			{
				mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
			}
		}
		else
		{
			mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
		}
		
		
	}
	
	
	public function rechazaPresupuesto($id_contrato, $id_respuesta)
	{
		$bd 	= new DB;
		
		$sql_c 	= 	"UPDATE contratos_reparacion SET id_estado = 4 WHERE id_contrato = ".$id_contrato;
		
		$sql_p	= 	"UPDATE presupuesto SET id_estado_ppto = 4, id_respuesta_rechazo = ".$id_respuesta." WHERE id_contrato = ".$id_contrato;
		
		
		#mysql_query("START TRANSACTION;") or die ("Error Start_Transaction: ".mysql_error());	
		
		$bd->beginTransaction();
		
		if($bd->query($sql_c))
		{
			if($bd->query($sql_p))
			{
				mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
				
				session_name('sstt');
				session_start();
				extract($_SESSION);
				
				$this->seguimientoContrato($id_contrato, $userid, 4);
				
				
				# Recupero información para enviar correo a técnico
				
				$sql_usuario = "SELECT id_usuario FROM contratos_reparacion WHERE id_contrato = ".$id_contrato;
				
				if(($bd->query($sql_usuario)) and ($bd->resultCount() > 0))
				{
					$usr = $bd->fetchObj();
					$id_usuario = $usr->id_usuario;
				}
				else
				{
					$usr = NULL;
					$id_usuario = 0;
				}
				
				if($id_usuario != 0)
				{
					
					$sql_tecnico = "SELECT nombre, correo FROM usuarios WHERE id_usuario = ".$id_usuario;
				
					if(($bd->query($sql_tecnico)) and ($bd->resultCount() > 0))
					{
						$tecnico = $bd->fetchObj();
						
						$para 			= array($tecnico->correo);
						$nombre_desde	= $tecnico->nombre;
						$asunto			= "Rechazo Presupuesto Contrato de Trabajo";
						
						$cuerpo			= "Estimado(a) ".utf8_encode($tecnico->nombre).": ";
						$cuerpo 		.= "<br><br>Junto con saludar, informamos que cliente ha <strong>rechazado</strong> el presupuesto asociado al contrato de reparacion N&deg;: ".$id_contrato.".";
						
						
						$sql_resp_rechazo = "SELECT * FROM respuestas_tipo_rechazo WHERE id_respuesta = ".$id_respuesta;
						
						if(($bd->query($sql_resp_rechazo)) and ($bd->resultCount() > 0))
						{
							$resp_rechazo = $bd->fetchObj();
							
							$cuerpo		.= '<br><br>Adicionalmente, el cliente ha seleccionado la siguiente respuesta de rechazo: ';
							$cuerpo 	.= '<strong>'.utf8_encode($resp_rechazo->respuesta).'</strong>';
							
						}
						
						$cuerpo 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
						$cuerpo			.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
						
						if($this->enviarCorreo($para, $cc = NULL, $nombre_desde, $asunto, $cuerpo, $adjunto = NULL))
							$correo 	= "OK";
						else
							$correo		= "NO";
					}
					else
						$correo = "NO";
				}
				
				if($correo == "OK")
					return "OK";
				else
					return "CORREO";
				
			}			
			else
			{
				mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
			}
		}
		else
		{
			mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
		}
		
		
	}
	
	
	public function guardaPago($id_contrato, $boleta_contrato)
	{
		$bd 	= new DB;
		
		$sql 	= "UPDATE presupuesto SET num_boleta = ".$boleta_contrato." WHERE id_contrato = ".$id_contrato;
		
		#mysql_query("START TRANSACTION;") or die ("Error Start_Transaction: ".mysql_error());	
		
		$bd->beginTransaction();
		
		if($bd->query($sql))
		{
			mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
			
			$sql_ppto = "SELECT * FROM presupuesto WHERE id_contrato = ".$id_contrato;
			
			if(($bd->query($sql_ppto)) and ($bd->resultCount() > 0))
			{
				$ppto = $bd->fetchObj();
				
				session_name('sstt');
				session_start();
				extract($_SESSION);
				
				$this->generarOC($id_contrato, $ppto->id_presupuesto, $userid, date('Y-m-d H:i:s'), 'GENERADA AUTOMATICAMENTE POR SISTEMA SSTT (CONTRATO NUM'.$id_contrato.')', $ppto->sub_total, $ppto->iva, $ppto->total);
			}
			
			return true;
		}
		else
		{
			mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
			return false;
		}
				
	}
	
	
	public function generarOC($id_contrato, $id_presupuesto, $id_usuario, $fecha_creacion, $observaciones, $sub_total, $iva, $total)
	{
		$bd = new DB;
		
		#mysql_query("START TRANSACTION;") or die ("Error Start_Transaction: ".mysql_error());	
		
		$bd->beginTransaction();
		
		$sql_header_oc	=	"
								INSERT INTO orden_compra (	id_presupuesto, id_usuario, fecha_creacion, observaciones, sub_total, iva, total )
								VALUES
										(
											".$id_presupuesto.",
											".$id_usuario.",
											'".$fecha_creacion."',
											'".$observaciones."',
											".$sub_total.",
											".$iva.",
											".$total."	
										)
							";
							
		
									
		if($bd->query($sql_header_oc))
		{
			$id_oc = $bd->fetchLastInsertId();
				
			# Buscar repuestos del presupuesto
		
			$sql_repuestos	= 	"
									SELECT	tipo_repuesto, cod_repuesto, des_repuesto, cant_repuesto, precio_repuesto
									FROM	presupuesto_repuestos
									WHERE	id_presupuesto = ".$id_presupuesto;
			
			if($bd->query($sql_repuestos))
			{
				$cuantos_repuestos = $bd->resultCount();
				
				$detalle = 0;
								
				for($i=0; $i<$cuantos_repuestos; $i++)
				{
					$rep = $bd->fetchObj();
					
					$sql_detalle_oc		=	"	INSERT INTO detalle_oc ( id_oc, tipo_repuesto, cod_repuesto, des_repuesto, cant_repuesto, prec_repuesto )
												VALUES 
												(
													".$id_oc.",	
													".$rep->tipo_repuesto.",
													'".$rep->cod_repuesto."',
													'".$rep->des_repuesto."',
													".$rep->cant_repuesto.",
													".$rep->precio_repuesto."	
												)
											";
					#echo $sql_detalle_oc,die;
					if(mysql_query($sql_detalle_oc))
						$detalle++;
					else
						$detalle--;
						
				}
				#echo $detalle." - ".$cuantos_repuestos,die;
				if($detalle == $cuantos_repuestos)
				{
					$sql_upd1 	= 	"UPDATE contratos_reparacion SET id_estado = 9 WHERE id_contrato = ".$id_contrato;
		
					$sql_upd2	= 	"UPDATE presupuesto SET id_estado_ppto = 7, orden_compra = ".$id_oc." WHERE id_contrato = ".$id_contrato." AND id_estado_ppto != 4";
					
					
					if(($bd->query($sql_upd1)) and ($bd->query($sql_upd2)))
					{
						mysql_query("COMMIT") or die ("Error commit: ".mysql_error());
												
						try {
							$this->generaOrdenPDF($id_contrato, $id_oc);
						}
						catch (Exception $e) {
							die("No se pudo generar el PDF con la O/C: ".$e->getMessage());
						}
						
						$sql_tecnico = "SELECT nombre, correo FROM usuarios WHERE id_usuario = ".$id_usuario;
				
						if(($bd->query($sql_tecnico)) and ($bd->resultCount() > 0))
						{
							$tecnico = $bd->fetchObj();
							$mail_tec = $tecnico->correo;
						}
						else
							$mail_tec = "";
						
						#$para 			= array('jdomazos@reif.cl', 'jsantelices@reif.cl', $mail_tec);
						$para 			= array('jdomazos@reif.cl');
						$nombre_desde	= "Sistema Servicio Tecnico Reifschneider";
						$asunto_c		= "O/C Contrato de Trabajo ".$id_contrato;
											
						$cuerpo_c		= "Estimado(a): ";
						$cuerpo_c 		.= "<br><br>Junto con saludar, informamos a usted que con fecha <strong>".date('d-m-Y', strtotime($fecha_creacion))."</strong> se ha generado la O/C del contrato de reparacion N&deg;: ".$id_contrato.". La cual puede encontrar adjunta a este correo.";
						$cuerpo_c		.= "<br><br>Favor gestionar a la brevedad.";
						$cuerpo_c 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
						$cuerpo_c		.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
						$cuerpo_c		.= "<br>*** Este es un mail de TEST, al pasar a produccion este mail solo le llegara a Valeria Diaz y al tecnico asignado ***";
						
						
						$adjunto = $_SERVER['DOCUMENT_ROOT'].'/uploads/OC/OC_'.$id_contrato.'_'.$id_oc.'.pdf';
						#$adjunto = 'http://sstt.reif.cl/uploads/OC/OC_'.$id_contrato.'_'.$id_oc.'.pdf';
						#$adjunto = NULL;
						
						#$oldmask = umask(0);
						#chmod($adjunto, 0777);
						#umask($oldmask);
						
						if($this->enviarCorreo($para, $cc = NULL, $nombre_desde, $asunto_c, $cuerpo_c, $adjunto))
							$correo 	= "OK";
						else
							$correo		= "NO1";
							
						
					}
					
						return true;
					
					
				}
				else
				{
					mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
					return false;
				}
				
			}
			else
			{
				mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
				return false;
			}
		}
		else
		{
			mysql_query("ROLLBACK") or die ("Error Rollback: ".mysql_error());
			return false;
		}
			
	}
	
	public function generaOrdenHTML($id_oc)
	{
		$bd = new DB;
		
		$sql = "	SELECT 	* 
					FROM 	orden_compra oc
					WHERE 	oc.id_oc = ".$id_oc;
					
		if(($bd->query($sql)) and ($bd->resultCount() > 0))
		{
			$oc = $bd->fetchObj();
			
			$oc_html = '<table><tr><td>';
			$sql_detalle = "SELECT * FROM detalle_oc WHERE id_oc = ".$id_oc;
			
			if(($bd->query($sql_detalle)) and ($bd->resultCount() > 0))
			{
				$cuantos = $bd->resultCount();
				
				for($i=0; $i<$cuantos; $i++)
				{
					$det = $bd->fetchObj();	
				}
			}
			
				
		}
	}
	
	
	
	public function generaOrdenPDF($id_contrato, $id_oc)
	{
		$bd = new DB;
		
		$sql_param_oc = "	SELECT 	para_oc, atencion_oc, fono_oc, rut_oc 
							FROM	parametros";
							
		if($bd->query($sql_param_oc))
		{
			$det_oc = $bd->fetchObj();
			
			$para_oc 		= $det_oc->para_oc;
			$atencion_oc	= $det_oc->atencion_oc;
			$fono_oc		= $det_oc->fono_oc;
			$rut_oc			= $det_oc->rut_oc;	
			$fecha_oc		= date("Y-m-d");
			
			$sql_oc			= "	SELECT 	*
								FROM	detalle_oc
								WHERE	id_oc = ".$id_oc;
			
			if($bd->query($sql_oc))
			{
				$cuantos = $bd->resultCount();
				$cuerpo_detalle = "";
				
				for($i=0; $i<$cuantos; $i++)
				{
					$det = $bd->fetchObj();
					
					$fila = $i+1;
					
					$cuerpo_detalle 	.= "	<tr>
													<td style='border-bottom: 2px #000 solid; border-right: 2px #000 solid;' >".$fila."</td>
													<td style='border-bottom: 2px #000 solid; border-right: 2px #000 solid;'>".$det->cod_repuesto."</td>
													<td style='border-bottom: 2px #000 solid; border-right: 2px #000 solid;'>".$det->des_repuesto."</td>
													<td style='border-bottom: 2px #000 solid; border-right: 2px #000 solid;'>".$det->cant_repuesto."</td>
													<td style='border-bottom: 2px #000 solid; border-right: 2px #000 solid; text-align:right;'>$ ".number_format($det->prec_repuesto,0,'.','.')."</td>
													<td style='border-bottom: 2px #000 solid; border-right: 2px #000 solid;'>&nbsp;</td>
													<td style='border-bottom: 2px #000 solid; text-align:right;'>$ ".number_format(($det->cant_repuesto * $det->prec_repuesto), 0, '.', '.')."</td>
												</tr>
													
											";
					
				}

				$sql_oc_hd			= "	SELECT 	*
										FROM	orden_compra
										WHERE	id_oc = ".$id_oc;
			
				if($bd->query($sql_oc_hd))
				{
					$oc = $bd->fetchObj();
					
					$sub_total 	= $oc->sub_total;
					$iva		= $oc->iva;
					$total		= $oc->total;
					$obs		= $oc->observaciones;
					
					# get the HTML
					ob_start();
					include('../res/oc.php');
					#include('./res/oc.php');
					$content = ob_get_clean();

					# convert in PDF
					require_once('../html2pdf/html2pdf.class.php');

					#require_once('./html2pdf/html2pdf.class.php');

					try
					{
						#$rutaPDF = dirname(__FILE__).'/../uploads/OC/OC_'.$id_contrato.'_'.$id_oc.'.pdf';
						$rutaPDF = $_SERVER['DOCUMENT_ROOT'].'/uploads/OC/OC_'.$id_contrato.'_'.$id_oc.'.pdf';
						
						$html2pdf = new HTML2PDF('P', 'A4', 'es');
						$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
						
						
						
						$html2pdf->Output($rutaPDF, 'F');
						
						
						$oldmask = umask(0);
						chmod($rutaPDF, 0777);
						umask($oldmask);
						
						return true;
					}
					catch(HTML2PDF_exception $e) {
						echo $e;
						return false;
					}	
				}
				else
					return false;
			}
			else
				return false;
		}
		else
			return false;
		
		
	}
	
	
	public function cambiaEstado($id_contrato, $estado_nuevo)
	{
		$bd = new DB;
		
		$sql = "UPDATE contratos_reparacion SET id_estado = ".$estado_nuevo." WHERE id_contrato = ".$id_contrato;
		
		if($bd->query($sql))	
		{
			session_name('sstt');
			session_start();
			extract($_SESSION);
								
			$this->seguimientoContrato($id_contrato, $userid, $estado_nuevo); 	
			return true;
		}
		else
			return false;
			
	}
	
	
	public function finalizarContrato($id_contrato, $id_respuesta, $otra_respuesta = "")
	{
		$bd = new DB;
		
		#$sql = "UPDATE contratos_reparacion SET observacion_final = '".$observacion_final."', fecha_observacion_final = '".date('Y-m-d H:i:s')."' WHERE id_contrato = ".$id_contrato;
		
		# Se modifica estructura de finalización de contrato. Según requerimiento, se elimina observación final y se deja select con respuestas tipo
		
		$sql = "UPDATE contratos_reparacion SET id_respuesta = ".$id_respuesta.", fecha_respuesta_final = '".date('Y-m-d H:i:s')."', otra_respuesta = '".htmlentities($otra_respuesta)."' WHERE id_contrato = ".$id_contrato;
		
		
		
		if($bd->query($sql))	
		{
			$sql_upd1 	= 	"UPDATE contratos_reparacion SET id_estado = 7 WHERE id_contrato = ".$id_contrato;
		
			if($bd->query($sql_upd1))
			{
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
						$nombre_desde	= "Servicio Tecnico Reifschneider";
						$asunto_c		= "Finalizacion Contrato de Trabajo ".$id_contrato;
											
						$cuerpo_c		= "Estimado(a) ".utf8_encode($cl->nombre).": ";
						$cuerpo_c 		.= "<br><br>Junto con saludar, informamos a usted que con fecha <strong>".date('d-m-Y')."</strong> se ha finalizado su contrato de reparacion N&deg;: ".$id_contrato.".";
						$cuerpo_c		.= "<br>Le solicitamos dirigirse a nuestras oficinas para retirarlo.";
						$cuerpo_c 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
						$cuerpo_c		.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
						
						
						if($this->enviarCorreo($para, $cc = NULL, $nombre_desde, $asunto_c, $cuerpo_c, $adjunto = NULL))
							$correo 	= "OK";
						else
							$correo		= "NO";
					
					}
				}
				return true;
			}
			else
				return false;

		}
		else
			return false;
			
	}
	
	
	public function finalizarOC($num_oc)
	{
		$bd = new DB;
		
		$sql = "SELECT 	c.id_contrato, c.id_usuario  
				FROM 	contratos_reparacion c
				JOIN	presupuesto p ON p.id_contrato = c.id_contrato 
				WHERE 	p.orden_compra = ".$num_oc;
		
		if(($bd->query($sql)) and ($bd->resultCount() > 0))
		{

				$oc 			= $bd->fetchObj();
				$id_contrato 	= $oc->id_contrato;
				$id_usuario		= $oc->id_usuario;
				
				$sql_tecnico = "SELECT nombre, correo FROM usuarios WHERE id_usuario = ".$id_usuario;
					
				if(($bd->query($sql_tecnico)) and ($bd->resultCount() > 0))
				{
					$tecnico = $bd->fetchObj();
					#$sql_upd1 	= 	"UPDATE contratos_reparacion SET id_estado = 6 WHERE id_contrato = ".$id_contrato;
					$sql_upd1 	= 	"UPDATE contratos_reparacion SET id_estado = 9 WHERE id_contrato = ".$id_contrato;
		
					if($bd->query($sql_upd1))
					{
					
						$para 			= array($tecnico->correo);
						$nombre_desde	= "Servicio Tecnico Reifschneider";
						$asunto			= "Repuesto OK Contrato de Trabajo: ".$id_contrato;
						
						$cuerpo			= "Estimado(a) ".utf8_encode($tecnico->nombre).": ";
						$cuerpo 		.= "<br><br>Junto con saludar, informamos que el o los repuestos asociados al contrato de reparacion N&deg;: ".$id_contrato.", ya se encuentran disponibles.<br>Favor retomar el trabajo a la brevedad posible.";
						$cuerpo 		.= "<br><br><br>** Favor no responder, este es un mail generado automaticamente **";
						$cuerpo			.= "<br>** Los acentos fueron eliminados automaticamente para prevenir problemas de incompatibilidad con algunos clientes de correo **";
						
						if($this->enviarCorreo($para, $cc = NULL, $nombre_desde, $asunto, $cuerpo, $adjunto = NULL))
							$correo 	= "OK";
						else
							$correo		= "NO";
							
						return true;
					}
					else
						return false;
				}
				else
					return false;
			
				
		}
		else
			return false;
			
	}
	
	
	public function seguimientoContrato($id_contrato, $id_usuario, $id_estado)
	{
		
		$bd = new DB;
		
		$fecha = date("Y-m-d H:i:s");
		
		$sql = "	INSERT INTO seguimiento_contrato (id_usuario, id_contrato, id_estado, fecha) 
					VALUES
							(
								".$id_usuario.",
								".$id_contrato.",
								".$id_estado.",
								'".$fecha."'
							)
				";
				
		if($bd->query($sql))
			return true;
		else
			return false;
	}
	
}
?>