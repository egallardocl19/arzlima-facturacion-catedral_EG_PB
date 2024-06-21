
<?php
require('../fpdf/fpdf.php');
include "../config/config.php";//Contiene funcion que conecta a la base de datos
include "../head2.php";


$fecha1 = "";


$fecha1 = $_POST['fecha_inicio'];




if($fecha1!=''){
	$where=" and t.fecha =\"$fecha1\"";
}else{
	$where="";
}


$cadena_script0="call reporte_ticket('7','$where')";
$consulta=$cadena_script0;
$resultado=$con->query($consulta);

		

class PDF extends FPDF
{	
// Cabecera de página
function Header()
{
	include "../config/configreport.php";//Contiene funcion que conecta a la base de datos
	
	$fecha1 = $_POST['fecha_inicio'];

	
	// setlocale(LC_TIME, 'es_ES.UTF-8');
	// setlocale(LC_TIME, 'spanish');
	// $inicio ="";


	// if ($fecha1!="") {
	// 	$fecha1=$fecha1;
	// 	$inicio = strftime("%A, %d de %B del %Y", strtotime($fecha1));
	// }else{
	// 	$fecha1="";
	// }
	


	$fecha =date('d/m/Y'); 
	$time =date('h:i:s a'); 
    // Logo
    $this->Image('../images/profiles/logo4.png',10,5,66);

    $this->SetFont('Arial','B',12);

    $this->Cell(50);

    $this->Cell(100,10,'REPORTE CONTROL TICKET',0,0,'C');
	$this->SetFont('Arial','B',8);
	$this->Cell(58,10,'Fecha: '.$fecha,0,1,'C');
	$this->SetFont('Arial','B',9);
	$this->Cell(50);
	$this->SetTextColor(37,67,120);
	$this->Cell(97,5,utf8_decode('FECHA: '),0,1,'C');
	$this->Cell(50);
	$this->Cell(95,5,utf8_decode($fecha1),0,0,'C');
	$this->Cell(65,5,'Hora: '.$time,0,1,'C');

	

    $this->Ln(6);

	$this->SetFont('Arial','B',8);

	$this->SetFillColor(37,67,120);//Fondo verde de celda
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	$this->Cell(30,6,utf8_decode('NUMERO TICKET'),1,0,'C',TRUE);
	$this->Cell(30,6,utf8_decode('FECHA COMPRA'),1,0,'C',TRUE);
	$this->Cell(30,6,utf8_decode('FECHA INGRESO'),1,0,'C',TRUE);
	$this->Cell(30,6,utf8_decode('HORA COMPRA'),1,0,'C',TRUE);
	$this->Cell(30,6,utf8_decode('HORA INGRESO'),1,0,'C',TRUE);
	$this->Cell(15,6,utf8_decode('CONTROL'),1,0,'C',TRUE);
	$this->Cell(15,6,utf8_decode('USUARIO'),1,0,'C',TRUE);
	$this->Cell(15,6,utf8_decode('ALERTA'),1,1,'C',TRUE);

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
$pdf->SetFont('Arial','',8);

$suma_totales=0;
$suma_totales2=0;



	while ($row=$resultado->fetch_assoc()) {
		
			$pdf->SetFillColor(255, 255, 255);
			$pdf->SetTextColor(0, 0, 0);
			$pdf->Cell(30,5,utf8_decode($row['serie']."-".$row['numero']),0,0,'C',0);
			$pdf->Cell(30,5,utf8_decode($row['fecha_compra']),0,0,'C',0);
			$pdf->Cell(30,5,utf8_decode($row['fecha_ingreso']),0,0,'C',0);
			$pdf->Cell(30,5,utf8_decode($row['hora_compra']),0,0,'C',0);
			$pdf->Cell(30,5,utf8_decode($row['hora_ingreso']),0,0,'C',0);
			$pdf->Cell(15,5,utf8_decode($row['control_registrado']),0,0,'C',0);
			$pdf->Cell(15,5,utf8_decode($row['usuario_control']),0,0,'C',0);
			$pdf->SetTextColor(246,11,11);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(15,5,utf8_decode($row['estado_ticket']),0,1,'C',0);
		
			
				
	
			

			
			if($row['fecha_ingreso']>0){
				$suma_totales=$suma_totales+1;
			}else{
				$suma_totales2=$suma_totales2+1;
			}	
			
			
	}
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			
			$pdf->Cell(50);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(60,5,utf8_decode('Total Ticket Controlados.:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			//$pdf->Cell(20);
			$pdf->Cell(40,5,$suma_totales.' Ticket',1,1,'C',0);
			
			$pdf->Cell(50);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(60,5,utf8_decode('Total Ticket sin Control.:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			//$pdf->Cell(20);
			$pdf->Cell(40,5,$suma_totales2.' Ticket',1,1,'C',0);
			
			
$pdf->Output();

?>
