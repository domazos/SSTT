<?php /* Smarty version Smarty-3.1.19, created on 2015-10-24 22:48:51
         compiled from ".\views\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6137562beeb3e505d0-03350634%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df328c7d36e7a86f0e300ecdfa6e603ec70eaad9' => 
    array (
      0 => '.\\views\\header.tpl',
      1 => 1443042031,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6137562beeb3e505d0-03350634',
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
  'unifunc' => 'content_562beeb3ede025_24534618',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562beeb3ede025_24534618')) {function content_562beeb3ede025_24534618($_smarty_tpl) {?><!doctype html>
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
