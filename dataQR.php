<?php
include("config/config.php");
session_start();
$datoqr = $_REQUEST['datoqr']; //Igual al id del Alumno

$sqlBuscarTicket = ("SELECT * FROM ticket WHERE CONCAT(serie,'-',numero)='$datoqr'");
$queryTicket = mysqli_query($con, $sqlBuscarTicket);
$totalTicket = mysqli_num_rows($queryTicket); //cantidad de Alumno 1 o 0
$DataTicket  = mysqli_fetch_array($queryTicket);
$created_at=date("Y-m-d");
$user_id=$_SESSION['user_id'];

$status = 2;
if (!empty($totalTicket)) {
	if ($DataTicket['idestado_registro'] !='2') {
		
	//Si existe el Ticket se inserta en el registro
	
	$contador_ingreso=mysqli_query($con,"SELECT count(id) as contador FROM ticket_control WHERE CONCAT(serie,'-',numero)='$datoqr'");
		//if (!$contador_ingreso||mysqli_num_rows($contador_ingreso)!=0){
			if ($row = mysqli_fetch_array($contador_ingreso)){
				if ($row['contador']==0){
					$contador=1; 
				}else{
					$contador=$row['contador']+1; 
				}
				
			}
		//}else{
		//	$contador= "1";
		//}

	$sql2="INSERT INTO ticket_control 
	(SELECT 0,serie,numero,'$created_at',(SELECT DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 5 HOUR), '%H:%i:%S' )),
	dni,nombre,direccion,$contador,monto_total,idestado_ticket,idestado_registro,idtipo_ticket,idestado_dato,observaciones,$user_id,'$created_at',2,null,2,null 
	FROM ticket WHERE CONCAT(serie,'-',numero)='$datoqr')";
	$query_new_insert = mysqli_query($con,$sql2);

	//Control si existe el Ticket control
	$sqlBuscarTicket2 = ("SELECT * FROM ticket_control WHERE CONCAT(serie,'-',numero)='$datoqr'");
	$queryTicket2 = mysqli_query($con, $sqlBuscarTicket2);
	$totalTicket2 = mysqli_num_rows($queryTicket2); //cantidad de Alumno 1 o 0	
	
	if ($DataTicket['cantidad'] == $totalTicket2) {
		// Si la cantidad del Ticket es igual al total de ticket control  su estado cambia
		$cambiarStatus = ("UPDATE ticket SET idestado_registro='$status' WHERE CONCAT(serie,'-',numero)='$datoqr'");
		$resultadoStatus = mysqli_query($con, $cambiarStatus);
	}	
	

	//Muestro los Datos del Ticket registrado
	$BuscarTicket 	   = ("SELECT max(id) as id,serie,numero FROM ticket_control WHERE CONCAT(serie,'-',numero)='$datoqr'group by serie,numero");
	$queryTicket = mysqli_query($con, $BuscarTicket);  ?>

	<div class="mb-5">
		<?php while ($infoTicket = mysqli_fetch_array($queryTicket)) { ?>
			
			<?php 
			  $messages[] = "Ticket N° ".$infoTicket['serie'].'-'.$infoTicket['numero'];
			  $messages[] = " Registrado Exitosamente para el Ingreso.";
			?>

			
		<?php } ?>
	</div>
<?php
	}else{ ?>
		<!----El Ticket ya se registro anteriormente --->
		<div class="col-md-12 text-center mb-5">
	  		
			  <?php 
			  	$errors []= "Ticket N° ".$datoqr." ya se uso anteriormente para el ingreso VERIFICAR TICKET.";
			  ?>
				
	  </div>
	<?php }
}else{ ?>
	<!--No existe ningun Ticket asociado -->
	  <div class="col-md-12 text-center mb-5">
			<?php 
			  	$errors []= "No existe ningún Registro Ticket Asociado al N°".$datoqr." VERIFICAR TICKET.";
			  ?>
			
	  </div>
<?php } ?>

<?php 
			  	
			  	if (isset($errors)){
			
				?>
				<div class="alert alert-danger" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Error!</strong> 
						<?php
							foreach ($errors as $error) {
									echo $error;
									?>
									<script>
									load(1);
									</script>
									<?php
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
										?>
									<script>
									load(1);
									</script>
									<?php
									}
								?>
					</div>
					<?php
				}
			  ?>
