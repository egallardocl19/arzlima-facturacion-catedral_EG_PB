<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre Producto vacío";
        } else if (empty($_POST['precio'])){
			$errors[] = "Precio Producto vacío";
		} else if (empty($_POST['estado_producto'])){
			$errors[] = "Estado vacío";
	
		} else if (
			!empty($_POST['nombre']) &&
			!empty($_POST['precio']) &&
			!empty($_POST['estado_producto']) 
			
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		$codigo = $_POST["codigo"];
		$valor_mantenimiento = $_POST["valor_mantenimiento"];
		$nombre = trim($_POST["nombre"]);
		$precio = $_POST["precio"];
		$estado_producto = $_POST["estado_producto"];
	

		
		$user_id=$_SESSION['user_id'];  
		$submod=$_SESSION['keytok0']; 
		$fecha_add = date("Y-m-d");
	
		$mantenimiento_tabla =mysqli_query($con,"CALL mantenimiento_producto($codigo,$valor_mantenimiento,'$nombre',$precio,$estado_producto,$user_id,'$fecha_add',$submod,@resultado,@resultado1);");
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