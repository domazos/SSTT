<script>

$(document).ready(function(e) {
	
	function loading()
	{
		var capaLoading = $('<div class="loading"><img src="/images/loading.gif" width="60" height="60"></div>');	
		capaLoading.appendTo('body');
		
		capaLoading.delay("slow").fadeIn();
		
	}
	
	function loadingOff()
	{
		$('.loading').fadeOut();	
	}

    $('.submit').on('click', function()
	{
		var id 	= $(this).attr('id');
		
		var option_respuestas = '';
			var html_rechazo = '';
		
		if(id == 'acepta_ppto')
		{
			var rebaja = '';
			
			if($('#hay_core').val() == '1')
			{
			
				$.prompt("Acepta dejar sus repuestos en Apple y obtener el descuento informado en su contrato de reparaci&oacute;n?", { 
									
										buttons : { 'SI' : 1, 'NO' : 2, 'Cancelar' : 3 },  
									 
										submit: function(e,v,m,f) 
										{ 
											
											if(v == 1)
												rebaja = 1;
											else if(v == 2)
												rebaja = 0;
											else
											{
												rebaja = 3;
												$.prompt.close();
											}
											
											if((rebaja == 1) || (rebaja == 0))
											{
											
												loading();
												
												$.post('./include/vb_cliente.php', { accion: 'acepta', i: $('#i').val(), descuento: rebaja  }, function(data)
												{
													loadingOff();
													
													if(data == "OK")
													{
														$.prompt("Ha aceptado el presupuesto. <br> Lo mantendremos informado sobre el estado de su contrato", 
																	{ 
																		submit: function(e,v,m,f) 
																		{ 
																			window.location = 'http://www.reifstore.cl'; 
																		} 
																	});		
													}
													else if(data == "CORREO")
													{
														$.prompt("Ha aceptado el presupuesto, pero no hemos podido enviar el correo informando al t&eacute;cnico.<br>Sin embargo, &eacute;l ser&aacute; notificado de manera interna. <br><br> Lo mantendremos informado sobre el estado de su contrato", 
																	{ 
																		submit: function(e,v,m,f) 
																		{ 
																			window.location = 'http://www.reifstore.cl'; 
																		} 
																	});		
													}
												});
											}
											
										} 
									});		
			
			}
			else
			{
				
				rebaja = 0;	
				loading();
												
				$.post('./include/vb_cliente.php', { accion: 'acepta', i: $('#i').val(), descuento: rebaja  }, function(data)
				{
					loadingOff();
					
					if(data == "OK")
					{
						$.prompt("Ha aceptado el presupuesto. <br> Lo mantendremos informado sobre el estado de su contrato", 
									{ 
										submit: function(e,v,m,f) 
										{ 
											window.location = 'http://www.reifstore.cl'; 
										} 
									});		
					}
					else if(data == "CORREO")
					{
						$.prompt("Ha aceptado el presupuesto, pero no hemos podido enviar el correo informando al t&eacute;cnico.<br>Sin embargo, &eacute;l ser&aacute; notificado de manera interna. <br><br> Lo mantendremos informado sobre el estado de su contrato", 
									{ 
										submit: function(e,v,m,f) 
										{ 
											window.location = 'http://www.reifstore.cl'; 
										} 
									});		
					}
				});
			}
			
			
			/*if($('#rebaja_apple').prop('checked'))
				rebaja = 1;
			else
				rebaja = 0;
			*/
			
		}
		else if(id == 'rechaza_ppto')
		{
			loading();
			
			
			// prompt para desplegar respuestas tipo
			
			
			$.post('./include/carga_respuestas_vb.php', function(data)
			{
				option_respuestas = data;	
				
				html_rechazo = '<table><tr><td>Seleccione una respuesta</td><td> : <select name="respuestas" id="respuestas">' + option_respuestas + '</select></td></tr></table>';
			
				
				$.prompt(html_rechazo, { 
								
											buttons : { 'OK' : true, 'Cancelar' : false },
											
											submit: function(e,v,m,f)
											{
													if(v)
													{
												
														$.post('./include/vb_cliente.php', { accion: 'rechaza', i: $('#i').val(), respuesta: f.respuestas }, function(data)
														{
															loadingOff();
															
															if(data == "OK")
															{
																$.prompt("Ha rechazado el presupuesto.", 
																			{ 
																				submit: function(e,v,m,f) 
																				{ 
																					window.location = 'http://www.reifstore.cl'; 
																				} 
																			});		
															}
															else if(data == "CORREO")
															{
																$.prompt("Ha rechazado el presupuesto, pero no hemos podido enviar el correo informando al t&eacute;cnico.<br>Sin embargo, &eacute;l ser&aacute; notificado de manera interna. <br><br> Lo mantendremos informado sobre el estado de su contrato", 
																			{ 
																				submit: function(e,v,m,f) 
																				{ 
																					window.location = 'http://www.reifstore.cl'; 
																				} 
																			});		
															}
														});	
													}
													else
													{
														loadingOff();
														$.prompt.close();
													}
											}
				});
				
				
			
			});
			
			
			
		}
		else
			return false;
	});
	
	
	/*$('#ver_imagenes').on("click", function() {
		
    	$("#imagenes_contrato").fancybox();
		$('.c').click();
       
    });*/
	
});

