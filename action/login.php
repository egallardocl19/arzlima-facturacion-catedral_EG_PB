<?php
	session_start();

	if (isset($_POST['token']) && $_POST['token']!=='') {
			
	//Contiene las variables de configuracion para conectar a la base de datos
	include "../config/config.php";

	$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
	$password=sha1(md5(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)))));

	
	$query1 =mysqli_query($con,"CALL session_login('$email','$password');");
   
    if (!$query1||mysqli_num_rows($query1)!=0){
   
   
		
		if ($row = mysqli_fetch_array($query1))
			{
			
			$_SESSION['user_id']=$row['id']; // Iniciando la sesion
			$user_id=$_SESSION['user_id'];
			header('location: ../dashboardadmin.php'); // Redireccionando a la pagina profile.php
			}
			
		}else{
				$invalid=sha1(md5("contrasena y email invalido"));
				header("location: ../index.php?invalid=$invalid");
			}
	}else{
		header("location: ../");
	}

?>