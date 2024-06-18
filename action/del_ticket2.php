<?php	

	
	session_start();

	if (empty($_POST['mod_id'])) {
           $errors[] = "N° Ticket vacío";
		} else if (empty($_POST['idmotivo'])){
			$errors[] = "Motivo vacío";
		} else if (empty($_POST['estado'])){
			$errors[] = "Estado vacío";
		}else if (
			!empty($_POST['mod_id'])  &&
			!empty($_POST['idmotivo'])&&
			!empty($_POST['estado'])
			
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		
		$codigo=$_POST['codigo'];
		$mod_id=$_POST['mod_id'];
		$idmotivo=$_POST['idmotivo'];
		$estado=$_POST['estado'];

		$fecha_add = date("Y-m-d");
		$user_id=$_SESSION['user_id'];
		$submod=$_SESSION['keytok0']; 

		//$sql="UPDATE ticket SET idestado_ticket=3, idmotivo=$idmotivo WHERE id=$mod_id";
		$mantenimiento_tabla =mysqli_query($con,"CALL mantenimiento_seguimiento($mod_id,2,$idmotivo,$estado,$codigo,$submod,$user_id,
		'$fecha_add',@resultado,@resultado1);");
		$resultado = mysqli_query($con,"SELECT @resultado AS result,@resultado1 AS result1");

			while($row = $resultado->fetch_assoc())
			{
				if ($row['result1']=='1'){
					$errors []= $row['result'];
				}else{
					$messages[] = $row['result'];	
				}
			}
			$resultado->close();  
			$con->next_result();
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