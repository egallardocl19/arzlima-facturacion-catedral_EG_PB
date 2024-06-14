<?php
	include "../config/config.php";//Contiene funcion que conecta a la base de datos
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=REPORTE_TICKET_DETALLE" . date('Y:m:d:m:s').".xls");
	header("Pragma: no-cache"); 
	header("Expires: 0");

	$output = "";
	//$dni = 0;
	$tipo_pago = 0;
	$tipo_ticket = 0;
	$fecha1 = "";
	$fecha2 = "";
	$idcajero = 0;
	$hora_inicio = "";
	$hora_fin =  "";

	$tipo_ticket = $_POST['tipo_ticket'];
	$tipo_pago = $_POST['tipo_pago'];
	$fecha1 = $_POST['fecha_inicio'];
	$fecha2 = $_POST['fecha_fin'];
	$idcajero = $_POST['idcajero'];
	$hora_inicio = $_POST['hora_inicio'];
	$hora_fin = $_POST['hora_fin'];
		


	if ($tipo_ticket>0) {
		$consulta2="SELECT nombre from clase_ticket where id='$tipo_ticket'";
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
						
						<th bgcolor='#1262EE' style='color:#FFFFFF' colspan='12' >REPORTE DE TICKET DETALLE - ".$nombre_clase."</th>
						
					</tr>
					<tr >
						
						<th bgcolor='#1262EE' style='color:#FFFFFF'>SERIE</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>NUMERO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>DIA</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>FECHA EMISION</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>HORA</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>TIPO TICKET</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>PRECIO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>CANTIDAD</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>TOTAL</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>TIPO PAGO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>NUMERO PAGO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>CAJERO</th>
					</tr>
				<tbody>
		";

		if($tipo_ticket!='0'){
			$where=" and t.idclase_ticket=".$tipo_ticket."";
		}else{
			$where="";
		}
		if($tipo_pago!='0'){
		  	$where.=" and t.id in (select idticket from cobranza where idformapago=".$tipo_pago.")";
		  }else{
		  	$where.="";
		}
		if($idcajero!='0'){
			$where.=" and t.iduser_add=".$idcajero."";
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
		if($hora_inicio!=''){
			$where.=" and DATE_FORMAT(t.hora, \"%H:%i\")>=\"$hora_inicio\"";
		}else{
			$where.="";
		}
		if($hora_fin!=''){
			$where.=" and DATE_FORMAT(t.hora, \"%H:%i\")<=\"$hora_fin\"";
		}else{
			$where.="";
		}
		$cadena_script00="call reporte_ticket('6','$where')";
		$style='mso-number-format:"@";';
		setlocale(LC_TIME, 'es_ES.UTF-8');
		setlocale(LC_TIME, 'spanish');
			$query = mysqli_query($con, $cadena_script00) or die(mysqli_errno());
						while($fetch = mysqli_fetch_array($query)){
							
							$output .= "
										<tr>
											
											<td style='".$style."'><b>".utf8_decode($fetch['serie'])."</b></td>
											<td style='".$style."'>".utf8_decode($fetch['numero'])."</td>
											<td>".strftime("%A", strtotime($fetch['fecha']))."</td>
											<td>".utf8_decode($fetch['fecha'])."</td>
											<td>".utf8_decode($fetch['hora'])."</td>
											<td>".utf8_decode($fetch['tipo_ticket'])."</td>
											<td>".number_format(utf8_decode($fetch['importe']),2)."</td>
											<td>".utf8_decode($fetch['cantidad'])."</td>
											<td>".number_format(utf8_decode($fetch['costo_total']),2)."</td>
											<td>".utf8_decode($fetch['forma_pago'])."</td>
											<td>".utf8_decode($fetch['referencia'])."</td>
											<td>".utf8_decode($fetch['cajero'])."</td>
							
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