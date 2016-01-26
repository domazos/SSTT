<?php /* Smarty version Smarty-3.1.19, created on 2015-10-24 22:48:52
         compiled from ".\views\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17214562beeb40bb545-32972007%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6419e64e0f92ecff2ae133d8e23f5c5927bfcac2' => 
    array (
      0 => '.\\views\\index.tpl',
      1 => 1413313170,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17214562beeb40bb545-32972007',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_562beeb40bea20_00227143',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562beeb40bea20_00227143')) {function content_562beeb40bea20_00227143($_smarty_tpl) {?><span class="loginBlock">
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
