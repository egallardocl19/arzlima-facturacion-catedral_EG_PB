<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['n_cobranza2'])) {
           $errors[] = "Cobranza vacío";
		} else if (empty($_POST['fecha_cobranza2'])){
			$errors[] = "Fecha Cobranza vacío";
		} else if (empty($_POST['n_ticket2'])){
			$errors[] = "Ticket vacío";
		} else if (
			!empty($_POST['n_cobranza2']) &&
			!empty($_POST['fecha_cobranza2'])&&
			!empty($_POST['n_ticket2'])
			
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		$codigo = $_POST["codigo2"]; 
		$valor_mantenimiento = $_POST["valor_mantenimiento2"];

		$tipo_pago2 = $_POST["tipo_pago2"];
		$referencia2 = $_POST["referencia2"];

		
		$user_id=$_SESSION['user_id'];  
		$submod=$_SESSION['keytok0']; 
		$fecha_add = date("Y-m-d");
		$idagencia=0;
	
		$mantenimiento_tabla =mysqli_query($con,"CALL mantenimiento_cobranza
		($codigo,$valor_mantenimiento,'$fecha_add','0',0,0,'$fecha_add',$tipo_pago2,'$referencia2','',0,0,'',$idagencia,$submod,$user_id,'$fecha_add',@resultado,@resultado1);");
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