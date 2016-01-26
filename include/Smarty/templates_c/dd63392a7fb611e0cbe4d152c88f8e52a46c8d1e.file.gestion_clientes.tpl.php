<?php /* Smarty version Smarty-3.1.19, created on 2015-12-18 17:08:08
         compiled from "./views/gestion_clientes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:63411345567467a8db09a2-92721254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd63392a7fb611e0cbe4d152c88f8e52a46c8d1e' => 
    array (
      0 => './views/gestion_clientes.tpl',
      1 => 1450467194,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '63411345567467a8db09a2-92721254',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cuantos_clientes' => 0,
    'i' => 0,
    'clientes' => 0,
    'tipos_cliente' => 0,
    'regiones' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_567467a8e85da9_23299276',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567467a8e85da9_23299276')) {function content_567467a8e85da9_23299276($_smarty_tpl) {?><table class="tabla_clientes">
<tr>
	<td align="left"><a href="./panel_gestion.php"><img src="./images/back.png" /> &nbsp; Volver</a></td>
	<td align="right"><input type="button" id="nuevo_cliente" value="Crear Nuevo Cliente" /></td>
</tr>
<tr>
    <td colspan="2">

    	<?php if (($_smarty_tpl->tpl_vars['cuantos_clientes']->value<=0)) {?>
        	<div class="mensaje_no">No existen clientes para mostrar</div>
        <?php } else { ?>

            <table id="filters" class="tablesorter-metro-dark">
            <thead>
                <tr>
                	<th>Tipo</th>
                    <th>Nombre</th>
                    <th>Direcci&oacute;n</th>
                    <th>Email</th>
                    <th>Tel&eacute;fono</th>
                    <th>Celular</th>
                    <th>Fecha Creaci&oacute;n</th>
                    <th>Fecha Modificaci&oacute;n</th>
                    <th>Estado</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
				<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['cuantos_clientes']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['cuantos_clientes']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                    <tr>
                    	<td><?php echo $_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->id_tipo_cliente==1 ? 'Nacional' : ($_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->id_tipo_cliente==2 ? 'Extranjero' : 'Tienda');?>
</td>
                        <td><?php echo utf8_encode($_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->nombre);?>
</td>
                        <td><?php echo utf8_encode($_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->direccion);?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->correo;?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->telefono;?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->celular;?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->fecha_creacion;?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->fecha_modificacion;?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->activo==1 ? 'Activo' : 'Inactivo';?>
</td>
                        
                        <td>
                        	<input type="hidden" id="editar_cliente_<?php echo $_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->id_cliente;?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->id_cliente;?>
" />
                            	<span class="edit">
                                	<a href="#" id="<?php echo $_smarty_tpl->tpl_vars['clientes']->value[$_smarty_tpl->tpl_vars['i']->value]->id_cliente;?>
" class="editar_cliente" title="Editar Cliente">&nbsp;</a>
                               	</span>
                        </td>
                        
                    </tr>
             	<?php }} ?>
            </tbody>
            <tfoot>
            	<tr>
            	<td colspan="10">
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

<!-- HTML para dialog "Crear Cliente" -->

<div id="dialog-cliente-new" title="Crear Nuevo Cliente">
	<form id="nuevo_cliente_frm" name="nuevo_cliente_frm" method="post" action="" class="ui-front">
    	<input type="hidden" name="accion" id="accion" value="guardar" />
    	<fieldset class="ui-widget ui-corner-all" style="width:90%;">
  		<table class="nuevo_usuario">
        <tr>
        	<td>
            	<table width="100%">
                <tr>
                	<th width="50%"><label for="tipo_cliente">Tipo Cliente</label></th>
                    <td width="50%">
                    	<select name="tipo_cliente" id="tipo_cliente" style="width:auto;" required \>
                    		<?php echo $_smarty_tpl->tpl_vars['tipos_cliente']->value;?>

                        </select>
                    
                    </td>
              	</tr>
                <tr id="rut_cliente_tr">
                	<th><label for="rut_cliente">RUT</label></th>
                    <td><input type="text" name="rut_cliente" id="rut_cliente" value="" class="text ui-widget-content ui-corner-all" required \></td>
              	</tr>
                <tr id="cod_cliente_tr" style="display:none;">
                	<th><label for="cod_cliente">Cod. Cliente</label></th>
                    <td><input type="text" name="cod_cliente" id="cod_cliente" value="0" class="text ui-widget-content ui-corner-all" readonly="readonly" \></td>
              	</tr>
                <tr id="tienda_tr" style="display:none;">
                	<th><label for="tienda_cliente">Tienda Cliente</label></th>
                    <td><select name="tienda_cliente" id="tienda_cliente" style="width:auto;" \><option value="0">0</option> </select></td>
              	</tr>
                <tr>
                	<th><label for="nombre_cliente">Nombre</label></th>
                    <td><input type="text" name="nombre_cliente" id="nombre_cliente" value="" class="text ui-widget-content ui-corner-all" required \></td>
              	</tr>
                <tr>
                    <th><label for="direccion_cliente">Direcci&oacute;n</label></th>
                    <td><input type="text" name="direccion_cliente" id="direccion_cliente" value="" class="text ui-widget-content ui-corner-all" required ></td>
                </tr>
                <tr>
                	<th><label for="region_cliente">Regi&oacute;n</label></th>
                    <td>
                    	<select name="region_cliente" id="region_cliente" style="width:auto;" required \>
                    		<?php echo $_smarty_tpl->tpl_vars['regiones']->value;?>
	
                        </select>
                       </td>
               	</tr>
                <tr>
                	<th><label for="comuna_cliente">Comuna</label></th>
                    <td>
                    	<select name="comuna_cliente" id="comuna_cliente" required \>
                    			
                        </select>
                    
                    </td>
               	</tr>
                <tr>
                    <th><label for="correo_cliente">Correo</label></th>
                    <td><input type="text" name="correo_cliente" id="correo_cliente" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
                <tr>
                    <th><label for="contacto_cliente">Contacto</label></th>
                    <td><input type="text" name="contacto_cliente" id="contacto_cliente" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
               	<tr>
                    <th><label for="telefono_cliente">Tel&eacute;fono</label></th>
                    <td><input type="text" name="telefono_cliente" id="telefono_cliente" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
                <tr>
                    <th><label for="celular_cliente">Celular</label></th>
                    <td><input type="text" name="celular_cliente" id="celular_cliente" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
                <tr>    
             		<th colspan="2">
                    	<input type="submit" id="crear_cliente_btn" name="crear_cliente_btn" style="display:none;" />
                    	<input type="button" name="limpiar_cliente" id="limpiar_cliente" value="Limpiar Campos" tabindex="-1" >
                  	</th>
                    
                </tr>
                </table>
            </td>       
        </tr>
        
        </table>
		<input type="submit" id="crear_cliente_btn" name="crear_cliente_btn" style="display:none;" />    	
      </fieldset>
	
  </form>
</div>



<!-- HTML para dialog "Editar Cliente" -->

<div id="dialog-cliente-edit" title="Editar Cliente">
	<form id="editar_cliente_frm" name="editar_cliente_frm" method="post" action="" class="ui-front">
    	<input type="hidden" name="accion" id="accion" value="editar" />
        <input type="hidden" name="id_cliente_edit" id="id_cliente_edit" value="" />
    	<fieldset class="ui-widget ui-corner-all" style="width:90%;">
  		<table class="nuevo_usuario">
        <tr>
        	<td>
            	<table width="100%">
                <tr>
                	<th width="50%"><label for="tipo_cliente">Tipo Cliente</label></th>
                    <td width="50%">
                    	<select name="tipo_cliente_edit" id="tipo_cliente_edit" style="width:auto;" required \>
                    		<?php echo $_smarty_tpl->tpl_vars['tipos_cliente']->value;?>

                        </select>
                    
                    </td>
              	</tr>
                <tr id="rut_cliente_tr_edit">
                	<th><label for="rut_cliente_edit">RUT</label></th>
                    <td><input type="text" name="rut_cliente_edit" id="rut_cliente_edit" value="" class="text ui-widget-content ui-corner-all" required \></td>
              	</tr>
                <tr id="cod_cliente_tr_edit" style="display:none;">
                	<th><label for="cod_cliente_edit">Cod. Cliente</label></th>
                    <td><input type="text" name="cod_cliente_edit" id="cod_cliente_edit" value="" class="text ui-widget-content ui-corner-all" readonly="readonly" \></td>
              	</tr>
                <tr>
                	<th><label for="nombre_cliente_edit">Nombre</label></th>
                    <td><input type="text" name="nombre_cliente_edit" id="nombre_cliente_edit" value="" class="text ui-widget-content ui-corner-all" required \></td>
              	</tr>
                <tr>
                    <th><label for="direccion_cliente_edit">Direcci&oacute;n</label></th>
                    <td><input type="text" name="direccion_cliente_edit" id="direccion_cliente_edit" value="" class="text ui-widget-content ui-corner-all" required ></td>
                </tr>
                <tr>
                	<th><label for="region_cliente_edit">Regi&oacute;n</label></th>
                    <td>
                    	<select name="region_cliente_edit" id="region_cliente_edit" style="width:auto;" required \>
                    		
                        </select>
                       </td>
               	</tr>
                <tr>
                	<th><label for="comuna_cliente_edit">Comuna</label></th>
                    <td>
                    	<select name="comuna_cliente_edit" id="comuna_cliente_edit" required \>
                    			
                        </select>
                    
                    </td>
               	</tr>
                <tr>
                    <th><label for="correo_cliente_edit">Correo</label></th>
                    <td><input type="text" name="correo_cliente_edit" id="correo_cliente_edit" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
                <tr>
                    <th><label for="contacto_cliente_edit">Contacto</label></th>
                    <td><input type="text" name="contacto_cliente_edit" id="contacto_cliente_edit" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
               	<tr>
                    <th><label for="telefono_cliente_edit">Tel&eacute;fono</label></th>
                    <td><input type="text" name="telefono_cliente_edit" id="telefono_cliente_edit" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
                <tr>
                    <th><label for="celular_cliente_edit">Celular</label></th>
                    <td><input type="text" name="celular_cliente_edit" id="celular_cliente_edit" value="" class="text ui-widget-content ui-corner-all" required></td>
                </tr>
                <tr>
                	<th width="50%"><label for="estado_cliente_edit">Estado Cliente</label></th>
                    <td width="50%">
                    	<select name="estado_cliente_edit" id="estado_cliente_edit" \>
                    			
                        </select>
                    
                    </td>
              	</tr>
                <tr>    
             		<th colspan="2">
                    	<input type="submit" id="editar_cliente_btn" name="editar_cliente_btn" style="display:none;" />
                    	<input type="button" name="limpiar_cliente_edit" id="limpiar_cliente_edit" value="Limpiar Campos" tabindex="-1" >
                  	</th>
                    
                </tr>
                </table>
            </td>       
        </tr>
        
        </table>
      </fieldset>
	
  </form>
</div>
<?php }} ?>
