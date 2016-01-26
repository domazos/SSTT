<?php /* Smarty version Smarty-3.1.19, created on 2015-12-18 16:50:24
         compiled from "./views/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160067106556746380b8f2c0-92583273%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc3847fabbab5c0661d4877002e9473f65b23c6a' => 
    array (
      0 => './views/index.tpl',
      1 => 1450467194,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160067106556746380b8f2c0-92583273',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_56746380b90d19_73824889',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56746380b90d19_73824889')) {function content_56746380b90d19_73824889($_smarty_tpl) {?><span class="loginBlock">
	<span class="inner">
    
    	<form method="post" action="">
        
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>Usuario</td>
                <td>&nbsp; : <input type="text" name="login_username" id="login_username" maxlength="20" /></td>
            </tr>
            <tr>
                <td>Contrase&ntilde;a</td>
                <td>&nbsp; : <input type="password" name="login_userpass" id="login_userpass" /></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><span class="timer" id="timer"></span><input type="submit" id="login_userbttn" value="Login" ></td>
            </tr>
        </table>
        <br>
 	    </form>
	</span>
</span>

<div id="alertBoxes"></div> <?php }} ?>
