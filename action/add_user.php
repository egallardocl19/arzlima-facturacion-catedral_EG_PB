<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['name'])) {
           $errors[] = "Nombre vacío";
        } else if (empty($_POST['lastname'])){
			$errors[] = "Apellidos vacío";
		}else if (empty($_POST['email'])){
			$errors[] = "Correo Vacio vacío";
		} else if ($_POST['estado']==""){
			$errors[] = "Selecciona el estado";
		} else if (empty($_POST['password'])){
			$errors[] = "Contraseña vacío";
		} else if (
			!empty($_POST['name']) &&
			!empty($_POST['lastname']) &&
			$_POST['estado']!="" &&
			!empty($_POST['password'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		// escaping, additionally removing everything that could be (html/javascript-) code
		$name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
		$lastname=mysqli_real_escape_string($con,(strip_tags($_POST["lastname"],ENT_QUOTES)));
		$email=$_POST["email"];
		$password=$_POST["password"];
		$estado=$_POST['estado'];
		$end_name=$name." ".$lastname;
		$username=$_POST["username"];
		$created_at=date("Y-m-d H:i:s");
		$profile_pic="default.png";
		$dni=$_POST["dni"];
		$celular=$_POST["celular"];
		$ruc=$_POST["ruc"];
		$razon=$_POST["razon"];
		$direccion=$_POST["direccion"];
		$profile_pictwo="logo4.png";
		
		$user_id=$_SESSION['user_id'];

	



		//SCRIPT GENERAR CODIGO DE TABLA INTERNET
		$consulta_codigo =("SELECT codigo+1 codigo FROM user where id=(select max(id) from user)");
		$query_codigo=mysqli_query($con,$consulta_codigo);
		if ($row = mysqli_fetch_array($query_codigo)){
			$codigo_usuario=$row['codigo'];
		}

		//SCRIPT PARA VALIDAR DATOS SI YA ESTAN REGISTRADOS
		$sqlvalidarregistro =mysqli_query($con, "select * from user where email='$email' or username='$username'");


			if (!$sqlvalidarregistro|| mysqli_num_rows($sqlvalidarregistro)==0){
			
				if(strlen($password) < 6){
					$errors [] = "La clave debe tener al menos 6 caracteres";
					
				 }else if(strlen($password) > 16){
					$errors [] = "La clave no puede tener más de 16 caracteres";
					
				 }else if(!preg_match('`[a-z]`',$password)){
					$errors [] = "La clave debe tener al menos una letra minúscula";
					
				 }else if(!preg_match('`[A-Z]`',$password)){
					$errors [] = "La clave debe tener al menos una letra mayúscula";
					
				 }else if(!preg_match('`[0-9]`',$password)){
					$errors [] = "La clave debe tener al menos un caracter numérico";
					
				 }else{
			
				$password=mysqli_real_escape_string($con,(strip_tags(sha1(md5($password)),ENT_QUOTES)));

				$sql="INSERT INTO user (codigo,username,nombre,email,password,profile_pic, idestado, created_at,dni,celular,ruc,razonsocial,direccion,profile_pictwo,idroles) 
				VALUES ('$codigo_usuario','$username','$end_name','$email','$password','$profile_pic',$estado,'$created_at','$dni','$celular','$ruc','$razon','$direccion','$profile_pictwo',2)";
				$query_new_insert = mysqli_query($con,$sql);
				
					if ($query_new_insert){
						$messages[] = "El usuario ha sido ingresado satisfactoriamente.";
						//$sql2="INSERT INTO recibos_encuadre values(0,'6','1','89','45','45','45','45','25','35','60','50','10','35',(select codigo from user where email='$email'),'IMPRESORA',1,10)";
						//$query_new_insert = mysqli_query($con,$sql2);
					} else{
						$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
					}
				}
			}else{
				$errors []= "El Email o Username ya se encuentra Registrado.";
			}
		}else{
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>