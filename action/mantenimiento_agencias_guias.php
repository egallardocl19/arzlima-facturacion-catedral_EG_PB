<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['dni'])) {
           $errors[] = "Dni vacío";
        } else if (empty($_POST['nombre'])){
			$errors[] = "Nombre vacío";
		} else if (empty($_POST['apellido'])){
			$errors[] = "Apellido vacío";
		} else if (empty($_POST['celular'])){
			$errors[] = "Celular vacío";
		} else if (empty($_POST['agencia'])){
			$errors[] = "Agencia vacío";
		} else if (
			!empty($_POST['dni']) &&
			!empty($_POST['nombre']) &&
			!empty($_POST['apellido']) &&
			!empty($_POST['celular'])  &&
			!empty($_POST['agencia'])  
			
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		$codigo = $_POST["codigo"];
		$valor_mantenimiento = $_POST["valor_mantenimiento"];
		$dni = $_POST["dni"];
		$nombre = trim($_POST["nombre"]);
		$apellido = trim($_POST["apellido"]);
		$celular = $_POST["celular"];
		$correo = trim($_POST["correo"]);
		$estado = $_POST["estado"];
		$agencia = $_POST["agencia"];

		
		$user_id=$_SESSION['user_id'];  
		$submod=$_SESSION['keytok0']; 
		$fecha_add = date("Y-m-d");
		//$mantenimiento_tabla =mysqli_query($con,"CALL mantenimiento_agencias_guias($codigo,$valor_mantenimiento,'$dni','$nombre','$apellido','$celular','$correo',$estado,$agencia,$user_id,'$fecha_add',$submod,@resultado,@resultado1);");
		$mantenimiento_tabla =mysqli_query($con,"CALL mantenimiento_agencias_guias($codigo,$valor_mantenimiento,'$dni','$nombre','$apellido','$celular','$correo',$estado,$agencia,$user_id,'$fecha_add',$submod,@resultado,@resultado1);");
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
			$errors []= "Error desconocido - Verificar los Datos Ingresados";
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