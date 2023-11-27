<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['idusuario'])) {
           $errors[] = "Usuario vacío";
		} else if (empty($_POST['idsubmodulo'])){
			$errors[] = "SubModulo vacío";
        } else if (empty($_POST['idpermisos'])){
			$errors[] = "Permisos vacío";
		
		} else if (
			!empty($_POST['idusuario']) &&
			!empty($_POST['idsubmodulo'])&&
			!empty($_POST['idpermisos'])
		){


		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$idusuario = $_POST["idusuario"];
		$idsubmodulo = $_POST["idsubmodulo"];
		$idpermisos = $_POST["idpermisos"];
		

		$sql="call add_roles ('$idusuario','$idpermisos','$idsubmodulo')";

		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "El Rol-Usuario ha sido ingresado satisfactoriamente.";
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