<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['serie'])) {
           $errors[] = "Serie Ticket vacío";
        } else if (floatval($_POST['monto_totalx'])=='0'){
			$errors[] = "Monto debe ser mayor a 0";
		} else if (empty($_POST['fecha_inicio'])){
			$errors[] = "Fecha vacío";
		
		} else if (
			!empty($_POST['serie']) && 
			!empty($_POST['monto_totalx']) &&
			!empty($_POST['fecha_inicio']) 
			
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		$codigo = $_POST["codigo"];
		$valor_mantenimiento = $_POST["valor_mantenimiento"];
		$serie = $_POST["serie"];
		$monto_totalx = number_format($_POST["monto_totalx"],0);
		$fecha_inicio = $_POST["fecha_inicio"];

		$numero = 0;
		$dni = "0000";
		$razon_social = "USUARIO VARIOS";
		$direccion = "";

		if (empty($_POST['idtipo1'])){
			$idtipo1=0;
			$cantidad1=0;
			$monto_total1=0;
		}else{
			$idtipo1=$_POST['idtipo1'];

			if (empty($_POST['cantidad1'])){
				$cantidad1=0;
			}else{
				$cantidad1=$_POST['cantidad1'];
			}

			if (empty($_POST['monto_total1'])){
				$monto_total1=0;
			}else{
				$monto_total1=number_format($_POST["monto_total1"],0);
			}
		}

		if (empty($_POST['idtipo2'])){
			$idtipo2=0;
			$cantidad2=0;
			$monto_total2=0;
		}else{
			$idtipo2 = $_POST["idtipo2"];

			if (empty($_POST['cantidad2'])){
				$cantidad2=0;
			}else{
				$cantidad2=$_POST['cantidad2'];
			}
		
			if (empty($_POST['monto_total2'])){
				$monto_total2=0;
			}else{
				$monto_total2=number_format($_POST["monto_total2"],0);
			}
		}

		if (empty($_POST['idtipo3'])){
			$idtipo3=0;
			$cantidad3=0;
			$monto_total3=0;
		}else{
			$idtipo3 = $_POST["idtipo3"];
			if (empty($_POST['cantidad3'])){
				$cantidad3=0;
			}else{
				$cantidad3=$_POST['cantidad3'];
			}
			
			if (empty($_POST['monto_total3'])){
				$monto_total3=0;
			}else{
				$monto_total3=number_format($_POST["monto_total3"],0);
			}
		}

		if (empty($_POST['idtipo4'])){
			$idtipo4=0;
			$cantidad4=0;
			$monto_total4=0;
		}else{
			$idtipo4 = $_POST["idtipo4"];
			if (empty($_POST['cantidad4'])){
				$cantidad4=0;
			}else{
				$cantidad4=$_POST['cantidad4'];
			}
			
			if (empty($_POST['monto_total4'])){
				$monto_total4=0;
			}else{
				$monto_total4=number_format($_POST["monto_total4"],0);
			}
		}

		if (empty($_POST['idtipo5'])){
			$idtipo5=0;
			$cantidad5=0;
			$monto_total5=0;
		}else{
			$idtipo5 = $_POST["idtipo5"];
			if (empty($_POST['cantidad5'])){
				$cantidad5=0;
			}else{
				$cantidad5=$_POST['cantidad5'];
			}
		
			if (empty($_POST['monto_total5'])){
				$monto_total5=0;
			}else{
				$monto_total5=number_format($_POST["monto_total5"],0);
			}
		}

		if (empty($_POST['idtipo6'])){
			$idtipo6=0;
			$cantidad6=0;
			$monto_total6=0;
		}else{
			$idtipo6 = $_POST["idtipo6"];
			if (empty($_POST['cantidad6'])){
				$cantidad6=0;
			}else{
				$cantidad6=$_POST['cantidad6'];
			}
		
			if (empty($_POST['monto_total6'])){
				$monto_total6=0;
			}else{
				$monto_total6=number_format($_POST["monto_total6"],0);
			}
		}
		if (empty($_POST['idtipo7'])){
			$idtipo7=0;
			$cantidad7=0;
			$monto_total7=0;
		}else{
			$idtipo7 = $_POST["idtipo7"];
			if (empty($_POST['cantidad7'])){
				$cantidad7=0;
			}else{
				$cantidad7=$_POST['cantidad7'];
			}
		
			if (empty($_POST['monto_total7'])){
				$monto_total7=0;
			}else{
				$monto_total7=number_format($_POST["monto_total7"],0);
			}
		}
		if (empty($_POST['idtipo8'])){
			$idtipo8=0;
			$cantidad8=0;
			$monto_total8=0;
		}else{
			$idtipo8 = $_POST["idtipo8"];
			if (empty($_POST['cantidad8'])){
				$cantidad8=0;
			}else{
				$cantidad8=$_POST['cantidad8'];
			}
		
			if (empty($_POST['monto_total8'])){
				$monto_total8=0;
			}else{
				$monto_total8=number_format($_POST["monto_total8"],0);
			}
		}
		
		$tipo_pago=$_POST["tipo_pago"];

		$agencia = $_POST["agencia"];
		if (empty($_POST['agencia'])){
			$agencia=0;
		}else{
			$agencia = $_POST["agencia"];
			$tipo_pago=0;
		}
		$guia = $_POST["guia"];
		if (empty($_POST['guia'])){
			$guia=0;
		}else{
			$guia = $_POST["guia"];
			$tipo_pago=0;
		}

		$n_pago = $_POST["n_pago"];
		$cantidad_total=$cantidad1+$cantidad2+$cantidad3+$cantidad4+$cantidad5+$cantidad6+$cantidad7+$cantidad8;
		$clase= $_POST["clase"];

		$user_id=$_SESSION['user_id'];  
		$submod=$_SESSION['keytok0']; 
		$fecha_add = date("Y-m-d");
			
		$mantenimiento_tabla =mysqli_query($con,"CALL mantenimiento_recibo($codigo,$valor_mantenimiento,'$serie','$numero',$submod,
		'$fecha_inicio',$monto_totalx,$cantidad_total,$clase,'$dni','$razon_social','$direccion',$idtipo1,$cantidad1,$monto_total1,$idtipo2,$cantidad2,$monto_total2,
		$idtipo3,$cantidad3,$monto_total3,$idtipo4,$cantidad4,$monto_total4,$idtipo5,$cantidad5,$monto_total5,$idtipo6,$cantidad6,$monto_total6,$idtipo7,$cantidad7,$monto_total7,
		$idtipo8,$cantidad8,$monto_total8,$tipo_pago,'$n_pago',$user_id,'$fecha_add',$agencia,$guia,@resultado,@resultado1,@ticket1);");
		$resultado = mysqli_query($con,"SELECT @resultado AS result,@resultado1 AS result1,@ticket1 AS tick1");
		
		while($row = $resultado->fetch_assoc())
			{
				if ($row['result1']=='1'){
					$errors []= $row['result'];
				}else{
					$messages[] = $row['result'];	
			}
					$n_ticket=$row['tick1'];
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
						
				<div class="form-group"> 
                    <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-5">
					<strong style='text-align: center'><b><a style='color:#FF0000'  class='visible' href="report/recibo_pago2.php?variable1=<?php echo $n_ticket;?>" target="_blank" >
					<i class="glyphicon glyphicon-print"></i>  IMPRIMIR RECIBO
						</a></b></strong>       
					</div>
					</br></br>
				<?php
			}
		
?>
