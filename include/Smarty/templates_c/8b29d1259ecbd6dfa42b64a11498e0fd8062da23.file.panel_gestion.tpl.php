<?php /* Smarty version Smarty-3.1.19, created on 2015-12-18 17:04:27
         compiled from "./views/panel_gestion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1036973644567466cb221760-08460032%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b29d1259ecbd6dfa42b64a11498e0fd8062da23' => 
    array (
      0 => './views/panel_gestion.tpl',
      1 => 1450467194,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1036973644567466cb221760-08460032',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tipo_usuario' => 0,
    'root_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_567466cb27b103_02648502',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567466cb27b103_02648502')) {function content_567466cb27b103_02648502($_smarty_tpl) {?><table class="tabla_panel">
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
    <td>
    	<a href="#" id="repuestos" class="boton_panel">
        	<img src="<?php echo $_smarty_tpl->tpl_vars['root_dir']->value;?>
images/repuestos.png" width="60" height="60" border="0">
            <br>Gesti&oacute;n de Repuestos
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
