<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['monto_total_ticket'])) {
           $errors[] = "Monto cobranza vacío";
		} else if (empty($_POST['fecha2'])){
			$errors[] = "Fecha Deposito vacío";
		} else if (
			!empty($_POST['monto_total_ticket']) &&
			!empty($_POST['fecha2'])
			
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		$codigo = $_POST["codigo"]; 
		$valor_mantenimiento = $_POST["valor_mantenimiento"];
		$fecha = $_POST["fecha"];
		$tipo_moneda = $_POST["tipo_moneda"];
		$monto_total_ticket = $_POST["monto_total_ticket"];

		$fecha2 = $_POST["fecha2"];
		$tipo_pago = $_POST["tipo_pago"];
		$n_pago = $_POST["n_operacion"];
		$n_deposito = '';
		$banco = 0;
		$cuenta = 0;
		$observaciones = $_POST["observaciones"];
		
		$user_id=$_SESSION['user_id'];  
		$submod=$_SESSION['keytok0']; 
		$fecha_add = date("Y-m-d");
	
		$mantenimiento_tabla =mysqli_query($con,"CALL mantenimiento_cobranza
		($codigo,$valor_mantenimiento,'$fecha',$tipo_moneda,$monto_total_ticket,'$fecha2',$tipo_pago,'$n_pago','$n_deposito','$banco','$cuenta','$observaciones',$submod,$user_id,'$fecha_add',@resultado,@resultado1);");
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