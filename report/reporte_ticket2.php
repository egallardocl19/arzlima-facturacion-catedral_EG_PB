
<?php

require('../fpdf/fpdf.php');
include "../config/config.php";//Contiene funcion que conecta a la base de datos
include "../head2.php";

$fecha1 = "";
$tipo_ticket = 0;

$tipo_ticket = $_POST['tipo_ticket'];
$fecha1 = $_POST['fecha_inicio'];

if($fecha1!=''){
	$where=" and t.fecha =\"$fecha1\"";
}else{
	$where="";
}

if($idroles==2){
	$where.=" and t.iduser_add =\"$codigo\"";
}

if($tipo_ticket==1){
	$where.=" and t.idclase_ticket in (1,2)";
}else if ($tipo_ticket==2){
	$where.=" and t.idclase_ticket in (5)";
}


if (!empty($_POST['fecha_inicio'])){

$cadena_script0="call reporte_ticket('2','$where')";
$consulta=$cadena_script0;
$resultado=$con->query($consulta);

$con->next_result();
$cadena_script1="call reporte_ticket('3','$where')";
$consulta1=$cadena_script1;
$resultado1=$con->query($consulta1);

$con->next_result();
$cadena_script2="call reporte_ticket('4','$where')";
$consulta2=$cadena_script2;
$resultado2=$con->query($consulta2);

$con->next_result();
$cadena_script3="call reporte_ticket('5','$where')";
$consulta3=$cadena_script3;
$resultado3=$con->query($consulta3);
}
		

class PDF extends FPDF
{	
// Cabecera de página
function Header()
{
	//include "../config/configreport.php";//Contiene funcion que conecta a la base de datos
	
	$fecha1 = $_POST['fecha_inicio'];

	
	
	$tipo_ticket = $_POST['tipo_ticket'];

	if ($fecha1!="") {
		$fecha1=$fecha1;
	}else{ 
		$fecha1="";
	}

	if($tipo_ticket==1){
	 $nombre_tipo_ticket=" - T.ENTRADAS";
	}else if ($tipo_ticket==2){
	$nombre_tipo_ticket=" - T.PRODUCTOS";
	}else{
	$nombre_tipo_ticket="";
	}



	setlocale(LC_TIME, 'es_ES.UTF-8');
	setlocale(LC_TIME, 'spanish');

	$fecha =date('d/m/Y'); 
	$inicio = strftime("%A, %d de %B del %Y", strtotime($fecha1));
	$time =date('h:i:s a'); 
    // Logo
    $this->Image('../images/profiles/logo4.png',10,5,66);

    $this->SetFont('Arial','B',12);

    $this->Cell(50);

    $this->Cell(100,10,'RESUMEN'.$nombre_tipo_ticket,0,0,'C');
	$this->SetFont('Arial','B',8);
	$this->Cell(60,10,'Fecha: '.$fecha,0,1,'C');
	$this->SetFont('Arial','B',9);
	$this->Cell(50);
	$this->SetTextColor(37,67,120);
	$this->Cell(100,5,$inicio,0,0,'C');
	$this->Cell(61,5,'Hora: '.$time,0,1,'C');
	$this->SetFont('Arial','B',8);
	$this->SetTextColor(0,0,0);
	$this->Cell(80);


	

    
}
// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','B',8);
    // Número de página
    $this->Cell(200,5,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}



