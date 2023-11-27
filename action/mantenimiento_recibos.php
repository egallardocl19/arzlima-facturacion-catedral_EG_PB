<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['serie'])) {
           $errors[] = "Serie Ticket vacío";
        } else if (empty($_POST['cantidad'])){
			$errors[] = "Cantidad vacío";
		} else if (empty($_POST['fecha_inicio'])){
			$errors[] = "Fecha vacío";
		} else if (empty($_POST['dni'])){
			$errors[] = "Dni vacío";
		} else if (empty($_POST['idtipo'])){
			$errors[] = "Tipo Ticket vacío";
	
		} else if (
			!empty($_POST['serie']) &&
			!empty($_POST['cantidad']) &&
			!empty($_POST['fecha_inicio']) &&
			!empty($_POST['dni']) &&
			!empty($_POST['idtipo'])  
			
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		$codigo = $_POST["codigo"];
		$valor_mantenimiento = $_POST["valor_mantenimiento"];
		$serie = $_POST["serie"];
		$cantidad = $_POST["cantidad"];
		$fecha_inicio = $_POST["fecha_inicio"];
		$numero = 0;
		$dni = trim($_POST["dni"]);
		$razon_social = trim($_POST["razon_social"]);
		$direccion = trim($_POST["direccion"]);
		$idtipo = $_POST["idtipo"];
		$monto_total_ticket = number_format($_POST["monto_total_ticket"],0);
		$tipo_pago = $_POST["tipo_pago"];
		$n_pago = $_POST["n_pago"];
		
		$user_id=$_SESSION['user_id'];  
		$submod=$_SESSION['keytok0']; 
		$fecha_add = date("Y-m-d");
	
		$mantenimiento_tabla =mysqli_query($con,"CALL mantenimiento_recibo($codigo,$valor_mantenimiento,'$serie','$numero',$submod,
		'$fecha_inicio',$cantidad,'$dni','$razon_social','$direccion',$idtipo,$monto_total_ticket,$tipo_pago,'$n_pago',$user_id,'$fecha_add',@resultado,@resultado1);");
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