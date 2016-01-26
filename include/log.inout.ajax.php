<?php
	session_name('sstt');
	session_start();

	require_once("../class/mysql.class.php");
	
	
	$bd	= new DB();
	
	if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) ){
		
		if ( @$bd->connect() ){
				
				extract($_POST);
				
				$sql = 'SELECT 	u.id_usuario, u.id_tipo_usuario, u.nombre, u.correo, u.telefono, u.activo
						FROM 	usuarios u
						WHERE 	u.usuario="' . $login_username. '" 
								AND u.pass="' . md5($login_userpass) . '" 
								
						LIMIT 1';
						#echo $sql;
				$bd->query($sql);
				
				if ( $bd->resultExist() ){
						
						$user = @$bd->fetchObj();
						
						if($user->activo == 0)
						{
							echo 2;	
						}
						else
						{
							$_SESSION['userid']		= $user->id_usuario;
							$_SESSION['nombreUser']	= $user->nombre;
							$_SESSION['correoUser']	= $user->correo;
							$_SESSION['tipoUser']	= $user->id_tipo_usuario;
							$_SESSION['time_login']	= time();

							echo 1;
						}
				}
				else
					echo 0;
				
				
			
			$bd->disconnect();
		}
		else
			echo "error: ".$bd->get_errors();
	}
	else{
		echo "error2: ".$bd->get_errors();
	}
?>