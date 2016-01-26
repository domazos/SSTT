<?php /* Smarty version Smarty-3.1.19, created on 2015-10-27 20:35:27
         compiled from ".\views\panel_gestion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2406560bf48d516f82-67340725%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad63b07efff49a16947b3a3863d7088d276b7457' => 
    array (
      0 => '.\\views\\panel_gestion.tpl',
      1 => 1445974526,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2406560bf48d516f82-67340725',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_560bf48d601587_38710468',
  'variables' => 
  array (
    'tipo_usuario' => 0,
    'root_dir' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_560bf48d601587_38710468')) {function content_560bf48d601587_38710468($_smarty_tpl) {?><table class="tabla_panel">
<tr>
	<?php if ((($_smarty_tpl->tpl_vars['tipo_usuario']->value==1)||($_smarty_tpl->tpl_vars['tipo_usuario']->value==2))) {?>
	<td>
    	<a href="#" id="usuarios" class="boton_panel">
        	<img src="<?php echo $_smarty_tpl->tpl_vars['root_dir']->value;?>
images/gestion_usuarios.png" width="60" height="60" border="0">
            <br>Gesti&oacute;n de Usuarios
      	</a>
   	</td>
    <td>
    	<a href="#" id="contratos" class="boton_panel">
        	<img src="<?php echo $_smarty_tpl->tpl_vars['root_dir']->value;?>
images/contratos.png" width="60" height="60" border="0">
            <br>Contratos de Reparaci&oacute;n
      	</a>
   	</td>
    <td>
    	<a href="#" id="clientes" class="boton_panel">
        	<img src="<?php echo $_smarty_tpl->tpl_vars['root_dir']->value;?>
images/clientes.png" width="60" height="60" border="0">
            <br>Gesti&oacute;n de Clientes
      	</a>
   	</td>
    <?php } elseif ((($_smarty_tpl->tpl_vars['tipo_usuario']->value==3)||($_smarty_tpl->tpl_vars['tipo_usuario']->value==4))) {?>
    <td>
    	<a href="#" id="contratos" class="boton_panel">
        	<img src="<?php echo $_smarty_tpl->tpl_vars['root_dir']->value;?>
images/contratos.png" width="60" height="60" border="0">
            <br>Contratos de Reparaci&oacute;n
      	</a>
   	</td>
    <?php }?>
    
    
</tr>
</table><?php }} ?>