</script>

<form id="vb_cliente" name="vb_cliente" method="post" action="" style="margin:0 auto;">
<table class="tabla_usuarios_vb">
<tr>
    <td colspan="2">
    	<div class="titulo_cliente">Detalle del Contrato de Reparaci&oacute;n N&deg: {$id_contrato}</div>
    	<input type="hidden" name="i" id="i" value="{$id_contrato}" readonly="readonly" />
    </td>
</tr>
<tr>
	<td colspan="2">
    	<div class="titulo_cliente">{$info.estado_contrado_des}</div>
    </td>
</tr>
<tr>
    <td width="50%">
        <fieldset class="ui-widget ui-corner-all" style="width:99%; height:200px;" id="fieldset_contrato">
        <legend class="legend_field">Datos del Contrato</legend>
            <table class="nuevo_usuario">
            <tr>
                <th width="25%">Num. Serie</th>
                <td><input type="text" name="serie_contrato" id="serie_contrato" value="{$info.num_serie}" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">Modelo</th>
                <td><input type="text" name="modelo_contrato" id="modelo_contrato" value="{$info.modelo}" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">Descripci&oacute;n</th>
                <td><input type="text" name="descripcion_contrato" id="descripcion_contrato" value="{$info.descripcion}" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">Falla seg&uacute;n cliente</th>
                <td><textarea id="falla_cliente_contrato" name="falla_cliente_contrato" cols="23" rows="2" class="text ui-widget-content ui-corner-all" readonly="readonly"  >{$info.falla_cliente}</textarea></td>
            </tr>
            
            
            </table>
        </fieldset>
        
        
    </td>
    <td width="50%">
        <fieldset class="ui-widget ui-corner-all" style="width:99%; height:200px;" id="fieldset_cliente">
        <legend class="legend_field">Datos del Cliente</legend>
            <table class="nuevo_usuario">
            <tr>
                <th width="25%">Nombre</th>
                <td><input type="text" name="nombre_cliente" id="nombre_cliente" value="{$info.nombre_cliente}" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">Tel&eacute;fono</th>
                <td><input type="text" name="telefono_cliente" id="telefono_cliente" value="{$info.telefono_cliente}" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">E-Mail</th>
                <td><input type="text" name="correo_cliente" id="correo_cliente" value="{$info.correo_cliente}" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">Direcci&oacute;n</th>
                <td><input type="text" name="direccion_cliente" id="direccion_cliente" value="{$info.direccion_cliente}" readonly="readonly" style="width:80%;"/></td>
            </tr>
            </table>
        </fieldset>
    
    </td>
</tr>
<tr>
              <td colspan="2">
                  <!-- Fieldset imágenes -->
          <br />
                  <fieldset class="ui-widget ui-corner-all" style="width:100%; margin:0 auto; height:215px;">
                  <legend class="legend_field">Im&aacute;genes Recepci&oacute;n</legend>
                      <table class="nuevo_usuario">
                      <tr>
                          <td><div id="listado_imagenes_recep_ver" class="listado_img">{$info.imagenes_recep}</div></td>
                      </tr>
                      </table>
                  </fieldset>
                  
                  <!-------------------------------------->
              </td>
      	</tr>
