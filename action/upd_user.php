<?php	

	
	session_start();

	if (empty($_POST['mod_name'])) {
           $errors[] = "Nombre vacío";
        }else if (empty($_POST['mod_email'])){
			$errors[] = "Correo Vacio vacío";
		//} else if ($_POST['mod_status']==""){
		//	$errors[] = "Selecciona el estado";
		}else if (
			!empty($_POST['mod_name']) &&
			!empty($_POST['mod_email']) //&&
		//	!empty($_POST['mod_status']) 
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$name=mysqli_real_escape_string($con,(strip_tags($_POST["mod_name"],ENT_QUOTES)));
		$email=$_POST["mod_email"];
		$password=$_POST["password"];
		//$status=intval($_POST['mod_status']);
		$id=$_POST['mod_id'];
		$username=$_POST["mod_username"];
		$dni=$_POST["mod_dni"];
		$celular=$_POST["mod_celular"];
		$ruc=$_POST["mod_ruc"];
		$razon=$_POST["mod_razon"];
		$direccion=$_POST["mod_direccion"];
		

		if  (!empty($_POST['mod_status'])){
			$status=$_POST['mod_status'];
		
		$sql="UPDATE user SET username=\"$username\",nombre=\"$name\", email=\"$email\",idestado=$status, dni=\"$dni\", celular=\"$celular\", ruc=\"$ruc\", razonsocial=\"$razon\", direccion=\"$direccion\"  WHERE codigo=$id";
		}else{
			$sql="UPDATE user SET username=\"$username\",nombre=\"$name\", email=\"$email\",dni=\"$dni\", celular=\"$celular\", ruc=\"$ruc\", razonsocial=\"$razon\", direccion=\"$direccion\"  WHERE codigo=$id";
		}
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Datos actualizados satisfactoriamente.";

				// update password by abisoft
				if($_POST["password"]!=""){
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
					$update_passwd=mysqli_query($con,"update user set password=\"$password\" where codigo=$id");
					if ($update_passwd) {
						$messages[] = " Y la Contraseña ah sido actualizada.";
					}
					}

				}

			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
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