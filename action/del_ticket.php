<?php	

	
	session_start();

	if (empty($_POST['mod_id'])) {
           $errors[] = "N° Ticket vacío";
		} else if (empty($_POST['idmotivo'])){
			$errors[] = "Motivo vacío";
		}else if (
			!empty($_POST['mod_id'])  &&
			!empty($_POST['idmotivo'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$mod_id=$_POST['mod_id'];
		$idmotivo=$_POST['idmotivo'];
		
		
		$sql="UPDATE ticket SET idestado_ticket=3, idmotivo=$idmotivo WHERE id=$mod_id";
		
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Ticket Anulado satisfactoriamente.";

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