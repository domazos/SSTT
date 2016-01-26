<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$currentDir = dirname(__FILE__);

define('_ROOT_DIR_', './');
define('_SMARTY_DIR_', _ROOT_DIR_.'include/Smarty/');
define('_CSS_DIR_', _ROOT_DIR_.'css/');
define('_JS_DIR_', _ROOT_DIR_.'js/');
define('_TPL_DIR_', _ROOT_DIR_.'views/');
define('_SESSION_ID_', 'sstt-session');
define('_LINK_VB_CLIENTE_', 'http://sstt.reif.cl/detalle_contrato.php');

# Variable global utilizada para inicializar código de clientes extranjeros. Esto para no utilizar RUT ya que no todos tienen uno.
# Este valor es sólo para el primer cliente extranjero que se ingrese al sistema, ya que luego el sistema autoincrementará el último código ingresado.

define('_COD_CLIENTE_EXTRANJERO_', 500); 


if(($_SERVER['REQUEST_URI'] != '/include/consulta_cod_cliente.php') or ($_SERVER['REQUEST_URI'] != '/class/Contratos.php'))
{

	/* Get smarty */
	require_once(_SMARTY_DIR_.'libs/Smarty.class.php');
}



function add_ceros($numero,$ceros) 
{
	$order_diez = explode(".",$numero);
	$dif_diez = $ceros - strlen($order_diez[0]);
	for($m = 0; $m < $dif_diez;	$m++)
	{
		@$insertar_ceros .= 0;
	}
	
	return $insertar_ceros .= $numero;
}

function validar()
{
	if((intval($_SESSION['time_login']) + 50400) > time())
	{
		$_SESSION['time_login'] = time();
		return 1;
	}
	else
	{
		return 0;
	}
}

?>