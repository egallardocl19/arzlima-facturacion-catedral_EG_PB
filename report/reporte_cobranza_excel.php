<?php
	include "../config/config.php";//Contiene funcion que conecta a la base de datos
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=REPORTE_COBRANZA_" . date('Y:m:d:m:s').".xls");
	header("Pragma: no-cache"); 
	header("Expires: 0");

	$output = "";
	$ticket = "";
	$cobranza = "";
	$tipo_ticket = 0;
	$tipo_pago = 0;
	$fecha1 = "";
	$fecha2 = "";

	$dni = $_POST['dni'];
	$ticket =$_POST['ticket'];
	$cobranza =$_POST['cobranza'];
	$tipo_ticket = $_POST['tipo_ticket'];
	$tipo_pago = $_POST['tipo_pago'];
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
	
	if(ISSET($_POST['export3'])){
		$output .="
			<table border='1'>
				<thead>
					<tr style='height:40px;'>
						
						<th bgcolor='#1262EE' style='color:#FFFFFF' colspan='15' >REPORTE DE COBRANZA - ".$nombre_clase."</th>
						
					</tr>
					<tr >
						
						<th bgcolor='#1262EE' style='color:#FFFFFF'>COBRANZA</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>FECHA</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>CLIENTE</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>NOMBRE</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>SERIE</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>NUMERO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>CLASE</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>TIPO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>CANTIDAD</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>MONEDA</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>P. UNITARIO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>COBRADO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>FORMA PAGO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>DEPOSITO</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>REFERENCIA</th>

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
		if($cobranza!=''){
			$where.=" and c.n_cobranza=\"$cobranza\"";
		}else{
			$where.="";
		}
		if($tipo_ticket!='0'){
			$where.=" and t.idtipo_ticket=".$tipo_ticket."";
		}else{
			$where.="";
		}
		if($tipo_pago!='0'){
			$where.=" and c.idformapago=".$tipo_pago."";
		}else{
			$where.="";
		}
		if($fecha1!=''){
			$where.=" and c.fecha >=\"$fecha1\"";
		}else{
			$where.="";
		}
		if($fecha2!=''){
			$where.=" and c.fecha <=\"$fecha2\"";
		}else{
			$where.="";
		}

		$cadena_script00="call reporte_cobranza('1','$where')";


			$query = mysqli_query($con, $cadena_script00) or die(mysqli_errno());
						while($fetch = mysqli_fetch_array($query)){
							
							$output .= "
										<tr>
											
											<td><b>".utf8_decode($fetch['n_cobranza'])."</b></td>
											<td>".utf8_decode($fetch['fecha_cobranza'])."</td>
											<td>".utf8_decode($fetch['dni'])."</td>
											<td>".utf8_decode($fetch['nombre'])."</td>
											<td>".utf8_decode($fetch['serie'])."</td>
											<td>".utf8_decode($fetch['numero'])."</td>
											<td>".utf8_decode($fetch['clase'])."</td>
											<td>".utf8_decode($fetch['tipo'])."</td>
											<td>".utf8_decode($fetch['cantidad'])."</td>
											<td>".utf8_decode($fetch['moneda'])."</td>
											<td>".$fetch['importe']."</td>
											<td>".$fetch['cobrado']."</td>
											<td>".utf8_decode($fetch['forma_pago'])."</td>
											<td>".utf8_decode($fetch['n_deposito'])."</td>
											<td>".utf8_decode($fetch['n_referencia'])."</td>
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