<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['idmodulo'])) {
           $errors[] = "Modulo vacío";
        } else if (empty($_POST['submodulo'])){
			$errors[] = "Sub-Modulo vacío";
		} else if (empty($_POST['plantilla'])){
			$errors[] = "Plantilla vacío";
		} else if (empty($_POST['observaciones'])){
			$errors[] = "Titulo Plantilla vacío";
		} else if (
			!empty($_POST['idmodulo']) &&
			!empty($_POST['submodulo']) &&
			!empty($_POST['plantilla'])
		){


		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$idmodulo = $_POST["idmodulo"];
		$submodulo = trim($_POST["submodulo"]);
		$plantilla = trim($_POST["plantilla"]);
		$observaciones = trim($_POST["observaciones"]);
		$icono = 'fa fa-dot-circle-o';
		$user_id=$_SESSION['user_id'];  
		
		


		$sql="call add_submodulo ('$submodulo','$idmodulo','$plantilla','$icono','$observaciones')";

		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "El Sub-Modulo ha sido ingresado satisfactoriamente.";
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