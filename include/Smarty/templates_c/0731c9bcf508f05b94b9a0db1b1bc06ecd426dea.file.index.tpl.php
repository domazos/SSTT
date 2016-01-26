<?php /* Smarty version Smarty-3.1.19, created on 2015-09-30 16:41:04
         compiled from ".\views\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32193560bf480ca8781-62094640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0731c9bcf508f05b94b9a0db1b1bc06ecd426dea' => 
    array (
      0 => '.\\views\\index.tpl',
      1 => 1413313170,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32193560bf480ca8781-62094640',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_560bf480d19c03_23122554',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_560bf480d19c03_23122554')) {function content_560bf480d19c03_23122554($_smarty_tpl) {?><span class="loginBlock">
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