	$pdf = new PDF('P', 'mm', 'A4'); //DIMENSION BOLETA
	$pdf -> AliasNbPages();
	$pdf->AddPage();

if (!empty($_POST['fecha_inicio'])){
	if (!$resultado||mysqli_num_rows($resultado)!=0){

	$suma_cantidad=0;
	$suma_totales=0;
	$moneda='S/.';
	
	$pdf->Ln(12);
	$pdf->Cell(36);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetFillColor(37,67,120);//Fondo verde de celda
	$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	$pdf->Cell(120,12,utf8_decode('RESUMEN DE VENTAS POR DIA'),1,1,'C',TRUE);

	 $pdf->Cell(36);
	 $pdf->SetFont('Arial','B',8);
	 $pdf->SetFillColor(37,67,120);//Fondo verde de celda
	 $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	 $pdf->Cell(55,6,utf8_decode('TIPO TICKET'),1,0,'C',TRUE);
	 $pdf->Cell(15,6,utf8_decode('PRECIO'),1,0,'C',TRUE);
	 $pdf->Cell(20,6,utf8_decode('VENTAS'),1,0,'C',TRUE);
	 $pdf->Cell(30,6,utf8_decode('MONTO TOTAL'),1,1,'C',TRUE);

	 $pdf->SetFont('Arial','',8);
	 $pdf->SetTextColor(0,0,0);

	 $clase_ticket_producto="";

	while ($row=$resultado->fetch_assoc()) {
			//$clase_ticket_producto=$row['idclase_ticket'];
			//if($clase_ticket_producto=1 or $clase_ticket_producto=2){
				$pdf->Cell(36);
				$pdf->SetFillColor(255, 255, 255);
				$pdf->Cell(55,5,utf8_decode($row['tipo_ticket']),0,0,'',0);
				$pdf->Cell(15,5,$moneda." ".number_format($row['importe'],2),0,0,'C',0);
				$pdf->Cell(20,5,utf8_decode($row['cantidad']),0,0,'C',0);
				$pdf->Cell(30,5,$moneda." ".number_format($row['costo_total'],2),0,1,'C',0);
	
				//$moneda=$row['signo_moneda']
				$suma_cantidad=$suma_cantidad+$row['cantidad'];
				$suma_totales=$suma_totales+$row['costo_total'];	
			//}
			
	}
			



			$pdf->Ln(0);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(36);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(80,5,utf8_decode('Total Cantidad de Ventas.:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			//$pdf->Cell(20);
			$pdf->Cell(40,5,$suma_cantidad." Entradas",1,1,'C',0);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(36);
			$pdf->Cell(80,5,utf8_decode('Monto Total de Ventas .:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(40,5,$moneda." ".number_format($suma_totales,2),1,1,'C',0);
	
			//$pdf->Output();	
	}

	if (!$resultado1||mysqli_num_rows($resultado1)!=0){
	$suma_cantidad1=0;
	$suma_totales1=0;
	$moneda1='S/.';
	
	$pdf->Ln(5);
	$pdf->Cell(15);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetFillColor(37,67,120);//Fondo verde de celda
	$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	$pdf->Cell(160,12,utf8_decode('RESUMEN DE VENTAS POR DIA Y FORMA PAGO EFECTIVO'),1,1,'C',TRUE);

	 $pdf->Cell(15);
	 $pdf->SetFont('Arial','B',8);
	 $pdf->SetFillColor(37,67,120);//Fondo verde de celda
	 $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	 $pdf->Cell(55,6,utf8_decode('TIPO TICKET'),1,0,'C',TRUE);
	 $pdf->Cell(20,6,utf8_decode('PRECIO'),1,0,'C',TRUE);
	 $pdf->Cell(20,6,utf8_decode('VENTAS'),1,0,'C',TRUE);
	 $pdf->Cell(30,6,utf8_decode('MONTO TOTAL'),1,0,'C',TRUE);
	 $pdf->Cell(35,6,utf8_decode('FORMA PAGO'),1,1,'C',TRUE);

	 $pdf->SetFont('Arial','',8);
	 $pdf->SetTextColor(0,0,0);

	while ($row2=$resultado1->fetch_assoc()) {
			$pdf->Cell(15);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(55,5,utf8_decode($row2['tipo_ticket']),0,0,'',0);
			$pdf->Cell(20,5,$moneda." ".number_format($row2['importe'],2),0,0,'C',0);
			$pdf->Cell(20,5,utf8_decode($row2['cantidad']),0,0,'C',0);
			$pdf->Cell(30,5,$moneda." ".number_format($row2['costo_total'],2),0,0,'C',0);
			$pdf->Cell(30,5,utf8_decode($row2['forma_pago']),0,1,'C',0);

			//$moneda=$row['signo_moneda']
			$suma_cantidad1=$suma_cantidad1+$row2['cantidad'];
			$suma_totales1=$suma_totales1+$row2['costo_total'];
			
	}
			$pdf->Ln(0);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(36);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(80,5,utf8_decode('Total Cantidad de Ventas.:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			//$pdf->Cell(20);
			$pdf->Cell(40,5,$suma_cantidad1." Entradas",1,1,'C',0);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(36);
			$pdf->Cell(80,5,utf8_decode('Monto Total de Ventas .:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(40,5,$moneda." ".number_format($suma_totales1,2),1,1,'C',0);
	}
			
	if (!$resultado2||mysqli_num_rows($resultado2)!=0){
	$suma_cantidad2=0;
	$suma_totales2=0;
	$moneda2='S/.';
	
	$pdf->Ln(5);
	$pdf->Cell(15);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetFillColor(37,67,120);//Fondo verde de celda
	$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	$pdf->Cell(160,12,utf8_decode('RESUMEN DE VENTAS POR DIA Y FORMA PAGO POS'),1,1,'C',TRUE);

	 $pdf->Cell(15);
	 $pdf->SetFont('Arial','B',8);
	 $pdf->SetFillColor(37,67,120);//Fondo verde de celda
	 $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	 $pdf->Cell(55,6,utf8_decode('TIPO TICKET'),1,0,'C',TRUE);
	 $pdf->Cell(20,6,utf8_decode('PRECIO'),1,0,'C',TRUE);
	 $pdf->Cell(20,6,utf8_decode('VENTAS'),1,0,'C',TRUE);
	 $pdf->Cell(30,6,utf8_decode('MONTO TOTAL'),1,0,'C',TRUE);
	 $pdf->Cell(35,6,utf8_decode('FORMA PAGO'),1,1,'C',TRUE);

	 $pdf->SetFont('Arial','',8);
	 $pdf->SetTextColor(0,0,0);

	while ($row3=$resultado2->fetch_assoc()) {
			$pdf->Cell(15);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(55,5,utf8_decode($row3['tipo_ticket']),0,0,'',0);
			$pdf->Cell(20,5,$moneda." ".number_format($row3['importe'],2),0,0,'C',0);
			$pdf->Cell(20,5,utf8_decode($row3['cantidad']),0,0,'C',0);
			$pdf->Cell(30,5,$moneda." ".number_format($row3['costo_total'],2),0,0,'C',0);
			$pdf->Cell(30,5,utf8_decode($row3['forma_pago']),0,1,'C',0);

			//$moneda=$row['signo_moneda']
			$suma_cantidad2=$suma_cantidad2+$row3['cantidad'];
			$suma_totales2=$suma_totales2+$row3['costo_total'];
			
	}
			$pdf->Ln(0);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(36);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(80,5,utf8_decode('Total Cantidad de Ventas.:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			//$pdf->Cell(20);
			$pdf->Cell(40,5,$suma_cantidad2." Entradas",1,1,'C',0);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(36);
			$pdf->Cell(80,5,utf8_decode('Monto Total de Ventas .:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(40,5,$moneda." ".number_format($suma_totales2,2),1,1,'C',0);
	}

	if (!$resultado3||mysqli_num_rows($resultado3)!=0){	
	$suma_cantidad3=0;
	$suma_totales3=0;
	$moneda3='S/.';
	
	$pdf->Ln(5);
	$pdf->Cell(15);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetFillColor(37,67,120);//Fondo verde de celda
	$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	$pdf->Cell(160,12,utf8_decode('RESUMEN DE VENTAS POR DIA Y FORMA PAGO TRANSFERENCIA'),1,1,'C',TRUE);

	 $pdf->Cell(15);
	 $pdf->SetFont('Arial','B',8);
	 $pdf->SetFillColor(37,67,120);//Fondo verde de celda
	 $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	 $pdf->Cell(55,6,utf8_decode('TIPO TICKET'),1,0,'C',TRUE);
	 $pdf->Cell(20,6,utf8_decode('PRECIO'),1,0,'C',TRUE);
	 $pdf->Cell(20,6,utf8_decode('VENTAS'),1,0,'C',TRUE);
	 $pdf->Cell(30,6,utf8_decode('MONTO TOTAL'),1,0,'C',TRUE);
	 $pdf->Cell(35,6,utf8_decode('FORMA PAGO'),1,1,'C',TRUE);

	 $pdf->SetFont('Arial','',8);
	 $pdf->SetTextColor(0,0,0);

	while ($row4=$resultado3->fetch_assoc()) {
			$pdf->Cell(15);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(55,5,utf8_decode($row4['tipo_ticket']),0,0,'',0);
			$pdf->Cell(20,5,$moneda." ".number_format($row4['importe'],2),0,0,'C',0);
			$pdf->Cell(20,5,utf8_decode($row4['cantidad']),0,0,'C',0);
			$pdf->Cell(30,5,$moneda." ".number_format($row4['costo_total'],2),0,0,'C',0);
			$pdf->Cell(30,5,utf8_decode($row4['forma_pago']),0,1,'C',0);

			//$moneda=$row['signo_moneda']
			$suma_cantidad3=$suma_cantidad3+$row4['cantidad'];
			$suma_totales3=$suma_totales3+$row4['costo_total'];
			
	}
			$pdf->Ln(0);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(36);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(80,5,utf8_decode('Total Cantidad de Ventas.:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			//$pdf->Cell(20);
			$pdf->Cell(40,5,$suma_cantidad3." Entradas",1,1,'C',0);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(36);
			$pdf->Cell(80,5,utf8_decode('Monto Total de Ventas .:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(40,5,$moneda." ".number_format($suma_totales3,2),1,1,'C',0);
	}
}
$pdf->Output();

?>