</table>
<br />
<table class="tabla_usuarios_vb">
<tr>
	<td>
<fieldset class="ui-widget ui-corner-all" style="width:99%;" id="fieldset_cliente">
        	<legend class="legend_field">Diagn&oacute;stico</legend>
                <table class="nuevo_usuario">
                <tr>
                    <td width="50%">
                        <table class="nuevo_usuario">
                        <tr>
                            <th width="50%">&iquest;Aplica Garant&iacute;a?</th>
                            <td> 
                                <div id="garantia" style="width:50%;">
                                    {if $info.aplica_garantia == '1'}
                                        <input type="text" value="SI" class="text ui-widget-content ui-corner-all" readonly="readonly" />
                                    {else}
                                        <input type="text" value="NO" class="text ui-widget-content ui-corner-all" readonly="readonly" />
                                    {/if}   
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="nuevo_usuario">
                                <tr>
                                    <th width="50%">Fecha Diagn&oacute;stico</th>
                                    <td><input type="text" id="fecha_inicio_dc" name="fecha_inicio_dc" value="{$info.fecha_inicio_d}" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                                </tr>
                                <tr>
                                    <th width="50%">Respuesta</th>
                                    <td><input type="text" value="{$info.respuesta}" class="text ui-widget-content ui-corner-all" readonly="readonly" style="width:auto; padding:3px;" /></td>
                                </tr>
                                {if ($info.otra_respuesta != '') }
                                <tr>
                                    <th width="50%">Detalle Respuesta</th>
                                    <td><textarea id="observacion_otra_respuesta" name="observacion_otra_respuesta" cols="23" rows="2" class="text ui-widget-content ui-corner-all" readonly="readonly" >{$info.otra_respuesta}</textarea></td>
                                </tr>
                                {/if}
                                                                
                                </table>
                            </td>
                        </tr>
                        
                        </table>
                    </td>
                    <td width="50%">
                    	<table class="nuevo_usuario">
                        <tr>
							<td colspan="2">
                                <!-- Fieldset imágenes -->
                        
                                <fieldset class="ui-widget ui-corner-all" style="width:85%; margin:0 auto; height:160px;">
                                <legend class="legend_field">Im&aacute;genes del Diagn&oacute;stico</legend>
                                <table class="nuevo_usuario">
                                <tr>
                                	<td><div id="listado_imagenes_recep" class="listado_img">{$info.imagenes}</div></td>
                                </tr>
                                </table>
                                </fieldset>
                                
                                <!-------------------------------------->
                          	</td>
                   		</tr>
                        </table>
                        
                         
                    </td>
                </tr>
                </table>
   		</fieldset>

