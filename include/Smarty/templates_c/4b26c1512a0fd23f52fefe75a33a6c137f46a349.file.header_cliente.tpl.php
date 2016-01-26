<?php /* Smarty version Smarty-3.1.19, created on 2015-11-03 15:05:05
         compiled from ".\views\header_cliente.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9645637c9b321b6c4-29310360%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b26c1512a0fd23f52fefe75a33a6c137f46a349' => 
    array (
      0 => '.\\views\\header_cliente.tpl',
      1 => 1446517230,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9645637c9b321b6c4-29310360',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5637c9b3348434_70175042',
  'variables' => 
  array (
    'titulo' => 0,
    'css_files' => 0,
    'css_uri' => 0,
    'js_files' => 0,
    'js_uri' => 0,
    'logo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5637c9b3348434_70175042')) {function content_5637c9b3348434_70175042($_smarty_tpl) {?><!doctype html>
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
		
        <script>
			$(document).ready(function(e) {
                $(".fancybox").fancybox();
            });
		</script>
</head>

<body>
	<div class="header">
    	<div class="logo"><?php echo $_smarty_tpl->tpl_vars['logo']->value;?>
</div>
    </div>
    
    <div class="linea">&nbsp;</div>
    
    <div class="main"><?php }} ?>
