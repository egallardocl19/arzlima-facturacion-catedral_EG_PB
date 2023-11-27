
<?php
require('../fpdf/fpdf.php');
include "../config/config.php";//Contiene funcion que conecta a la base de datos
include "../head2.php";

$dni = 0;
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

$cadena_script0="call reporte_cobranza('1','$where')";
$consulta=$cadena_script0;
$resultado=$con->query($consulta);

		

class PDF extends FPDF
{	
// Cabecera de página
function Header()
{
	include "../config/configreport.php";//Contiene funcion que conecta a la base de datos
	$dni = $_POST['dni'];
	$ticket = $_POST['ticket'];
	$tipo_ticket = $_POST['tipo_ticket'];
	$fecha1 = $_POST['fecha_inicio'];
	$fecha2 = $_POST['fecha_fin'];
	$nombre_clase ="";
	$nombre_estado ="";

	if ($tipo_ticket>0) {
		$consulta2="SELECT nombre from clase_ticket where id=(select idclase_ticket from tipos_ticket where id='$tipo_ticket')";
		$resultado2=$con->query($consulta2);
		while ($row=$resultado2->fetch_assoc()) {
			$nombre_clase=utf8_decode($row['nombre']);
		}

	}else{
		$nombre_clase="TODOS";
	}

	if ($ticket>0) {
		$nombre_estado = $ticket;
	}else{
		$nombre_estado="TODOS";
	}

	

	if ($fecha1!="") {
		$fecha1=$fecha1;
	}else{
		$fecha1="";
	}
	if ($fecha2!="") {
		$fecha2=$fecha2;
	}else{
		$fecha2="";
	}

	
	$fecha =date('d/m/Y'); 
	$time =date('h:i:s a'); 
    // Logo
    $this->Image('../images/profiles/logo4.png',10,5,66);

    $this->SetFont('Arial','B',12);

    $this->Cell(125);

    $this->Cell(30,10,'REPORTE COBRANZA - '.$nombre_clase,0,0,'C');
	$this->SetFont('Arial','B',8);
	$this->Cell(220,10,'Fecha: '.$fecha,0,1,'C');
	$this->SetFont('Arial','B',9);
	$this->Cell(108);
	$this->SetTextColor(37,67,120);
	$this->Cell(20,5,utf8_decode('FECHA INICIO: ').$fecha1,0,0,'C');
	$this->Cell(70,5,'FECHA FIN: '.$fecha2,0,0,'C');
	$this->SetFont('Arial','B',8);
	$this->SetTextColor(0,0,0);
	$this->Cell(134,5,'Hora: '.$time,0,1,'C');
	$this->Cell(125);
	$this->SetTextColor(37,67,120);
	$this->Cell(30,5,utf8_decode('N° TICKET: ').$nombre_estado,0,1,'C');
	
	

    $this->Ln(6);

	$this->SetFont('Arial','B',8);

	$this->SetFillColor(37,67,120);//Fondo verde de celda
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	$this->Cell(20,6,utf8_decode('COBRANZA'),1,0,'C',TRUE);
	$this->Cell(16,6,utf8_decode('FECHA'),1,0,'C',TRUE);
	$this->Cell(18,6,utf8_decode('CLIENTE'),1,0,'C',TRUE);
	$this->Cell(20,6,utf8_decode('NOMBRE'),1,0,'C',TRUE);
	$this->Cell(10,6,utf8_decode('SERIE'),1,0,'C',TRUE);
	$this->Cell(20,6,utf8_decode('NUMERO'),1,0,'C',TRUE);
	$this->Cell(30,6,utf8_decode('CLASE'),1,0,'C',TRUE);
	$this->Cell(40,6,utf8_decode('TIPO'),1,0,'C',TRUE); 
	$this->Cell(10,6,utf8_decode('CANT'),1,0,'C',TRUE);
	$this->Cell(15,6,utf8_decode('P.UNIT'),1,0,'C',TRUE);
	$this->Cell(18,6,utf8_decode('COBRADO'),1,0,'C',TRUE);
	$this->Cell(22,6,utf8_decode('FORMA_PAGO'),1,0,'C',TRUE);
	$this->Cell(18,6,utf8_decode('DEPOSITO'),1,0,'C',TRUE);
	$this->Cell(22,6,utf8_decode('REFERENCIA'),1,1,'C',TRUE);

}
// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','B',8);
    // Número de página
    $this->Cell(280,5,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF('L', 'mm', 'A4'); //DIMENSION BOLETA
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$suma_precio_soles=0;
$suma_arbitrios_soles=0;
$suma_adelanto_soles=0;
$suma_pendiente_soles=0;
$suma_importe_soles=0;
$moneda="";

	while ($row=$resultado->fetch_assoc()) {
		
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(20,5,utf8_decode($row['n_cobranza']),0,0,'C',0);
			$pdf->Cell(16,5,utf8_decode($row['fecha_cobranza']),0,0,'C',0);
			$pdf->Cell(18,5,utf8_decode($row['dni']),0,0,'C',0);
			$pdf->Cell(20,5,substr(utf8_decode($row['nombre']),0,10),0,0,'C',0);
			$pdf->Cell(10,5,utf8_decode($row['serie']),0,0,'C',0);
			$pdf->Cell(20,5,utf8_decode($row['numero']),0,0,'C',0);
			$pdf->Cell(30,5,substr(utf8_decode($row['clase']),0,17),0,0,'D',0);
			$pdf->Cell(40,5,substr(utf8_decode($row['tipo']),0,25),0,0,'C',0);
			$pdf->Cell(10,5,utf8_decode($row['cantidad']),0,0,'C',0);
			// $pdf->Cell(12,5,utf8_decode($row['control']),0,0,'C',0);
			$pdf->Cell(15,5,$row['moneda'].number_format(utf8_decode($row['importe']),2),0,0,'C',0);
			$pdf->Cell(18,5,$row['moneda'].number_format(utf8_decode($row['cobrado']),2),0,0,'C',0);
			$pdf->Cell(22,5,utf8_decode($row['forma_pago']),0,0,'C',0);
			$pdf->Cell(18,5,utf8_decode($row['n_deposito']),0,0,'C',0);
			$pdf->Cell(22,5,utf8_decode($row['n_referencia']),0,1,'C',0);

			$moneda=$row['moneda'];
			$suma_precio_soles=$suma_precio_soles+$row['cantidad'];
			//$suma_adelanto_soles=$suma_adelanto_soles+$row['control'];
			$suma_arbitrios_soles=$suma_arbitrios_soles+$row['importe'];
			$suma_importe_soles=$suma_importe_soles+$row['cobrado'];
			
	}
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(135);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(40,5,utf8_decode('Totales.:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			//$pdf->Cell(20);
			//$pdf->Cell(10,5,$suma_precio_soles,1,0,'C',0);
			$pdf->Cell(12,5,$suma_precio_soles,1,0,'C',0);
			$pdf->Cell(24,5,$moneda.number_format($suma_arbitrios_soles,2),1,0,'C',0);
			$pdf->Cell(24,5,$moneda.number_format($suma_importe_soles,2),1,1,'C',0);
	
			

$pdf->Output();

?>
