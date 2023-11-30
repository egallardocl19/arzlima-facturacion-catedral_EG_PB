<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['fecha'])){
			$errors[] = "Fecha Inicio vacío"; 
		} else if (empty($_POST['fecha2'])){
			$errors[] = "Fecha Fin vacío";
		} else if (empty($_POST['n_comprobante'])){
			$errors[] = "N° Comprobante vacío";
		} else if (
			
			!empty($_POST['fecha'])  &&
			!empty($_POST['fecha2']) &&
			!empty($_POST['n_comprobante'])
		){

		include "../config/config.php";
		$fecha = $_POST["fecha"];
		$fecha2 = $_POST["fecha2"];
		$n_comprobante = $_POST["n_comprobante"];
		$submod=$_SESSION['keytok0']; 
		$iduser_add = $_SESSION['user_id'];
		$fecha_add = date("Y-m-d");

		
		$mantenimiento_tabla =mysqli_query($con,"CALL mantenimiento_registro_concar('$fecha','$fecha2','$n_comprobante',$iduser_add,'$fecha_add',$submod,@resultado,@resultado1);");
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