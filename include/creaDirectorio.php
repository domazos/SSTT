<?php

	$file 	= $_REQUEST["file"];
	
	$fecha 	= date("d-m-Y");
	
	$ruta 	= $_SERVER['DOCUMENT_ROOT'] . "/uploads/repuestos/".$fecha;

	if(!is_dir($ruta))
	{
		$oldmask = umask(0);
		
		if(mkdir($ruta, 0777))
		{
			umask($oldmask);

			if(copy($_SERVER['DOCUMENT_ROOT'] . "/uploads/repuestos/".$file, $ruta."/".$file))
			{
				if(unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/repuestos/".$file))	
				{
					
					echo "OK|".$fecha;
				}
			}
		}
		else
			echo "Error";
	}
	else
	{
		if(copy($_SERVER['DOCUMENT_ROOT'] . "/uploads/repuestos/".$file, $ruta."/".$file))
		{
			if(unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/repuestos/".$file))	
			{
				echo "OK|".$fecha;
			}
		}	
	}
?>