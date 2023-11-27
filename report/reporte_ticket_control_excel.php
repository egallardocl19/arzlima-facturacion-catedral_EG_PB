<?php
	include "../config/config.php";//Contiene funcion que conecta a la base de datos
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=REPORTE_CONTROL_" . date('Y:m:d:m:s').".xls");
	header("Pragma: no-cache"); 
	header("Expires: 0");

	$output = "";
	$dni = 0;
	$ticket = "";
	$tipo_ticket = 0;
	$fecha1 = "";
	$fecha2 = "";
	
	$dni = $_POST['dni'];
	$ticket =$_POST['ticket'];
	$tipo_ticket = $_POST['tipo_ticket'];
	$fecha1 = $_POST['fecha_inicio'];
	$fecha2 = $_POST['fecha_fin'];

	if ($tipo_ticket>0) {
		$consulta2="SELECT nombre from clase_ticket where id=(select idclase_ticket from tipos_ticket where id='$tipo_ticket')";
		$resultado2=$con->query($consulta2);
		while ($row=$resultado2->fetch_assoc()) {
			$nombre_clase=utf8_decode($row['nombre']);
		}

	}else{
		$nombre_clase="TODOS";
	}

	if(ISSET($_POST['export2'])){
		$output .="
			<table border='1'>
				<thead>
					<tr style='height:40px;'>
						
						<th bgcolor='#1262EE' style='color:#FFFFFF' colspan='11' >REPORTE DE CONTROL - ".$nombre_clase."</th>
						
					</tr>
					<tr >
						
						<th bgcolor='#1262EE' style='color:#FFFFFF'>SERIE</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>NUMERO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>FECHA DE INGRESO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>HORA</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>CLIENTE</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>NOMBRE</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>CLASE</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>TIPO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>MONEDA</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>PRECIO UNITARIO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>ESTADO</th>
					</tr>
				<tbody>
		";
		
		if($dni!='0'){
			$where=" and t.dni=".$dni."";
		}else{
			$where="";
		}
		if($ticket!=''){
			$where.=" and concat(t.serie,\"-\",t.numero)=\"$ticket\"";
		}else{
			$where.="";
		}
		if($tipo_ticket!='0'){
			$where.=" and t.idtipo_ticket=".$tipo_ticket."";
		}else{
			$where.="";
		}
		if($fecha1!=''){
			$where.=" and t.fecha >=\"$fecha1\"";
		}else{
			$where.="";
		}
		if($fecha2!=''){
			$where.=" and t.fecha <=\"$fecha2\"";
		}else{
			$where.="";
		}

		$cadena_script00="call reporte_ticket_control('1','$where')";


			$query = mysqli_query($con, $cadena_script00) or die(mysqli_errno());
						while($fetch = mysqli_fetch_array($query)){
							
							$output .= "
										<tr>
											
											<td><b>".utf8_decode($fetch['serie'])."</b></td>
											<td>".utf8_decode($fetch['numero'])."</td>
											<td>".utf8_decode($fetch['fecha'])."</td>
											<td>".utf8_decode($fetch['hora'])."</td>
											<td>".utf8_decode($fetch['dni'])."</td>
											<td>".utf8_decode($fetch['nombre'])."</td>
											<td>".utf8_decode($fetch['clase'])."</td>
											<td>".utf8_decode($fetch['tipo_ticket'])."</td>
											<td>".utf8_decode($fetch['moneda'])."</td>
											<td>".$fetch['importe']."</td>
											<td>".utf8_decode($fetch['estado'])."</td>
										</tr>
							";
							}	
		
	

	
		
		$output .="
				</tbody>
				
			</table>
		";
		
		echo $output;
	}
	
?>