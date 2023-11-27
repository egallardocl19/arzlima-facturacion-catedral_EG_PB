<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['idtiporecibo'])) {
           $errors[] = "Tipo Recibo vacío";
		
        } else if (empty($_POST['idserie_recibo'])){
			$errors[] = "Serie Recibo vacío";
		} else if (empty($_POST['idserie_sistema'])){
			$errors[] = "Serie Sistema vacío";
		} else if (empty($_POST['anio'])){
			$errors[] = "Año vacío";
		} else if (empty($_POST['idsubmodulo'])){
			$errors[] = "SubModulo vacío";
		} else if (
			!empty($_POST['idtiporecibo']) &&
			!empty($_POST['idserie_recibo']) &&
			!empty($_POST['idserie_sistema']) &&
			!empty($_POST['anio']) &&
			!empty($_POST['idsubmodulo']) 
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		$codigo = $_POST["codigo"];
		$valor_mantenimiento = $_POST["valor_mantenimiento"];
		$idtiporecibo = $_POST["idtiporecibo"];
		$idserie_recibo = trim($_POST["idserie_recibo"]);
		$idserie_sistema = trim($_POST["idserie_sistema"]);
		$idestado = $_POST["idestado"];
		$anio = $_POST["anio"];
		$idsubmodulo = $_POST["idsubmodulo"];
		//$observaciones =trim($_POST["observaciones"]);
		$user_id=$_SESSION['user_id'];  

		$mantenimiento_tabla =mysqli_query($con,"CALL mantenimiento_recibo_serie($user_id,$codigo,$valor_mantenimiento,
		'$idserie_recibo','$idserie_sistema',$idtiporecibo,$idestado,$anio,$idsubmodulo,@resultado,@resultado1);");
		$resultado = mysqli_query($con,"SELECT @resultado AS result,@resultado1 AS result1");

		while($row = $resultado->fetch_assoc())
			{
				if ($row['result1']=='1'){
					$errors []= $row['result'];
				}else{
					$messages[] = $row['result'];		
				}
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