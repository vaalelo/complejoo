<?php	


	
	$mysqli=new mysqli("192.168.164.114","complejo","Complejo2022!","complejo"); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>
