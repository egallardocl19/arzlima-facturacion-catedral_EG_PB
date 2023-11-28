
<?php

	include "../config/config.php";//Contiene funcion que conecta a la base de datos
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=REPORTE_CONCAR_" . date('Y:m:d:m:s').".xls");
	header("Pragma: no-cache"); 
	header("Expires: 0");

	$output = "";

	$fecha = $_POST['fecha'];
	

	if(ISSET($_POST['export2'])){
		$output .="

			<table border='1'>
				<thead>
					
					<tr >
						
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Campo</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Sub Diario</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>N&uacute;mero de Comprobante</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Fecha de Comprobante</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>C&oacute;digo de Moneda</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Glosa Principal</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Tipo de Cambio</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Tipo de Conversi&oacute;n</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Flag de Conversi&oacute;n de Moneda</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Fecha Tipo de Cambio</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Cuenta Contable</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>C&oacute;digo de Anexo</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>C&oacute;digo de Centro de Costo</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Debe / Haber</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Importe Original</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Importe en D&oacute;lares</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Importe en Soles</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Tipo de Documento</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>N&uacute;mero de Documento</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Fecha de Documento</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Fecha de Vencimiento</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>C&oacute;digo de Area</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Glosa Detalle</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>C&oacute;digo de Anexo Auxiliar</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Medio de Pago</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Tipo de Documento de Referencia</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>N&uacute;mero de Documento Referencia</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Fecha Documento Referencia</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Nro M&aacute;q. Registradora Tipo Doc. Ref.</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Base Imponible Documento Referencia</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>IGV Documento Provisi&oacute;n</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Tipo Referencia en estado MQ</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>N&uacute;mero Serie Caja Registradora</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Fecha de Operaci&oacute;n</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Tipo de Tasa</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Tasa Detracción/Percepci&oacute;n</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Importe Base Detracci&oacute;n/Percepci&oacute;n D&oacute;lares</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Importe Base Detracci&oacute;n/Percepci&oacute;n Soles</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Tipo Cambio para 'F'</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Importe de IGV sin derecho cr&eacute;dito fiscal</th>
						<th bgcolor='#1262EE' style='color:#FFFFFF'>Tasa IGV</th>

					</tr>
					<tr >
						
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>

					</tr>
					<tr >
						
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>
						<th style='color:#FFFFFF'></th>

					</tr>
				<tbody>
		";
	
		if($fecha!=''){
			
		

		$cadena_script00="call reporte_registro_concar('$fecha')";

		$style='mso-number-format:"@";';
			$query = mysqli_query($con, $cadena_script00) or die(mysqli_errno());
						 while($fetch = mysqli_fetch_array($query)){
							
						 	$output .= "
						 				<tr>
											
						 					<td>".utf8_decode('')."</td>
						 					<td style='".$style."'>".utf8_decode($fetch['sub_diario'])."</td>
						 					<td>".utf8_decode($fetch['comprobante'])."</td>
						 					<td>".utf8_decode($fetch['fecha'])."</td>
						 					<td>".utf8_decode($fetch['moneda_contable'])."</td>
						 					<td>".utf8_decode($fetch['glosa'])."</td>
						 					<td>".utf8_decode('')."</td>
						 					<td>".utf8_decode($fetch['tipo_conversion'])."</td>
						 					<td>".utf8_decode($fetch['flag_conversion'])."</td>
						 					<td>".utf8_decode('')."</td>
											<td>".utf8_decode($fetch['cuenta_contable'])."</td>
											<td style='".$style."'>".utf8_decode($fetch['dni'])."</td>
											<td>".utf8_decode('')."</td>
											<td>".utf8_decode($fetch['tipo_cuenta'])."</td>
						 					<td style='".$style."'>".$fetch['monto']."</td>
						 					<td>".''."</td>
											<td>".''."</td>
											<td>".utf8_decode($fetch['tipo_documento'])."</td>
											<td>".utf8_decode($fetch['documento'])."</td>
											<td>".utf8_decode($fetch['fecha1'])."</td>
											<td>".utf8_decode($fetch['fecha2'])."</td>
											<td>".''."</td>
											<td>".utf8_decode($fetch['glosa'])."</td>
						 			
						 				</tr>
						 	";
						 	}	
		
	

	
		
		$output .="
				</tbody>
				
			</table>
		";
	}
		echo $output;
	}
	
?>

