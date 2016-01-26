<?php

include(dirname(__FILE__) . '/../class/mysql.class.php');

class Repuestos
{
	public function listarRepuestos()
	{
		$bd 	= new DB;
		
		$sql 	= 	"	SELECT	r.id_repuesto, r.codigo_repuesto, r.descripcion_repuesto, r.precio_venta, r.stock
						FROM 	repuestos r
					";
					
		if($bd->query($sql))
		{
			$array_res = array();
			
			$cuantos = $bd->resultCount();
			
			for($i=0; $i<$cuantos; $i++)
			{
				$res = $bd->fetchObj();
				array_push($array_res, $res);
			}

			return $array_res;
		}
		else
			return $bd->get_errors();
		
	}
	
	
	public function cuantosRepuestos()
	{
		$bd = new DB;
		
		$query = $bd->query("SELECT COUNT(*) as cuantos FROM repuestos");
		
		if(($query))
		{
			$res = $bd->fetchObj();
			return $res->cuantos;
		}
		else
			return $bd->get_errors();
			
	}

}

?>