<?php /* Smarty version Smarty-3.1.19, created on 2015-12-18 17:08:12
         compiled from "./views/gestion_repuestos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2026359415567467ac71c5e7-76938637%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '91f7705374f50da16866731e2ebf8f6324130a56' => 
    array (
      0 => './views/gestion_repuestos.tpl',
      1 => 1450467194,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2026359415567467ac71c5e7-76938637',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cuantos_repuestos' => 0,
    'i' => 0,
    'repuestos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_567467ac7917a7_19678741',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567467ac7917a7_19678741')) {function content_567467ac7917a7_19678741($_smarty_tpl) {?><table class="tabla_usuarios">
<tr>
	<td align="left"><a href="./panel_gestion.php"><img src="./images/back.png" /> &nbsp; Volver</a></td>
	<td align="right"><input type="button" id="cargar_repuestos" value="Cargar Repuestos" /> &nbsp; <input type="button" id="recibir_oc" value="Recibir O/C" /></td>
</tr>
<tr>
    <td colspan="2">

    	<?php if (($_smarty_tpl->tpl_vars['cuantos_repuestos']->value<=0)) {?>
        	<div class="mensaje_no">No existen repuestos para mostrar</div>
        <?php } else { ?>

            <table id="filters" class="tablesorter-metro-dark">
            <thead>
                <tr>
                    <th>Cod. Repuesto</th>
                    <th>Descripci&oacute;n</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
				<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['cuantos_repuestos']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['cuantos_repuestos']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['repuestos']->value[$_smarty_tpl->tpl_vars['i']->value]->codigo_repuesto;?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['repuestos']->value[$_smarty_tpl->tpl_vars['i']->value]->descripcion_repuesto;?>
</td>
                        <td>$ <?php echo number_format($_smarty_tpl->tpl_vars['repuestos']->value[$_smarty_tpl->tpl_vars['i']->value]->precio_venta,0,'.','.');?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['repuestos']->value[$_smarty_tpl->tpl_vars['i']->value]->stock;?>
</td>
                    </tr>
             	<?php }} ?>
            </tbody>
            <tfoot>
            	<tr>
            	<td colspan="4">
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



<!-- HTML para recibir OC -->
<div id="dialog-oc" title="Recibir Orden de Compra">
	<form id="finalizar_oc_frm" name="finalizar_oc_frm" method="post" action="" class="ui-front">
        <table class="nuevo_usuario">
        <tr>
            <th width="50%">N&uacute;mero de O/C</th>
            <td><input type="text" name="num_oc" id="num_oc" value="" class="text ui-widget-content ui-corner-all" required>
            </td>
        </tr>
        </table>
        
        <input type="submit" id="finalizar_oc_btn" name="finalizar_oc_btn" style="display:none;" />
        
  	</form>
</div>
<!----------------------------------><?php }} ?>
