
<?php
require('../fpdf/pdf_js.php');
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
            $hora = $row['hora'];
            $iduser_add = $row['iduser_add'];
	 		$dni = $row['dni'];
            $nombre = $row['nombre'];
            $cantidad = $row['cantidad_total'];
	 		$signo = $row['signo'];
            $monto_total = $row['monto_total'];
            $clase = $row['clase'];
            $estado = $row['estado'];
            $tipo_pago = $row['tipo_pago'];
		
	 }	
$resultado->close();  
$con->next_result();
$consulta_detalle="call recibo_ticket_detalle($v1)";
$resultado_detalle=$con->query($consulta_detalle);

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
    $this->SetY(-23);
    $this->MultiCell(80,4,utf8_decode('EL PRESENTE DOCUMENTO CONSTITUYE EL ÚNICO COMPROBANTE DE PAGO VÁLIDO PARA AMBAS PARTES.'),'','C',false);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(84,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

class PDF_AutoPrint extends PDF_JavaScript
{
	function AutoPrint($printer='')
	{
		// Open the print dialog
		if($printer)
		{
			$printer = str_replace('\\', '\\\\', $printer);
			$script = "var pp = getPrintParams();";
			$script .= "pp.interactive = pp.constants.interactionLevel.full;";
			$script .= "pp.printerName = '$printer'";
			$script .= "print(pp);";
		}
		else
			$script = 'print(true);';
		$this->IncludeJS($script);
	}
}

$pdf = new PDF_AutoPrint();
//$pdf = new PDF();
//$pdf = new PDF('P', 'mm', array(100,150)); //DIMENSION TIKET
$pdf = new PDF('P', 'mm', array(100,300)); //DIMENSION BOLETA
$pdf -> AliasNbPages();
$pdf->AddPage();
//$pdf->SetDrawColor(188,188,188); //COLOR
//$pdf->Line(10,45,200,45);//INSERTAR LINEA

$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,2,'',0,1,'D',0);
$pdf->SetFillColor(00,00,00);//Fondo verde de celda
$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
$pdf->Cell(80,6,utf8_decode(' Nº TICKET'),1,1,'C',TRUE);
$pdf->SetTextColor(00,00,00);  // Establece el color del texto (en este caso es blanco)
$pdf->Cell(80,6,$serie."-".$numero,1,1,'C',0);
//$pdf->Cell(143,10,'',0,0,'D',0);

 $pdf->Ln(4);
 $pdf->SetFont('Arial','B',10);
 $pdf->Cell(40,5,'FECHA: '.$fecha,0,0,'D',0);
 $pdf->Cell(40,5,'HORA: '.$hora,0,1,'D',0);
 $pdf->Cell(45,5,'TICKET: '.utf8_decode($clase),0,0,'D',0);
 $pdf->Cell(45,5,'CAJERO: '.utf8_decode($iduser_add),0,1,'D',0);
 $pdf->SetFont('Arial','B',10);

 if($cantidad==0){
    $nombre_cantidad="POR DEFINIR";
    }else{
    $nombre_cantidad=$cantidad;  
    }
    $pdf->Ln(62);
     $pdf->SetFillColor(00,00,00);//Fondo verde de celda
	 $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	 $pdf->Cell(35,6,utf8_decode('TIPO'),1,0,'C',TRUE);
	 $pdf->Cell(15,6,utf8_decode('CANT.'),1,0,'C',TRUE);
	 $pdf->Cell(15,6,utf8_decode('P.UNIT'),1,0,'C',TRUE);
	 $pdf->Cell(15,6,utf8_decode('TOTAL'),1,1,'C',TRUE);

  while ($row=$resultado_detalle->fetch_assoc()) {
    $pdf->SetFillColor(37,67,120);//Fondo verde de celda
 	$pdf->SetTextColor(00,00,00);  // Establece el color del texto (en este caso es blanco)
    $pdf->Cell(35,5,substr(utf8_decode($row['nombre']),0,19),1,0,'C',0);
    $pdf->Cell(15,5,utf8_decode($row['cantidad']),1,0,'C',0);
    $pdf->Cell(15,5,utf8_decode($row['moneda']).$row['importe'],1,0,'C',0);
    $pdf->Cell(15,5,utf8_decode($row['moneda']).$row['total'],1,1,'C',0);
  }  
  // Llamando a la libreria PHPQRCODE
include('../phpqrcode/qrlib.php'); 
// Ingresamos el contenido de nuestro Código QR
$contenido = $serie."-".$numero;
// Exportamos una imagen llamado resultado.png que contendra el valor de la avriable $content
QRcode::png($contenido,"resultado.png",QR_ECLEVEL_L,10,2);
// Impresión de la imagen en el navegador listo para usarla
//echo "<div><img src='resultado.png'/></div>";
$pdf->Image('resultado.png', 20, 79, 60, 60);

$pdf->Ln(2);
$pdf->SetTextColor(00,00,00);  // Establece el color del texto (en este caso es blanco)
 $pdf->SetFont('Arial','B',14);
 if($monto_total==0){
    $nombre_monto="POR DEFINIR";
    }else{
    $nombre_monto=$signo.$monto_total;  
    }
//$pdf->Cell(20);
 $pdf->Cell(80,5,'TOTAL: '.$nombre_monto,0,1,'C',0);
 $pdf->Ln(2);
 $pdf->SetFont('Arial','B',10);
$pdf->Cell(40,5,'DNI: '.$dni.' - '.$nombre,0,1,'D',0);
// $pdf->Cell(40,5,'COSTO TOTAL: '.$costo_total.' Soles',0,1,'D',0);
$pdf->SetDrawColor(188,188,188); //COLOR
$pdf->Line(0,100,100,100);//INSERTAR LINEA
$pdf->Ln(1);
$pdf->SetFont('Arial','B',10);
if($estado=="PAGADO"){
    $nombre_estado="CANCELADO";
}else if($estado=="ANULADO"){
    $nombre_estado="ANULADO";  
}else {
    $nombre_estado="";  
}
$pdf->Cell(80,3,'***'.$nombre_estado.'***',0,1,'C',0);
$pdf->Cell(80,3,'---------------------------',0,1,'C',0);
$pdf->Cell(80,3,$tipo_pago,0,1,'C',0);
$pdf->Ln(6);

$pdf->Image('../images/profiles/catedral1.png',11, 195, 80, 80);
$pdf->Ln(128);
$pdf->AutoPrint(true);
//$pdf->Output();
$pdf->Output('I','recibo'.$serie."-".$numero.'.pdf');


//readfile($rutaArchivo);

?>

