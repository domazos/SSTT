<?php /* Smarty version Smarty-3.1.19, created on 2015-12-18 15:20:38
         compiled from ".\views\vb_cliente.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13322563802ab3e6f29-78060029%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '23ee16f159343889f76368e80fcbcd49ae740c69' => 
    array (
      0 => '.\\views\\vb_cliente.tpl',
      1 => 1450448129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13322563802ab3e6f29-78060029',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_563802ab43a732_37952722',
  'variables' => 
  array (
    'id_contrato' => 0,
    'info' => 0,
    'contact' => 0,
    'key' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_563802ab43a732_37952722')) {function content_563802ab43a732_37952722($_smarty_tpl) {?><script>

$(document).ready(function(e) {
    $('.submit').on('click', function()
	{
		var id 	= $(this).attr('id');
		
		if(id == 'acepta_ppto')
		{
			var rebaja;
			
			if($('#rebaja_apple').prop('checked'))
				rebaja = 1;
			else
				rebaja = 0;
			
			$.post('./include/vb_cliente.php', { accion: 'acepta', i: $('#i').val(), descuento: rebaja  }, function(data)
			{
				
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
		else if(id == 'rechaza_ppto')
		{
			$.post('./include/vb_cliente.php', { accion: 'rechaza', i: $('#i').val() }, function(data)
			{
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
    	<div class="titulo_cliente">Detalle del Contrato de Reparaci&oacute;n N&deg: <?php echo $_smarty_tpl->tpl_vars['id_contrato']->value;?>
</div>
    	<input type="hidden" name="i" id="i" value="<?php echo $_smarty_tpl->tpl_vars['id_contrato']->value;?>
" readonly="readonly" />
    </td>
</tr>
<tr>
    <td width="50%">
        <fieldset class="ui-widget ui-corner-all" style="width:99%; height:200px;" id="fieldset_contrato">
        <legend class="legend_field">Datos del Contrato</legend>
            <table class="nuevo_usuario">
            <tr>
                <th width="25%">Num. Serie</th>
                <td><input type="text" name="serie_contrato" id="serie_contrato" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['num_serie'];?>
" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">Modelo</th>
                <td><input type="text" name="modelo_contrato" id="modelo_contrato" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['modelo'];?>
" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">Descripci&oacute;n</th>
                <td><input type="text" name="descripcion_contrato" id="descripcion_contrato" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['descripcion'];?>
" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">Falla seg&uacute;n cliente</th>
                <td><textarea id="falla_cliente_contrato" name="falla_cliente_contrato" cols="23" rows="2" class="text ui-widget-content ui-corner-all" readonly="readonly"  ><?php echo $_smarty_tpl->tpl_vars['info']->value['falla_cliente'];?>
</textarea></td>
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
                <td><input type="text" name="nombre_cliente" id="nombre_cliente" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['nombre_cliente'];?>
" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">Tel&eacute;fono</th>
                <td><input type="text" name="telefono_cliente" id="telefono_cliente" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['telefono_cliente'];?>
" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">E-Mail</th>
                <td><input type="text" name="correo_cliente" id="correo_cliente" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['correo_cliente'];?>
" readonly="readonly" /></td>
            </tr>
            <tr>
                <th width="25%">Direcci&oacute;n</th>
                <td><input type="text" name="direccion_cliente" id="direccion_cliente" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['direccion_cliente'];?>
" readonly="readonly" style="width:80%;"/></td>
            </tr>
            </table>
        </fieldset>
    
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
                                    <?php if ($_smarty_tpl->tpl_vars['info']->value['aplica_garantia']=='1') {?>
                                        <input type="text" value="SI" class="text ui-widget-content ui-corner-all" readonly="readonly" />
                                    <?php } else { ?>
                                        <input type="text" value="NO" class="text ui-widget-content ui-corner-all" readonly="readonly" />
                                    <?php }?>   
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="nuevo_usuario">
                                <tr>
                                    <th width="50%">Fecha Diagn&oacute;stico</th>
                                    <td><input type="text" id="fecha_inicio_dc" name="fecha_inicio_dc" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['fecha_inicio_d'];?>
" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                                </tr>
                                <tr>
                                    <th width="50%">Respuesta</th>
                                    <td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['respuesta'];?>
" class="text ui-widget-content ui-corner-all" readonly="readonly" style="width:auto; padding:3px;" /></td>
                                </tr>
                                <?php if (($_smarty_tpl->tpl_vars['info']->value['otra_respuesta']!='')) {?>
                                <tr>
                                    <th width="50%">Detalle Respuesta</th>
                                    <td><textarea id="observacion_otra_respuesta" name="observacion_otra_respuesta" cols="23" rows="2" class="text ui-widget-content ui-corner-all" readonly="readonly" ><?php echo $_smarty_tpl->tpl_vars['info']->value['otra_respuesta'];?>
</textarea></td>
                                </tr>
                                <?php }?>
                                <tr>
                                    <th>Diagn&oacute;stico</th>
                                    <td><textarea id="diagnostico_cliente" name="diagnostico_cliente" cols="23" rows="2" class="text ui-widget-content ui-corner-all" readonly="readonly" ><?php echo $_smarty_tpl->tpl_vars['info']->value['diag_cliente'];?>
</textarea></td>
                                </tr>                                
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
                                	<td><div id="listado_imagenes" class="listado_img"><?php echo $_smarty_tpl->tpl_vars['info']->value['imagenes'];?>
</div></td>
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
                    <td><input type="text" id="fecha_ppto" name="fecha_ppto" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['fecha_ppto'];?>
" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                </tr>
                <tr>
                    <th>Observaciones</th>
                    <td><textarea id="observaciones_ppto" name="observaciones_ppto" cols="23" rows="2" class="text ui-widget-content ui-corner-all" readonly="readonly" ><?php echo $_smarty_tpl->tpl_vars['info']->value['obs_ppto'];?>
</textarea></td>
                </tr>
                </table>
                
                <br />
                <?php if ($_smarty_tpl->tpl_vars['info']->value['aplica_garantia']==1) {?>
                	<fieldset class="ui-widget ui-corner-all" style="width:80%; margin:0 auto;" id="fieldset_repuestos">
                <?php } else { ?>
                	<fieldset class="ui-widget ui-corner-all" style="width:90%; margin:0 auto;" id="fieldset_repuestos">
                <?php }?>
        		<legend class="legend_field">Repuestos</legend>
                <div id="lista_repuestos" style="margin:0 auto; <?php if ($_smarty_tpl->tpl_vars['info']->value['aplica_garantia']==1) {?> width:80%; <?php } else { ?> width:90%; <?php }?>">
                    <table class="nuevo_usuario">
                    <tr>
                        <td>
                            <table class="nuevo_usuario" id="tabla_repuestos">
                            <tbody>
                            <tr>
                                <th width="25%">Cod. Repuesto</th>
                                <th width="25%">Descripci&oacute;n</th>
                                <th width="15%">Cantidad</th>
                                <?php if ($_smarty_tpl->tpl_vars['info']->value['aplica_garantia']==0) {?>
                                    <th width="15%">Unitario</th>
                                    <th width="15%">Total</th>
                                <?php }?>
                            </tr>
                            <?php  $_smarty_tpl->tpl_vars['contact'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['contact']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['info']->value['repuestos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['contact']->key => $_smarty_tpl->tpl_vars['contact']->value) {
$_smarty_tpl->tpl_vars['contact']->_loop = true;
?>
                         		<tr>
                                	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['contact']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                    	<?php if (($_smarty_tpl->tpl_vars['key']->value=='cant_repuesto')) {?>
                                	    	<td align="center"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
" readonly="readonly" style="text-align:center; width:80px;" /></td>
                                        <?php } elseif ((($_smarty_tpl->tpl_vars['key']->value=='precio_repuesto')||($_smarty_tpl->tpl_vars['key']->value=='total_repuesto'))&&($_smarty_tpl->tpl_vars['info']->value['aplica_garantia']==1)) {?>
                                        	<td>&nbsp;</td>
                                        <?php } elseif ((($_smarty_tpl->tpl_vars['key']->value=='precio_repuesto')||($_smarty_tpl->tpl_vars['key']->value=='total_repuesto'))&&($_smarty_tpl->tpl_vars['info']->value['aplica_garantia']==0)) {?>
                                        	<td align="center"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
" readonly="readonly" style="text-align:right; width:80px;" /></td>
                                        <?php } elseif (($_smarty_tpl->tpl_vars['key']->value!='tipo_repuesto')) {?>
                                        	<td align="center"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
" readonly="readonly" /></td>
                                        <?php }?>
                                	<?php } ?>
                                </tr>
                            <?php } ?>
            
                            </tbody>
                            <tfoot>
                            <tr>
                            	<?php if ($_smarty_tpl->tpl_vars['info']->value['aplica_garantia']==0) {?>
                            		<th colspan="5">
                                
                                	<table class="nuevo_usuario">
                                    <tr height="30px">
                                        <th colspan="4" align="right">Sub Total</th>
                                        <td align="center" width="15%">
                                            <input type="text" name="sub_total" id="sub_total" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['sub_total'];?>
" style="width:80px; text-align:right;" readonly="readonly">                            			</td>
                                    </tr>
                                    <tr height="30px">
                                        <th colspan="4" align="right">Iva</th>
                                        <td align="center">
                                            <input type="text" name="iva" id="iva" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['iva'];?>
" style="width:80px; text-align:right;" readonly="readonly">
                                        </td>
                                    </tr>
                                    <tr height="30px">
                                        <th colspan="4" align="right">Total a Pagar</th>
                                        <td align="center">
                                            <input type="text" name="total_pagar" id="total_pagar" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['total_pagar'];?>
" style="width:80px; text-align:right;" readonly="readonly">                           				</td>
                                    </tr>
                                    </table>
                             	</th>
                              
                              <?php }?>
                          	</tr>
                            <?php if ($_smarty_tpl->tpl_vars['info']->value['aplica_garantia']==1) {?>
                            <tr height="30px">
                                        <th align="right" colspan="2">Total a Pagar</th>
                                        <td align="center">
                                            <input type="text" name="total_pagar" id="total_pagar" value="$ 0" style="width:80px; text-align:right;" readonly="readonly">                           				</td>
                            </tr>
                            <?php }?>
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

<table class="nuevo_usuario" style="width:33%;">
<tr>
	<td><input type="checkbox" id="rebaja_apple" name="rebaja_apple"> Acepto dejar mis repuestos en Apple y obtener un descuento en mi contrato de reparaci&oacute;n. </td>
</tr>
</table>

<table class="nuevo_usuario" style="width:25%;">
<tr>
	<td><input type="button" id="acepta_ppto" name="acepta_ppto" value="Aceptar Presupuesto" class="submit"></td>
    <td><input type="button" id="rechaza_ppto" name="rechaza_ppto" value="Rechazar Presupuesto" class="submit"></td>
</tr>
</table>
<br><br>
</form><?php }} ?>