</td>
</tr>
<tr>
	<td>
    <br />
    	<fieldset class="ui-widget ui-corner-all" style="width:99%;" id="fieldset_repuestos">
        	<legend class="legend_field">Presupuesto</legend>
            	<table class="nuevo_usuario">
                <tr>
                	<th width="25%">Fecha Presupuesto</th>
                    <td><input type="text" id="fecha_ppto" name="fecha_ppto" value="{$info.fecha_ppto}" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                </tr>
                <tr>
                    <th>Observaciones</th>
                    <td><textarea id="observaciones_ppto" name="observaciones_ppto" cols="23" rows="2" class="text ui-widget-content ui-corner-all" readonly="readonly" >{$info.obs_ppto}</textarea></td>
                </tr>
                </table>
                
                <br />
                {if $info.aplica_garantia == 1}
                	<fieldset class="ui-widget ui-corner-all" style="width:80%; margin:0 auto;" id="fieldset_repuestos">
                {else}
                	<fieldset class="ui-widget ui-corner-all" style="width:90%; margin:0 auto;" id="fieldset_repuestos">
                {/if}
        		<legend class="legend_field">Repuestos</legend>
                <!--<div id="lista_repuestos" style="margin:0 auto; {if $info.aplica_garantia == 1} width:80%; {else} width:90%; {/if}">-->
                
                <div id="lista_repuestos" style="margin:0 auto; width:100%;">
                	<!-- CORE -->
                    {assign var="hay_core" value=0}
                    {assign var="alinear" value="left"}
                    
                    {for $i=0 to count($info.repuestos) -1}
                        {if $info.repuestos[$i]['core_repuesto'] != '$ 0'}
                            {$hay_core = $hay_core+1}
                        
                        {/if}
                    {/for}
                	
                    <!---------->
                    
                    {if $hay_core > 0}
                    <input type="hidden" id="hay_core" name="hay_core" value="1" />
                	<div style="width:85%; margin:0 auto; text-align:center;">
                    	<br /> Uno o m&aacute;s de los repuestos que se encuentran dentro de su presupuesto que cuentan con una alternativa de descuento. Este descuento lo puede ver como &quot;Unit. Core&quot; y &quot;Total Core&quot; <br />
                		Para poder optar a este descuento, debe presionar el bot&oacute;n &quot;Aceptar Presupuesto&quot; y luego presionar el bot&oacute;n &quot;SI&quot; en el pop-up que le aparecer&aacute;.
                		<br /><br /><br />
                    </div>
                	{else}
                    	<input type="hidden" id="hay_core" name="hay_core" value="0" />
                    	{$alinear = 'center'}
                    {/if}
                    
                    <table class="nuevo_usuario">
                    <tr>
                        <td>
                            <table class="nuevo_usuario" id="tabla_repuestos">
                            <tbody>
                            <tr>
                                <th width="25%">Cod. Repuesto</th>
                                <th width="25%">Descripci&oacute;n</th>
                                <th width="15%">Cantidad</th>
                                {if $info.aplica_garantia == 0}
                                    <th width="15%">Unitario</th>
                                    <th width="15%">Total</th>
                                    <!-- CORE -->

                                        {if $hay_core > 0}
                                        	<th width="15%">Unit. Core</th>
                                    		<th width="15%">Total Core</th>
                                        {/if}
                                   	<!----------->
                                {/if}
                            </tr>
                            
                            {assign var="sub_total_core" value=0}
                            {assign var="iva_core" value=0}
                            {assign var="total_core" value=0}
                                
                            {for $i=0 to count($info.repuestos) -1}
                            	
                                {if $info.repuestos[$i]['core_repuesto'] != '$ 0'}
                            		{$sub_total_core 	= ($info.repuestos[$i]['total_core_limpio'] + $sub_total_core)}
                                {else}
                                	{$sub_total_core 	= ($info.repuestos[$i]['total_core_limpio'] + $sub_total_core) + $info.repuestos[$i]['total_repuesto_limpio']}
                                {/if}

                            	<tr>
                               		<td align="center"><input type="text" value="{$info.repuestos[$i]['cod_repuesto']}" readonly="readonly" style="text-align:center; width:100px;" /></td>
                                    <td align="center"><input type="text" value="{$info.repuestos[$i]['des_repuesto']}" readonly="readonly" style="text-align:center; width:200px;" title="{$info.repuestos[$i]['des_repuesto']}"   /></td>
                                    <td align="center"><input type="text" value="{$info.repuestos[$i]['cant_repuesto']}" readonly="readonly" style="text-align:center; width:40px;" /></td>
                                    {if $info.aplica_garantia == 0}
                                    	<td align="center"><input type="text" value="{$info.repuestos[$i]['precio_repuesto']}" readonly="readonly" style="text-align:right; width:80px;" /></td>
                                        <td align="center"><input type="text" value="{$info.repuestos[$i]['total_repuesto']}" readonly="readonly" style="text-align:right; width:80px;" /></td>
                                        
                                        <!-- CORE -->
                                        {if $hay_core > 0}
                                            {if $info.repuestos[$i]['core_repuesto'] != '$ 0'}
                                                <td align="center"><input type="text" value="{$info.repuestos[$i]['core_repuesto']}" readonly="readonly" style="text-align:right; width:80px;" /></td>
                                                <td align="center"><input type="text" value="{$info.repuestos[$i]['total_core']}" readonly="readonly" style="text-align:right; width:80px;" /></td>
                                            {else}
                                                <td align="center"><input type="text" value="$ 0" readonly="readonly" style="text-align:right; width:80px;" /></td>
                                                <td align="center"><input type="text" value="$ 0" readonly="readonly" style="text-align:right; width:80px;" /></td>
                                            {/if}
                                     	{/if}
                                        <!---------->
                                    {/if}
                                </tr>
                            {/for}
                            
                            {$iva_core = $sub_total_core * 0.19}
                            {$total_core = $sub_total_core + $iva_core}
            
                            </tbody>
                            <tfoot>
                            <tr height="30px">
                            	{*if $info.aplica_garantia == 0*}
                            		<!--<th colspan="4">
                                
                                	<table class="nuevo_usuario">
                                    <tr height="30px">
                                    -->    
                                <th colspan="4" align="right">Sub Total</th>
                                <td align="{$alinear}" colspan="2">
                                    <input type="text" name="sub_total" id="sub_total" value="{$info.sub_total}" style="width:80px; text-align:right;" readonly="readonly"></td>
                                    
                                <!-- CORE -->
                                {if $hay_core > 0}
                                <td align="left">
                                    <input type="text" name="sub_total_core" id="sub_total_core" value="$ {number_format($sub_total_core,0,'.','.')}" style="width:80px; text-align:right;" readonly="readonly">                          
                                </td>                                        
                                {/if}
                                <!---------->
                                            
                           	</tr>
                            <tr height="30px">
                                <th colspan="4" align="right">Iva</th>
                                <td align="{$alinear}" colspan="2">
                                    <input type="text" name="iva" id="iva" value="{$info.iva}" style="width:80px; text-align:right;" readonly="readonly">
                                </td>
                                
                                <!-- CORE -->
                                {if $hay_core > 0}
                                <td align="left">
                                    <input type="text" name="iva_core" id="iva_core" value="$ {number_format($iva_core,0,'.','.')}" style="width:80px; text-align:right;" readonly="readonly">
                                </td>
                                {/if}
                                <!---------->
                            </tr>
                            <tr height="30px">
                                <th colspan="4" align="right">Total a Pagar</th>
                                <td align="{$alinear}" colspan="2">
                                    <input type="text" name="total_pagar" id="total_pagar" value="{$info.total_pagar}" style="width:80px; text-align:right;" readonly="readonly">                           		</td>
                                    
                                <!-- CORE -->
                                {if $hay_core > 0}
                                <td align="left">
                                    <input type="text" name="total_pagar_core" id="total_pagar_core" value="$ {number_format($total_core,0,'.','.')}" style="width:80px; text-align:right;" readonly="readonly">                           		
                              	</td>
                                {/if}
                                <!---------->
                                    
                            </tr>
                            <!--        </table>
                             	</th>
                            -->  
                              {*/if*}
                          	<!--</tr>-->
                            {*if $info.aplica_garantia == 1*}
                            <!--<tr height="30px">
                                        <th align="right" colspan="2">Total a Pagar</th>
                                        <td align="center">
                                            <input type="text" name="total_pagar" id="total_pagar" value="$ 0" style="width:80px; text-align:right;" readonly="readonly">                           				</td>
                            </tr>-->
                            {*/if*}
                            </tfoot>
                            </table>
                        </td>
                    </tr>
                    
                    
                    </table>
              	</div>
                </fieldset>
                <br>
		</fieldset>
    
    
    </td>
</tr>
</table>

<br>


{if $info.estado_contrato == 2}
<table class="nuevo_usuario" style="width:25%;">
<tr>
	<td><input type="button" id="acepta_ppto" name="acepta_ppto" value="Aceptar Presupuesto" class="submit"></td>
    <td><input type="button" id="rechaza_ppto" name="rechaza_ppto" value="Rechazar Presupuesto" class="submit"></td>
</tr>
</table>
{/if}
<br><br>
</form>