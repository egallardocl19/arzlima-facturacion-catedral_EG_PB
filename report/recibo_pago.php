
<?php
require('../fpdf/fpdf.php');
//include "../service/config/config.php";//Contiene funcion que conecta a la base de datos
include "../config/config.php";//Contiene funcion que conecta a la base de datos
include "../head2.php";

$v1 = $_GET['variable1'];
$consulta="call recibo_ticket($v1)";
$resultado=$con->query($consulta);
while ($row=$resultado->fetch_assoc()) {
	 		$serie = $row['serie'];
	 		$numero = $row['numero'];
	 		$fecha = $row['fecha'];
	 		$dni = $row['dni'];
	 		$nombre = $row['nombre'];
	 		$signo = $row['signo'];
	 		$importe = $row['importe'];
            $monto_total = $row['monto_total'];
            $cantidad = $row['cantidad'];
            $estado = $row['estado'];
            $tipo_pago = $row['tipo_pago'];
		
	 }	
class PDF extends FPDF
{
	
// Cabecera de página
function Header()
{
	
    // Logo
  
    $this->Image('../images/profiles/fondo.png', 0, 0, 100, 300);
    $this->Image('../images/profiles/logo4.png',13,10,76);
    // Arial bold 15
    $this->SetFont('Arial','B',11);
    // Movernos a la derecha
    $this->Cell(100);
	// Salto de línea
    $this->Ln(35);
    $this->Cell(80,5,'MUSEO DE ARTE RELIGIOSO',0,1,'C');
	$this->SetFont('Arial','B',8);

	$this->SetDrawColor(188,188,188); //COLOR
	$this->Line(0,45,100,45);//INSERTAR LINEA
    // Salto de línea
    $this->Ln(1);
	
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(84,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}


//$pdf = new PDF();
//$pdf = new PDF('P', 'mm', array(100,150)); //DIMENSION TIKET
$pdf = new PDF('P', 'mm', array(100,300)); //DIMENSION BOLETA
$pdf -> AliasNbPages();
$pdf->AddPage();
//$pdf->SetDrawColor(188,188,188); //COLOR
//$pdf->Line(10,45,200,45);//INSERTAR LINEA

$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,2,'',0,1,'D',0);
$pdf->Cell(80,6,utf8_decode(' Nº TICKET'),1,1,'C',0);
$pdf->Cell(80,6,$serie."-".$numero,1,1,'C',0);
//$pdf->Cell(143,10,'',0,0,'D',0);

 $pdf->Ln(4);
 $pdf->SetFont('Arial','B',10);
 $pdf->Cell(40,5,'FECHA: '.$fecha,0,1,'D',0);
 $pdf->Cell(40,5,'TIPO TICKET: '.utf8_decode($nombre),0,1,'D',0);
 $pdf->SetFont('Arial','B',10);
 $pdf->Cell(40,5,'P.UNIT: '.$signo.$importe,0,1,'D',0);
 $pdf->Cell(40,5,'CANT: '.$cantidad,0,1,'D',0);
 $pdf->SetFont('Arial','B',14);
 $pdf->Cell(40,5,'TOTAL: '.$signo.$monto_total,0,1,'D',0);
 $pdf->Ln(5);
 $pdf->SetFont('Arial','B',10);
$pdf->Cell(40,5,'DNI: '.$dni,0,1,'D',0);
// $pdf->Cell(40,5,'COSTO TOTAL: '.$costo_total.' Soles',0,1,'D',0);
$pdf->SetDrawColor(188,188,188); //COLOR
$pdf->Line(0,100,100,100);//INSERTAR LINEA
$pdf->Ln(4);
$pdf->SetFont('Arial','B',10);
if($estado=="PAGADO"){
$nombre_estado="CANCELADO";
}else{
    $nombre_estado="";  
}
$pdf->Cell(80,3,$nombre_estado,0,1,'C',0);
$pdf->Cell(80,3,'---------------------------',0,1,'C',0);
$pdf->Cell(80,3,$tipo_pago,0,1,'C',0);
$pdf->Ln(5);
// Llamando a la libreria PHPQRCODE
include('../phpqrcode/qrlib.php'); 
// Ingresamos el contenido de nuestro Código QR
$contenido = $serie."-".$numero;
// Exportamos una imagen llamado resultado.png que contendra el valor de la avriable $content
QRcode::png($contenido,"resultado.png",QR_ECLEVEL_L,10,2);
// Impresión de la imagen en el navegador listo para usarla
//echo "<div><img src='resultado.png'/></div>";
$pdf->Image('resultado.png', 20, 120, 60, 60);
$pdf->Image('../images/profiles/catedral1.png',11, 185, 80, 80);
$pdf->Ln(142);
$pdf->MultiCell(80,4,utf8_decode('EL PRESENTE DOCUMENTO CONSTITUYE EL ÚNICO COMPROBANTE DE PAGO VÁLIDO PARA AMBAS PARTES.'),'','C',false);
$pdf->Output();
?>

