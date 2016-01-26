<?php /* Smarty version Smarty-3.1.19, created on 2015-12-18 05:34:50
         compiled from ".\views\gestion_contratos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14872562beed2c39cf5-20391098%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88393e37250228a1f08e58cf219bf59cc1c7c8d7' => 
    array (
      0 => '.\\views\\gestion_contratos.tpl',
      1 => 1450413252,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14872562beed2c39cf5-20391098',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_562beed2d45a41_00941422',
  'variables' => 
  array (
    'cuantos_contratos' => 0,
    'i' => 0,
    'contratos' => 0,
    'tipo_usuario' => 0,
    'tipos_cliente' => 0,
    'regiones' => 0,
    'tipo_contrato' => 0,
    'familias' => 0,
    'id_tecnico' => 0,
    'tecnico_asignado' => 0,
    'respuesta_tipo' => 0,
    'estados_ppto' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562beed2d45a41_00941422')) {function content_562beed2d45a41_00941422($_smarty_tpl) {?><table class="tabla_contratos">
<tr>
	<td align="left"><a href="./panel_gestion.php"><img src="./images/back.png" /> &nbsp; Volver</a></td>
	<td align="right"><input type="button" id="nuevo_contrato" value="Crear Nuevo Contrato" /></td>
</tr>
<tr>
    <td colspan="2">

    	<?php if (($_smarty_tpl->tpl_vars['cuantos_contratos']->value<=0)) {?>
        	<div class="mensaje_no">No existen contratos para mostrar</div>
        <?php } else { ?>

            <table id="filters" class="tablesorter-metro-dark">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="15%">Fecha Recepci&oacute;n</th>
                    <th width="15%">Fecha Est. Diag.</th>
                    <th width="15%">Fecha Est. Entrega</th>
                    <th>Cliente</th>
                    <th>Estado Contrato</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
				<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['cuantos_contratos']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['cuantos_contratos']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_contrato;?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->fecha_recepcion;?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->fecha_tent_diagnostico;?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->fecha_tent_entrega;?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->nombre_cliente;?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->estado_contrato;?>
</td>
                        <td align="left">
                        	
                            <?php if (($_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_estado==7)) {?>
                            	<span class="ver">
                                	<a href="#" id="<?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_contrato;?>
" class="ver_contrato" title="Ver Contrato">&nbsp;</a>
                               	</span>
                            <?php } else { ?>
                            	<input type="hidden" id="diagnostico_<?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_contrato;?>
" value="<?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_contrato;?>
" />
                            	
                                <?php if (($_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_estado==1)) {?>
                                <span class="diagnostico">
                                	<a href="#" id="<?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_contrato;?>
" class="diagnostico_contrato" title="Diagn&oacute;stico Contrato">&nbsp;</a>
                               	</span>
                                <?php }?>
                                
                                <?php if (($_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_diagnostico!=0)) {?>
                                <span class="enviar_ppto">
                                	<a href="#" id="<?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_contrato;?>
" class="enviar_presupuesto" title="Enviar Diagn&oacute;stico y PPTO Contrato">&nbsp;</a>
                               	</span>
                                <?php }?>
                                <span class="ver">
                                	<a href="#" id="<?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_contrato;?>
" class="ver_contrato" title="Ver Contrato">&nbsp;</a>
                               	</span>
                                
                                <?php if ((($_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_estado==3)&&($_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->aplica_garantia==0))) {?>
                                <span class="pagar">
                                	<a href="#" id="<?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_contrato;?>
" class="pagar_contrato" title="Pagar PPTO Contrato">&nbsp;</a>
                               	</span>
                                <?php }?>
                                <?php if ((($_smarty_tpl->tpl_vars['tipo_usuario']->value==1)||($_smarty_tpl->tpl_vars['tipo_usuario']->value==2))) {?>
                                <span class="estado">
                                	<a href="#" id="<?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_contrato;?>
" class="estado_contrato" title="Cambiar Estado Contrato">&nbsp;</a>
                               	</span>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_estado==6)) {?>
                                <span class="terminar">
                                	<a href="#" id="<?php echo $_smarty_tpl->tpl_vars['contratos']->value[$_smarty_tpl->tpl_vars['i']->value]->id_contrato;?>
" class="finalizar_contrato" title="Finalizar Contrato">&nbsp;</a>
                               	</span>
                                <?php }?>
                            <?php }?>    
                        </td>
                        
                    </tr>
             	<?php }} ?>
            </tbody>
            <tfoot>
            	<tr>
            	<td colspan="7">
                	<div id="pager" class="pager tablesorter-metro-dark">
                        <form>
                            <img src="./js/tablesorter-master/addons/pager/icons/first.png" class="first"/>
                            <img src="./js/tablesorter-master/addons/pager/icons/prev.png" class="prev"/>
                            <input type="text" class="pagedisplay"/>
                            <img src="./js/tablesorter-master/addons/pager/icons/next.png" class="next"/>
                            <img src="./js/tablesorter-master/addons/pager/icons/last.png" class="last"/>
                            <select class="pagesize" id="pager_select">
                                <option selected="selected"  value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option  value="40">40</option>
                            </select>
                        </form>
                    </div>
              	</td>
           		</tr>
            </tfoot>
            </table>
		<?php }?>	                
    </td>
</tr>
</table>


<!-- HTML para dialog "Crear Contrato" -->

<div id="dialog-contrato-new" title="Crear Nuevo Contrato">
	<form id="nuevo_contrato_frm" name="nuevo_contrato_frm" method="post" action="" class="ui-front">
    	<input type="hidden" name="accion" id="accion" value="guardar" />
        <fieldset class="ui-widget ui-corner-all" style="width:99%;" id="fieldset_cliente">
        <legend class="legend_field">Datos del Cliente</legend>
  		<input type="hidden" name="id_cliente" id="id_cliente" value="0" />
        <table class="nuevo_usuario">
        <tr>
        	<td width="50%">
            	<table width="100%">
                <tr>
                    <th width="25%">Cliente</th>
                    <td><input type="text" name="cliente_contrato" id="cliente_contrato" value="" /><span class="comentario">Puedes buscar por Rut, C&oacute;digo o Nombre de cliente</span></td>
                </tr>
                <tr>
                	<th width="25%"><label for="tipo_cliente_contrato">Tipo Cliente</label></th>
                    <td width="75%">
                    	<select name="tipo_cliente_contrato" id="tipo_cliente_contrato" style="width:auto;" required \>
                    		<?php echo $_smarty_tpl->tpl_vars['tipos_cliente']->value;?>

                        </select>
                    
                    </td>
              	</tr>
                <tr id="rut_cliente_tr_contrato">
                	<th><label for="rut_cliente_contrato">RUT</label></th>
                    <td><input type="text" name="rut_cliente_contrato" id="rut_cliente_contrato" value="" class="text ui-widget-content ui-corner-all" required \></td>
              	</tr>
                <tr id="cod_cliente_tr_contrato" style="display:none;">
                	<th><label for="cod_cliente_contrato">Cod. Cliente</label></th>
                    <td><input type="text" name="cod_cliente_contrato" id="cod_cliente_contrato" value="0" class="text ui-widget-content ui-corner-all" readonly="readonly" \></td>
              	</tr>
                <tr id="tienda_tr_contrato" style="display:none;">
                	<th><label for="tienda_cliente_contrato">Tienda Cliente</label></th>
                    <td><select name="tienda_cliente_contrato" id="tienda_cliente_contrato" style="width:auto;" \>
                    		<option value="0">0</option>
                        </select></td>
              	</tr>
                <tr>
                	<th><label for="nombre_cliente_contrato">Nombre</label></th>
                    <td><input type="text" name="nombre_cliente_contrato" id="nombre_cliente_contrato" value="" class="text ui-widget-content ui-corner-all" required \></td>
              	</tr>
                 <tr>
                    <th><label for="contacto_cliente_contrato">Contacto</label></th>
                    <td><input type="text" name="contacto_cliente_contrato" id="contacto_cliente_contrato" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
                <tr>
                    <th><label for="direccion_cliente_contrato">Direcci&oacute;n</label></th>
                    <td><input type="text" name="direccion_cliente_contrato" id="direccion_cliente_contrato" value="" class="text ui-widget-content ui-corner-all" required ></td>
                </tr>
         		</table>
          	</td>
            <td width="50%">
            	<table width="100%">
                <tr>
                	<th width="25%"><label for="region_cliente_contrato">Regi&oacute;n</label></th>
                    <td width="75%">
                    	<select name="region_cliente_contrato" id="region_cliente_contrato" style="width:auto;" required \>
                    		<?php echo $_smarty_tpl->tpl_vars['regiones']->value;?>
	
                        </select>
                       </td>
               	</tr>
                <tr>
                	<th><label for="comuna_cliente_contrato">Comuna</label></th>
                    <td>
                    	<select name="comuna_cliente_contrato" id="comuna_cliente_contrato" style="width:auto;" required \>
                    		<option value="">[Selecciona una Comuna]</option>
                        </select>
                    
                    </td>
               	</tr>
                <tr>
                    <th><label for="correo_cliente_contrato">Correo</label></th>
                    <td><input type="text" name="correo_cliente_contrato" id="correo_cliente_contrato" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
               
               	<tr>
                    <th><label for="telefono_cliente_contrato">Tel&eacute;fono</label></th>
                    <td><input type="text" name="telefono_cliente_contrato" id="telefono_cliente_contrato" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
                <tr>
                    <th><label for="celular_cliente_contrato">Celular</label></th>
                    <td><input type="text" name="celular_cliente_contrato" id="celular_cliente_contrato" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
                <tr>    
             		<th colspan="2">
                    	
                    	<input type="button" name="limpiar_cliente_contrato" id="limpiar_cliente_contrato" value="Limpiar Campos" tabindex="-1" >
                  	</th>
                    
                </tr>
                </table>
            </td>       
        </tr>
        
        </table>
        </fieldset>
        
        
        <!-- Fieldset para datos del contrato -->
        
        <fieldset class="ui-widget ui-corner-all" style="width:99%;">
        <legend class="legend_field">Datos del Contrato</legend>
  		<table class="nuevo_usuario">
        <tr>
        	<td width="50%">
            	<table class="nuevo_usuario">
                	<tr>
                        <th width="40%">Tipo de Ingreso</th>
                        <td>
                            <select id="tipo_ingreso" name="tipo_ingreso" style="width:auto;">
                                <?php echo $_smarty_tpl->tpl_vars['tipo_contrato']->value;?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha Recepci&oacute;n</th>
                        <td><input type="text" id="fecha_recepcion" name="fecha_recepcion" value="" class="text ui-widget-content ui-corner-all" required /></td>
                    </tr>
                    <tr>
                        <th>Familia</th>
                        <td>
                            <select id="familia_contrato" name="familia_contrato" style="width:auto;">
                                <?php echo $_smarty_tpl->tpl_vars['familias']->value;?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><span id="serie_sku">Num. Serie</span></th>
                        <td><input type="text" id="num_serie" name="num_serie" value="" class="text ui-widget-content ui-corner-all" required /></td>
                    </tr>
                    
                    <tr id="modelo_tr">
                        <th>Modelo</th>
                        <td><input type="text" id="modelo" name="modelo" value="" class="text ui-widget-content ui-corner-all" required /></td>
                    </tr>
                    
                    <tr>
                        <th>Descripci&oacute;n</th>
                        <td><input type="text" id="descripcion" name="descripcion" value="" class="text ui-widget-content ui-corner-all" required /></td>
                    </tr>
                    
                    <tr id="garantia_tr">
                        <th>Garant&iacute;a</th>
                        <td>
                            <div id="chk_garantia">
                                <input type="radio" id="si" name="garantia" value="si"><label for="si">Si</label>
                                <input type="radio" id="no" name="garantia" value="no" checked="checked"><label for="no">No</label>
                            </div>
                        </td>
                    </tr>
                    <tr id="busca_iphone_tr">
                        <th>Buscar Mi iPhone</th>
                        <td>
                            <div id="chk_buscar">
                                <input type="radio" id="si_b" name="buscar_iphone" value="si_b"><label for="si_b">Si</label>
                                <input type="radio" id="no_b" name="buscar_iphone" value="no_b" checked="checked"><label for="no_b">No</label>
                            </div>
                        </td>
                    </tr>
                    <tr id="marca_tr" style="display:none;">
                        <th>Marca</th>
                        <td><input type="text" id="marca" name="marca" value="0" class="text ui-widget-content ui-corner-all" required /></td>
                    </tr>
                
                </table>
            </td>
            
            
            <td width="50%">
            	<table class="nuevo_usuario">
                	<tr>
                    	<th colspan="2">
                        	<fieldset class="ui-widget ui-corner-all" style="width:89%; padding: 2%;">
       							<legend class="legend_field">Descripci&oacute;n fisica</legend>
                    			<div class="desc_fisica">
                                <input type="checkbox" id="rayas" name="rayas" checked="checked" /><label for="rayas">Rayas</label>
                                <input type="checkbox" id="golpes" name="golpes" checked="checked" /><label for="golpes">Golpes</label>
                                <input type="checkbox" id="abolladuras" name="abolladuras" checked="checked" /><label for="abolladuras">Abolladuras</label>
                                <input type="checkbox" id="marcas" name="marcas" checked="checked" /><label for="marcas">Marcas</label>
                                <input type="checkbox" id="liquido" name="liquido" checked="checked" /><label for="liquido">Da&ntilde;o por l&iacute;quido</label>
                                <input type="checkbox" id="intervenido" name="intervenido" checked="checked" /><label for="intervenido">Intervenido</label>
                                
                                </div>    		
                            </fieldset>
                        </th>
                   	</tr>
                    <tr>
                    	<th width="40%">Observaciones</th>
                        <td><textarea id="falla_cliente" name="falla_cliente" cols="23" rows="3" class="text ui-widget-content ui-corner-all" required ></textarea></td>
                    </tr>
                    <tr>
                    	<th>T&eacute;cnico Asignado</th>
                        <td><input type="hidden" id="id_tecnico" name="id_tecnico" value="<?php echo $_smarty_tpl->tpl_vars['id_tecnico']->value;?>
">
                        	<input type="text" id="tecnico_asignado" name="tecnico_asignado" value="<?php echo $_smarty_tpl->tpl_vars['tecnico_asignado']->value;?>
" class="text ui-widget-content ui-corner-all" readonly="readonly" required /></td>
                    </tr>
                    <?php if (($_smarty_tpl->tpl_vars['tipo_usuario']->value==4)) {?>
                    <tr>
                    	<th>Cod. T&eacute;cnico POS</th>
                        <td><input type="text" id="cod_vendedor" name="cod_vendedor" value="0" class="text ui-widget-content ui-corner-all" required /></td>
                    </tr>
                    <?php }?>
                    <tr>
                    	<th>Num. Boleta</th>
                        <td><input type="text" id="num_boleta" name="num_boleta" value="" class="text ui-widget-content ui-corner-all" required /></td>
                    </tr>
                    <tr>
                    	<th>Fecha Boleta</th>
                        <td><input type="text" id="fecha_boleta" name="fecha_boleta" value="" class="text ui-widget-content ui-corner-all" required /></td>
                    </tr>
                    <tr id="fecha_diagnostico_tr">
                    	<th>Fecha Tent. Diagn&oacute;stico</th>
                        <td><input type="text" id="fecha_diagnostico" name="fecha_diagnostico" value="" class="text ui-widget-content ui-corner-all" required /></td>
                    </tr>
                    <tr>
                    	<th>Fecha Tent. Entrega</th>
                        <td><input type="text" id="fecha_entrega" name="fecha_entrega" value="" class="text ui-widget-content ui-corner-all" required /></td>
                    </tr>
                </table>
            </td>
        </tr>
       
        </table>
        </fieldset>
        
	        
        <!-------------------------------------->
        
        
        <!-- Fieldset imágenes -->
        
        <fieldset class="ui-widget ui-corner-all" style="width:99%;">
        <legend class="legend_field">Im&aacute;genes del Contrato</legend>
  		<table class="nuevo_usuario">
        <tr>
        	<td width="40%" valign="top">
            	<div id="container">
                	<input type="button" id="pickfiles" value="Seleccionar Im&aacute;genes">
                    
               	</div>
            </td>
            <td valign="top">
            	<div id="filelist">Tu navegador no soporta Flash, Silverlight o HTML5.</div>
           	</td>
            
        </tr>
        </table>
        </fieldset>
        
        <!-------------------------------------->
        
		<input type="submit" id="crear_contrato_btn" name="crear_contrato_btn" style="display:none;" />    	
	
  </form>
</div>



<!-- HTML para dialog "Diagnóstico Contrato" -->

<div id="dialog-contrato-diagnostico" title="Diagn&oacute;stico Contrato">
	<form id="diagnostico_contrato_frm" name="diagnostico_contrato_frm" method="post" action="" class="ui-front">
    	<input type="hidden" name="accion" id="accion" value="" />
        <input type="hidden" name="id_contrato" id="id_contrato" value="0" />
        <input type="hidden" name="id_diagnostico" id="id_diagnostico" value="0" />
        <input type="hidden" name="id_presupuesto" id="id_presupuesto" value="0" />
        <input type="hidden" name="id_cliente" id="id_cliente" value="0" />
        <input type="hidden" name="tipo_guardar" id="tipo_guardar" value="1" />
        
        <table class="nuevo_usuario">
        <tr>
            <td width="50%">
                <fieldset class="ui-widget ui-corner-all" style="width:99%; height:200px;" id="fieldset_contrato">
                <legend class="legend_field">Datos del Contrato</legend>
                    <table class="nuevo_usuario">
                    <tr>
                        <th width="25%">Num. Serie</th>
                        <td><input type="text" name="serie_contrato" id="serie_contrato" value="" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <th width="25%">Modelo</th>
                        <td><input type="text" name="modelo_contrato" id="modelo_contrato" value="" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <th width="25%">Descripci&oacute;n</th>
                        <td><input type="text" name="descripcion_contrato" id="descripcion_contrato" value="" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <th width="25%">Falla seg&uacute;n cliente</th>
                        <td><textarea id="falla_cliente_contrato" name="falla_cliente_contrato" cols="23" rows="2" class="text ui-widget-content ui-corner-all" readonly="readonly"  ></textarea></td>
                    </tr>
                    
                    </table>
               	</fieldset>
            </td>
            <td>
            	<fieldset class="ui-widget ui-corner-all" style="width:99%; height:200px;" id="fieldset_cliente">
                <legend class="legend_field">Datos del Cliente</legend>
                    <table class="nuevo_usuario">
                    <tr>
                        <th width="25%">Nombre</th>
                        <td><input type="text" name="nombre_cliente" id="nombre_cliente" value="" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <th width="25%">Tel&eacute;fono</th>
                        <td><input type="text" name="telefono_cliente" id="telefono_cliente" value="" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <th width="25%">E-Mail</th>
                        <td><input type="text" name="correo_cliente" id="correo_cliente" value="" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <th width="25%">Direcci&oacute;n</th>
                        <td><input type="text" name="direccion_cliente" id="direccion_cliente" value="" readonly="readonly" style="width:80%;"/></td>
                    </tr>
                    </table>
              	</fieldset>
            
            </td>
        </tr>
        </table>
        
        <fieldset class="ui-widget ui-corner-all" style="width:99%;" id="fieldset_cliente">
        	<legend class="legend_field">Diagn&oacute;stico</legend>
                <table class="nuevo_usuario">
                <tr>
                    <td width="50%">
                        <table class="nuevo_usuario">
                        <tr>
                            <th width="50%">&iquest;Aplica Garant&iacute;a?</th>
                            <td>
                            	 <select id="aplica_garantia" name="aplica_garantia" style="width:auto;" required>
                                 	<option value="si_g">SI</option>
                                    <option value="no_g">NO</option>
                                 </select>
                                 <input type="hidden" id="check_g" name="check_g" value="1" />
                                <!--<div id="chk_garantia_diag" style="width:50%; margin-left:6px;">
                                    <input type="radio" id="si_g" name="garantia_diagnostico" class="chk_garantia" value="si_g" checked="checked"><label for="si_g">Si</label>
                                    <input type="radio" id="no_g" name="garantia_diagnostico" class="chk_garantia" value="no_g"><label for="no_g">No</label>									
                                    <input type="hidden" id="check_g" name="check_g" value="1" />
                                </div>-->
                            </td>
                        </tr>
                        <tr id="si_garantia_tr">
                            <td colspan="2">
                                <table class="nuevo_usuario">
                                <tr>
                                    <th width="50%">Fecha Inicio</th>
                                    <td><input type="text" id="fecha_inicio_d" name="fecha_inicio_d" value="" class="text ui-widget-content ui-corner-all" required /></td>
                                </tr>
                                <tr>
                                    <th>Fecha T&eacute;rmino</th>
                                    <td><input type="text" id="fecha_termino_d" name="fecha_termino_d" value="" class="text ui-widget-content ui-corner-all" required /></td>
                                </tr>
                                <tr>
                                    <th width="50%">Selecciona una respuesta</th>
                                    <td>
                                        <select id="respuesta_tipo" name="respuesta_tipo" style="width:auto;" required>
                                            <?php echo $_smarty_tpl->tpl_vars['respuesta_tipo']->value;?>

                                        </select>
                                    </td>
                                </tr>
                                <tr id="otra_respuesta_tr" style="display:none;">
                                    <th>Detalle Respuesta</th>
                                    <td><textarea id="observacion_otra_respuesta" name="observacion_otra_respuesta" cols="23" rows="2" class="text ui-widget-content ui-corner-all" ></textarea></td>
                                </tr>
                                <tr style="display:none;">
                                    <th>Comentarios a Cliente</th>
                                    <td><textarea id="diagnostico_cliente" name="diagnostico_cliente" cols="23" rows="2" class="text ui-widget-content ui-corner-all" ></textarea></td>
                                </tr>   
                                <tr>
                            <th>N&uacute;menro GSX</th>
                            <td><input type="text" id="num_gsx" name="num_gsx" value="" class="text ui-widget-content ui-corner-all" required /></td>
                        </tr>                             
                                </table>
                            </td>
                        </tr>
                        
                        </table>
                    </td>
                    <td width="50%">
                    	<table class="nuevo_usuario">
                        
                        <tr>
                            <th>Comentarios</th>
                            <td><textarea id="diagnostico_interno" name="diagnostico_interno" cols="23" rows="2" class="text ui-widget-content ui-corner-all" required ></textarea></td>
                        </tr>
                        <tr>
                        	<td colspan="2">
                                <!-- Fieldset imágenes -->
                        
                                <fieldset class="ui-widget ui-corner-all" style="width:85%; margin:0 auto; height:215px;">
                                <legend class="legend_field">Im&aacute;genes del Diagn&oacute;stico</legend>
                                <table class="nuevo_usuario">
                                <tr>
                                	<td><div id="listado_imagenes" class="listado_img"></div></td>
                                </tr>
                                <tr>
                                    <td width="40%" valign="top" align="center">
                                        <div id="container_diag">
                                            <input type="button" id="pickfiles_diag" value="Seleccionar Im&aacute;genes">
                                            
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" align="center">
                                        <div id="filelist_diag">Tu navegador no soporta Flash, Silverlight o HTML5.</div>
                                    </td>
                                    
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
        
        
        <fieldset class="ui-widget ui-corner-all" style="width:99%;" id="fieldset_repuestos">
        	<legend class="legend_field">Presupuesto</legend>
            	<table class="nuevo_usuario">
                <tr>
                	<th width="25%">Fecha Presupuesto</th>
                    <td><input type="text" id="fecha_ppto" name="fecha_ppto" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" required /></td>
                </tr>
                <tr>
                	<th>Estado Presupuesto</th>
                    <td><input type="hidden" id="estado_ppto" name="estado_ppto" value="" />
                    	<select id="estado_ppto_sel" name="estado_ppto_sel" style="width:auto;" required>
                            <?php echo $_smarty_tpl->tpl_vars['estados_ppto']->value;?>

                        </select>
                   	</td>
               	</tr>
                <tr>
                    <th>Observaciones</th>
                    <td><textarea id="observaciones_ppto" name="observaciones_ppto" cols="23" rows="2" class="text ui-widget-content ui-corner-all" ></textarea></td>
                </tr>
                </table>
                
                <br />
                <fieldset class="ui-widget ui-corner-all" style="width:90%; margin:0 auto;" id="fieldset_repuestos">
        		<legend class="legend_field">Repuestos</legend>
                <div id="lista_repuestos">
                    <table class="nuevo_usuario">
                    <tr>
                        <td>
                            <table class="nuevo_usuario" id="tabla_repuestos">
                            <tr class="tabla_no">
                                <td colspan="5" align="center">
                                    <input type="button" id="nuevo_repuesto" name="nuevo_repuesto" value="Agregar Repuesto" />
                                    <input type="hidden" id="cant_filas" name="cant_filas" value="1" />
                                </td>
                            </tr>
                            <tbody>
                            <tr class="tabla_no">
                                <th width="25%">Cod. Repuesto <br><span class="comentario" style="position:relative;">Puedes buscar por C&oacute;digo o Nombre</span></th>
                                <th width="25%">Descripci&oacute;n</th>
                                <th width="15%">Cantidad</th>
                                <th width="15%">Unitario</th>
                                <th width="15%">Total</th>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr class="tabla_no">
                            	<th colspan="5">
                                	<table class="nuevo_usuario">
                                    <tr height="30px" class="tabla_no">
                                        <th colspan="4" align="right">Sub Total</th>
                                        <td align="center">
                                            <input type="text" name="sub_total" id="sub_total" value="0" style="width:80px; text-align:right;" readonly="readonly">
                                            <input type="hidden" name="sub_total_limpio" id="sub_total_limpio" value="0">
                                        </td>
                                    </tr>
                                    <tr height="30px" class="tabla_no">
                                        <th colspan="4" align="right">Iva</th>
                                        <td align="center">
                                            <input type="text" name="iva" id="iva" value="0" style="width:80px; text-align:right;" readonly="readonly">
                                            <input type="hidden" name="iva_limpio" id="iva_limpio" value="0">
                                        </td>
                                    </tr>
                                    <tr height="30px" class="tabla_no">
                                        <th colspan="4" align="right">Total</th>
                                        <td align="center">
                                            <input type="text" name="total_final" id="total_final" value="0" style="width:80px; text-align:right;" readonly="readonly">
                                            <input type="hidden" name="total_final_limpio" id="total_final_limpio" value="0">
                                        </td>
                                    </tr>
                                    <tr height="30px" class="tabla_no">
                                        <th colspan="4" align="right">Total a Pagar</th>
                                        <td align="center">
                                            <input type="text" name="total_pagar" id="total_pagar" value="0" style="width:80px; text-align:right;" readonly="readonly">
                                            <input type="hidden" name="total_pagar_limpio" id="total_pagar_limpio" value="0">
                                        </td>
                                    </tr>
                                    </table>
                             	</th>
                          	</tr>
                            </tfoot>
                            </table>
                        </td>
                    </tr>
                    
                    
                    </table>
              	</div>
                </fieldset>
                <br>
		</fieldset>
        <input type="submit" id="crear_diagnostico_btn" name="crear_diagnostico_btn" style="display:none;" />
  	</form>
</div>



<!-- HTML Tabs para ver contrato -->
<div id="dialog-contrato-ver" title="Detalle Contrato">
    <div id="tabs">
      <ul>
        <li><a href="#tabs-1">Cliente</a></li>
        <li><a href="#tabs-2">Contrato</a></li>
        <li><a href="#tabs-3">Diagn&oacute;stico</a></li>
        <li><a href="#tabs-4">Presupuesto</a></li>
        <li><a href="#tabs-5">Observaciones Finales</a></li>
      </ul>
      <div id="tabs-1">
        
        <!-- Datos del cliente -->
        
        	<table class="nuevo_usuario">
            <tr>
                <td width="50%">
                    <table width="100%">
                    <tr>
                        <th width="25%"><label for="tipo_cliente_ver">Tipo Cliente</label></th>
                        <td width="75%">
                            <select name="tipo_cliente_ver" id="tipo_cliente_ver" style="width:auto;" disabled="disabled" \>
                                <?php echo $_smarty_tpl->tpl_vars['tipos_cliente']->value;?>

                            </select>
                        
                        </td>
                    </tr>
                    <tr id="rut_cliente_tr_ver">
                        <th><label for="rut_cliente_ver">RUT</label></th>
                        <td><input type="text" name="rut_cliente_ver" id="rut_cliente_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" \></td>
                    </tr>
                    <tr id="cod_cliente_tr_ver" style="display:none;">
                        <th><label for="cod_cliente_ver">Cod. Cliente</label></th>
                        <td><input type="text" name="cod_cliente_ver" id="cod_cliente_ver" value="0" class="text ui-widget-content ui-corner-all" readonly="readonly" \></td>
                    </tr>
                    <tr id="tienda_tr_ver" style="display:none;">
                        <th><label for="tienda_cliente_ver">Tienda Cliente</label></th>
                        <td><select name="tienda_cliente_ver" id="tienda_cliente_ver" style="width:auto;" \>
                                <option value="0">0</option>
                            </select></td>
                    </tr>
                    <tr>
                        <th><label for="nombre_cliente_ver">Nombre</label></th>
                        <td><input type="text" name="nombre_cliente_ver" id="nombre_cliente_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" \></td>
                    </tr>
                     <tr>
                        <th><label for="contacto_cliente_ver">Contacto</label></th>
                        <td><input type="text" name="contacto_cliente_ver" id="contacto_cliente_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <th><label for="direccion_cliente_ver">Direcci&oacute;n</label></th>
                        <td><input type="text" name="direccion_cliente_ver" id="direccion_cliente_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" style="width:auto;" ></td>
                    </tr>
                    </table>
                </td>
                <td width="50%">
                    <table width="100%">
                    <tr>
                        <th width="25%"><label for="region_cliente_contrato">Regi&oacute;n</label></th>
                        <td width="75%">
                            <select name="region_cliente_ver" id="region_cliente_ver" style="width:auto;" disabled="disabled" \>
                                <?php echo $_smarty_tpl->tpl_vars['regiones']->value;?>
	
                            </select>
                           </td>
                    </tr>
                    <tr>
                        <th><label for="comuna_cliente_ver">Comuna</label></th>
                        <td>
                            <select name="comuna_cliente_ver" id="comuna_cliente_ver" style="width:auto;" disabled="disabled" \>
                                
                            </select>
                        
                        </td>
                    </tr>
                    <tr>
                        <th><label for="correo_cliente_ver">Correo</label></th>
                        <td><input type="text" name="correo_cliente_ver" id="correo_cliente_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly"></td>
                    </tr>
                   
                    <tr>
                        <th><label for="telefono_cliente_ver">Tel&eacute;fono</label></th>
                        <td><input type="text" name="telefono_cliente_ver" id="telefono_cliente_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <th><label for="celular_cliente_ver">Celular</label></th>
                        <td><input type="text" name="celular_cliente_ver" id="celular_cliente_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly"></td>
                    </tr>
                    
                    </table>
                </td>       
            </tr>
           
            </table>
           
        
        <!------------------------>
        
      </div>
      <div id="tabs-2">
       
       	<!-- Datos del contrato -->
        
        <table class="nuevo_usuario">
        <tr>
        	<td width="50%">
            	<table class="nuevo_usuario">
                	<tr>
                        <th width="40%">Tipo de Ingreso</th>
                        <td>
                            <select id="tipo_ingreso_ver" name="tipo_ingreso_ver" style="width:auto;" disabled="disabled">
                                <?php echo $_smarty_tpl->tpl_vars['tipo_contrato']->value;?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha Recepci&oacute;n</th>
                        <td><input type="text" id="fecha_recepcion_ver" name="fecha_recepcion_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <th width="40%">Estado del Contrato</th>
                        <td><input type="text" id="estado_contrato_ver" name="estado_contrato_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" style="width:250px;"/>
                            
                        </td>
                    </tr>
                    <tr>
                        <th>Familia</th>
                        <td>
                            <select id="familia_contrato_ver" name="familia_contrato_ver" style="width:auto;" disabled="disabled">
                                <?php echo $_smarty_tpl->tpl_vars['familias']->value;?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><span id="serie_sku">Num. Serie</span></th>
                        <td><input type="text" id="num_serie_ver" name="num_serie_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                    </tr>
                    
                    <tr id="modelo_tr">
                        <th>Modelo</th>
                        <td><input type="text" id="modelo_ver" name="modelo_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                    </tr>
                    
                    <tr>
                        <th>Descripci&oacute;n</th>
                        <td><input type="text" id="descripcion_ver" name="descripcion_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                    </tr>
                    
                    <tr id="garantia_tr">
                        <th>Garant&iacute;a</th>
                        <td><input type="text" name="garantia_ver" id="garantia_ver" value="" readonly="readonly" /></td>
                    </tr>
                    <tr id="busca_iphone_tr">
                        <th>Buscar Mi iPhone</th>
                        <td><input type="text" name="buscar_iphone_ver" id="buscar_iphone_ver" value="" readonly="readonly" /></td>
                            
                    </tr>
                    <tr id="marca_tr" style="display:none;">
                        <th>Marca</th>
                        <td><input type="text" id="marca_ver" name="marca_ver" value="0" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                    </tr>
                
                </table>
            </td>
            
            
            <td width="50%">
            	<table class="nuevo_usuario">
                	<tr>
                    	<th colspan="2">
                        	<fieldset class="ui-widget ui-corner-all" style="width:80%; padding: 2%;">
       							<legend class="legend_field">Descripci&oacute;n fisica</legend>
                    			<div class="desc_fisica">
                                <input type="checkbox" id="rayas_ver" name="rayas_ver" /><label for="rayas_ver">Rayas</label>
                                <input type="checkbox" id="golpes_ver" name="golpes_ver" /><label for="golpes_ver">Golpes</label>
                                <input type="checkbox" id="abolladuras_ver" name="abolladuras_ver" /><label for="abolladuras_ver">Abolladuras</label>
                                <input type="checkbox" id="marcas_ver" name="marcas_ver" /><label for="marcas_ver">Marcas</label>
                                <input type="checkbox" id="liquido_ver" name="liquido_ver" /><label for="liquido_ver">Da&ntilde;o por l&iacute;quido</label>
                                <input type="checkbox" id="intervenido_ver" name="intervenido_ver" /><label for="intervenido_ver">Intervenido</label>
                                
                                </div>    		
                            </fieldset>
                        </th>
                   	</tr>
                    <tr>
                    	<th width="40%">Falla seg&uacute;n cliente</th>
                        <td><textarea id="falla_cliente_ver" name="falla_cliente_ver" cols="23" rows="3" class="text ui-widget-content ui-corner-all" readonly="readonly" ></textarea></td>
                    </tr>
                    <tr>
                    	<th>T&eacute;cnico Asignado</th>
                        <td><input type="text" id="tecnico_asignado_ver" name="tecnico_asignado_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                    </tr>
                   
                    <tr id="tr_cod_vendedor_ver" style="display:none;">
                    	<th>Cod. T&eacute;cnico POS</th>
                        <td><input type="text" id="cod_vendedor_ver" name="cod_vendedor_ver" value="0" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                    </tr>
                   
                    <tr>
                    	<th>Num. Boleta</th>
                        <td><input type="text" id="num_boleta_ver" name="num_boleta_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                    </tr>
                    <tr>
                    	<th>Fecha Boleta</th>
                        <td><input type="text" id="fecha_boleta_ver" name="fecha_boleta_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                    </tr>
                    <tr id="fecha_diagnostico_tr">
                    	<th>Fecha Tent. Diagn&oacute;stico</th>
                        <td><input type="text" id="fecha_diagnostico_ver" name="fecha_diagnostico_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                    </tr>
                    <tr>
                    	<th>Fecha Tent. Entrega</th>
                        <td><input type="text" id="fecha_entrega_ver" name="fecha_entrega_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                    </tr>
                </table>
            </td>
        </tr>
       
        </table>
        
        <!------------------------>
       
       
      </div>
      <div id="tabs-3">
      
      	<!-- Datos del diagnostico -->
        
        	<table class="nuevo_usuario">
            <tr>
                <td width="50%">
                    <table class="nuevo_usuario">
                    <tr>
                        <th width="50%">&iquest;Aplica Garant&iacute;a?</th>
                        <td>
                             <select id="aplica_garantia_ver" name="aplica_garantia_ver" style="width:auto;" disabled="disabled">
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                             </select>
                       	</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="nuevo_usuario">
                            <tr>
                                <th width="50%">Fecha Inicio</th>
                                <td><input type="text" id="fecha_inicio_d_ver" name="fecha_inicio_d_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                            </tr>
                            <tr>
                                <th>Fecha T&eacute;rmino</th>
                                <td><input type="text" id="fecha_termino_d_ver" name="fecha_termino_d_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
                            </tr>
                            <tr>
                                <th width="50%">Selecciona una respuesta</th>
                                <td>
                                    <select id="respuesta_tipo_ver" name="respuesta_tipo_ver" style="width:auto;" disabled="disabled">
                                        <?php echo $_smarty_tpl->tpl_vars['respuesta_tipo']->value;?>

                                    </select>
                                </td>
                            </tr>
                            <tr id="otra_respuesta_tr_ver" style="display:none;">
                                <th>Detalle Respuesta</th>
                                <td><textarea id="observacion_otra_respuesta_ver" name="observacion_otra_respuesta_ver" cols="23" rows="2" class="text ui-widget-content ui-corner-all" readonly="readonly" ></textarea></td>
                            </tr>
                            <tr>
                                <th>Diagn&oacute;stico para Cliente</th>
                                <td><textarea id="diagnostico_cliente_ver" name="diagnostico_cliente_ver" cols="23" rows="2" class="text ui-widget-content ui-corner-all" readonly="readonly" ></textarea></td>
                            </tr>                                
                            <tr>
                                <th>Diagn&oacute;stico (s&oacute;lo uso interno)</th>
                                <td><textarea id="diagnostico_interno_ver" name="diagnostico_interno_ver" cols="23" rows="2" class="text ui-widget-content ui-corner-all" readonly="readonly" ></textarea></td>
                            </tr>
                            </table>
                        </td>
                    </tr>
                    
                    </table>
                </td>
                <td width="50%">
                    <table class="nuevo_usuario">
                    <tr>
                        <th>N&uacute;menro GSX</th>
                        <td><input type="text" id="num_gsx_ver" name="num_gsx_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <!-- Fieldset imágenes -->
                    
                            <fieldset class="ui-widget ui-corner-all" style="width:85%; margin:0 auto; height:215px;">
                            <legend class="legend_field">Im&aacute;genes del Diagn&oacute;stico</legend>
                                <table class="nuevo_usuario">
                                <tr>
                                    <td><div id="listado_imagenes_ver" class="listado_img"></div></td>
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
            
        <!--------------------------->
        
      </div>
      
      <div id="tabs-4">
      
      	<!-- Datos del PPTO -->
        	
            <table class="nuevo_usuario">
            <tr>
                <th width="25%">Fecha Presupuesto</th>
                <td><input type="text" id="fecha_ppto_ver" name="fecha_ppto_ver" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
            </tr>
            <tr>
                <th>Estado Presupuesto</th>
                <td>
                    <select id="estado_ppto_sel_ver" name="estado_ppto_sel_ver" style="width:auto;" disabled="disabled">
                        <?php echo $_smarty_tpl->tpl_vars['estados_ppto']->value;?>

                    </select>
                </td>
            </tr>
            <tr>
                <th>Observaciones</th>
                <td><textarea id="observaciones_ppto_ver" name="observaciones_ppto_ver" cols="23" rows="2" class="text ui-widget-content ui-corner-all" disabled="disabled" ></textarea></td>
            </tr>
            </table>
            
            <br />
            <fieldset class="ui-widget ui-corner-all" style="width:90%; margin:0 auto;" id="fieldset_repuestos">
            <legend class="legend_field">Repuestos</legend>
            <div id="lista_repuestos">
                <table class="nuevo_usuario">
                <tr>
                    <td>
                        <table class="nuevo_usuario" id="tabla_repuestos_ver">
                        <tbody>
                        <tr class="tabla_no">
                            <th width="25%">Cod. Repuesto</th>
                            <th width="25%">Descripci&oacute;n</th>
                            <th width="15%">Cantidad</th>
                            <th width="15%">Unitario</th>
                            <th width="15%">Total</th>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr class="tabla_no">
                            <th colspan="5">
                                <table class="nuevo_usuario">
                                <tr height="30px" class="tabla_no">
                                    <th colspan="4" align="right">Sub Total</th>
                                    <td align="center">
                                        <input type="text" name="sub_total_ver" id="sub_total_ver" value="0" style="width:80px; text-align:right;" readonly="readonly">
                                    </td>
                                </tr>
                                <tr height="30px" class="tabla_no">
                                    <th colspan="4" align="right">Iva</th>
                                    <td align="center">
                                        <input type="text" name="iva_ver" id="iva_ver" value="0" style="width:80px; text-align:right;" readonly="readonly">
                                    </td>
                                </tr>
                                <tr height="30px" class="tabla_no">
                                    <th colspan="4" align="right">Total</th>
                                    <td align="center">
                                        <input type="text" name="total_final_ver" id="total_final_ver" value="0" style="width:80px; text-align:right;" readonly="readonly">
                                    </td>
                                </tr>
                                <tr height="30px" class="tabla_no">
                                    <th colspan="4" align="right">Total a Pagar</th>
                                    <td align="center">
                                        <input type="text" name="total_pagar_ver" id="total_pagar_ver" value="0" style="width:80px; text-align:right;" readonly="readonly">
                                    </td>
                                </tr>
                                </table>
                            </th>
                        </tr>
                        </tfoot>
                        </table>
                    </td>
                </tr>
                
                
                </table>
            </div>
            </fieldset>
        
        <!-------------------->
      
      </div>  
      
      
      <div id="tabs-5">
      	<table class="nuevo_usuario">
        <tr>
            <th width="50%">Observaciones finales</th>
            <td><textarea id="observaciones_finales_ver" name="observaciones_finales_ver" cols="23" rows="4" class="text ui-widget-content ui-corner-all" readonly="readonly" ></textarea>
            </td>
        </tr>
        <tr>
        	<th>Fecha Observacion Final</th>
            <td><input type="text" name="fecha_obs_final" id="fecha_obs_final" value="0" class="text ui-widget-content ui-corner-all"  readonly="readonly"></td>
        </tr>
        </table>
      
      </div> 
      
    </div>
</div>

<!---------------------------------->



<!-- HTML para pagar contrato -->
<div id="dialog-contrato-pagar" title="Pagar PPTO Contrato">
	<form id="pagar_contrato_frm" name="pagar_contrato_frm" method="post" action="" class="ui-front">
        
        <table class="nuevo_usuario">
        <tr>
            <th width="50%">Contrato N&deg;</th>
            <td><input type="text" id="id_contrato_pagar" name="id_contrato_pagar" class="text ui-widget-content ui-corner-all" readonly="readonly" /></td>
        </tr>
        <tr>
        	<th>Total a Pagar</th>
            <td>
            	<input type="text" id="total_contrato" name="total_contrato" class="text ui-widget-content ui-corner-all" readonly="readonly" />
            	<input type="hidden" id="total_contrato_limpio" name="total_contrato_limpio" class="text ui-widget-content ui-corner-all" readonly="readonly" />
            </td>
        </tr>
        <tr>
        	<th>Num. Boleta</th>
            <td><input type="text" id="boleta_contrato" name="boleta_contrato" class="text ui-widget-content ui-corner-all" value=""/></td>
        </tr>
        
        </table>
        
        <input type="submit" id="pagar_contrato_btn" name="pagar_contrato_btn" style="display:none;" />
        
  	</form>
</div>
<!---------------------------------->



<!-- HTML para cambiar estado contrato -->
<div id="dialog-contrato-estado" title="Cambiar Estado Contrato">
	<form id="estado_contrato_frm" name="estado_contrato_frm" method="post" action="" class="ui-front">
        <input type="hidden" id="id_contrato_estado" name="id_contrato_estado" class="text ui-widget-content ui-corner-all" readonly="readonly" value="0" />
        <table class="nuevo_usuario">
        <tr>
            <th width="50%">Estado Actual</th>
            <td>
            	<select id="estado_actual" name="estado_actual" disabled="disabled">
            		
                </select>
            </td>
        </tr>
        <tr>
            <th width="50%">Estado Nuevo</th>
            <td>
            	<select id="estado_nuevo" name="estado_nuevo" required>
            	
                </select>
            </td>
        </tr>
        </table>
        
        <input type="submit" id="cambiar_estado_contrato_btn" name="cambiar_estado_contrato_btn" style="display:none;" />
        
  	</form>
</div>
<!---------------------------------->



<!-- HTML para finalizar contrato -->
<div id="dialog-contrato-finalizar" title="Finalizar Contrato">
	<form id="finalizar_contrato_frm" name="finalizar_contrato_frm" method="post" action="" class="ui-front">
        <input type="hidden" id="id_contrato_fin" name="id_contrato_fin" class="text ui-widget-content ui-corner-all" readonly="readonly" value="0" />
        <table class="nuevo_usuario">
        <tr>
            <th width="50%">Observaciones finales</th>
            <td><textarea id="observaciones_finales" name="observaciones_finales" cols="23" rows="4" class="text ui-widget-content ui-corner-all" required ></textarea>
            </td>
        </tr>
        </table>
        
        <input type="submit" id="finalizar_contrato_btn" name="finalizar_contrato_btn" style="display:none;" />
        
  	</form>
</div>
<!----------------------------------><?php }} ?>
