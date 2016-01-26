<?php

#include(dirname(__FILE__) . '/../include/defines.inc.php');

require("../class/mysql.class.php");
$bd = new DB;


$sql = $bd->query("SELECT IFNULL(MAX(cod_cliente_ex), 0) AS ultimo_cod FROM clientes");

if($sql)
{
	$res = $bd->fetchObj();
	
	if($res->ultimo_cod == 0)
	{
		# Devuelve 0. Indica que no existen clientes extranjeros en la base de datos. 
		# Devolvemos el valor de la variable global definida para este propósito
		
		echo _COD_CLIENTE_EXTRANJERO_;	
	}
	else
	{
		# No es 0. Indica que existe algún cliente extranjero ingresado en la base de datos.
		# Sumamos 1 al último código de cliente extranjero existente y lo devolvemos.
		
		$nuevo_cod = (int) (($res->ultimo_cod) + 1);
		
		echo $nuevo_cod;
	}
}
?>