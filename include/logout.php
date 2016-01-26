<?php
	session_name('sstt');
	session_start();
	
	
	#$_SESSION = array();
	
	session_destroy();  
	
	header('Location: ../');
	exit(0);
?>