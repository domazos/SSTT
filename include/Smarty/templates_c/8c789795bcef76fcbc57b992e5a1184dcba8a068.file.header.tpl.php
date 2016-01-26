<?php /* Smarty version Smarty-3.1.19, created on 2015-12-18 16:50:24
         compiled from "./views/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149953922956746380b1aa39-48807333%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c789795bcef76fcbc57b992e5a1184dcba8a068' => 
    array (
      0 => './views/header.tpl',
      1 => 1450467194,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149953922956746380b1aa39-48807333',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulo' => 0,
    'css_files' => 0,
    'css_uri' => 0,
    'js_files' => 0,
    'js_uri' => 0,
    'logo' => 0,
    'logout' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_56746380b8a5d5_81882699',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56746380b8a5d5_81882699')) {function content_56746380b8a5d5_81882699($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>

<?php if (isset($_smarty_tpl->tpl_vars['css_files']->value)) {?>
	<?php  $_smarty_tpl->tpl_vars['css_uri'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['css_uri']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['css_files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['css_uri']->key => $_smarty_tpl->tpl_vars['css_uri']->value) {
$_smarty_tpl->tpl_vars['css_uri']->_loop = true;
?>
		<link href="<?php echo $_smarty_tpl->tpl_vars['css_uri']->value;?>
" rel="stylesheet" type="text/css" media="screen" />
	<?php } ?>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['js_files']->value)) {?>
	<?php  $_smarty_tpl->tpl_vars['js_uri'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['js_uri']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['js_files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['js_uri']->key => $_smarty_tpl->tpl_vars['js_uri']->value) {
$_smarty_tpl->tpl_vars['js_uri']->_loop = true;
?>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js_uri']->value;?>
"></script>
	<?php } ?>
<?php }?>

</head>

<body>
	<div class="header">
    	<div class="logo"><?php echo $_smarty_tpl->tpl_vars['logo']->value;?>
</div>
    	<div class="logout"><?php echo $_smarty_tpl->tpl_vars['logout']->value;?>
</div>
    </div>
    
    <div class="linea">&nbsp;</div>
    
    <div class="main"><?php }} ?>
