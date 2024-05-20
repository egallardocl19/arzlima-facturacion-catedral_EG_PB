
<?php
require('../fpdf/fpdf.php');
include "../config/config.php";//Contiene funcion que conecta a la base de datos
include "../head2.php";

$mes = 0;
$anio = 0;
$codigo=0;

if (empty($_GET['variable1'])) {
	$errors[] = "Código de recibo";

 } else if (
	 !empty($_GET['variable1']) 
 ){

$codigo = $_GET['variable1'];

}

$cadena_script="call recibo_pago($codigo)";

		$consulta=$cadena_script;
		$resultado=$con->query($consulta);

		
		$con->next_result();
$cadena_script2="call recibo_pago_detalle($codigo)";

		$consulta2=$cadena_script2;
		$resultado2=$con->query($consulta2);

		
class PDF extends FPDF
{	
// Cabecera de página
function Header()
{
    
}
// Pie de página
function Footer()
{
   
}
}

$pdf = new PDF('P', 'mm', 'A4'); //DIMENSION BOLETA
$pdf -> AliasNbPages();
$pdf->AddPage();


if ($codigo!="") {
	while ($row=$resultado->fetch_assoc()) {
		
			$pdf->SetFont('Arial','B',10);
			$pdf->Image('../images/profiles/logo4.png',17,5,66);
			$pdf->Cell(120);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(70,6,utf8_decode("RECIBO DE PAGO"),1,1,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(120);
			$pdf->Cell(70,6,utf8_decode('RUC: 00000000000'),1,1,'C',0);
			$pdf->Cell(120);
			$pdf->Cell(70,6,utf8_decode($row['serie'])."-".utf8_decode($row['numero']),1,1,'C',0);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			$pdf->SetFont('Arial','',7);
			//$pdf->Cell(70,4,utf8_decode('Jr. Chancay 282 - Lima 1/Telf.: 203-7728 / WhatsApp: 989-041-308'),0,0,'D',0);
			$pdf->Cell(120);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(70,4,utf8_decode('Válido para efectos tributarios, según literal b) inc. 6.2. Cap. I  - Reg.'),0,1,'C',0);
			$pdf->SetFont('Arial','',7);
			//$pdf->Cell(70,4,utf8_decode('E-mail: psamaniego@arzobispadodelima.org'),0,0,'C',0);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(120);
			$pdf->Cell(70,4,utf8_decode('de comprobantes de pago - Res. Superintendencia Nº 007-99/SUNAT'),0,1,'C',0);
			$pdf->SetFont('Arial','',7);
			//$pdf->Cell(70,4,utf8_decode('legal@arzobispadodelima.org'),0,1,'C',0);
			$pdf->Cell(70,4,utf8_decode('Jirón Carabaya 15001 - Lima / Telf.: 000-0000 / WhatsApp: 999-999-999'),0,1,'D',0);
			$pdf->SetFont('Arial','B',10); 
			$pdf->Cell(150,5,utf8_decode('_________________________________________________________________________________________________'),0,1,'D',0);
			$pdf->SetFont('Arial','I',10); 
			$pdf->Ln(2);
			$pdf->Cell(40,6,utf8_decode('Fecha:           ').utf8_decode($row['fecha_recibo']),0,0,'D',0);
			$pdf->Cell(115);
			$pdf->SetTextColor(251,4,4); //COLOR
			$pdf->SetFont('Arial','B',10); 
			$pdf->Cell(40,6,'',0,1,'D',0);
			$pdf->SetFont('Arial','I',10); 
			$pdf->SetTextColor(0,0,0); //COLOR
			$pdf->Cell(40,6,utf8_decode('Dni / Ruc :     ').utf8_decode($row['dni']),0,1,'D',0);
			$pdf->Cell(40,6,utf8_decode('Nombre :       ').utf8_decode($row['nombre']),0,1,'D',0);
			$pdf->Cell(40,6,utf8_decode('Dirección:      ').utf8_decode($row['direccion']),0,1,'D',0);
			$nombre_recibo=utf8_decode($row['dni']);
			
			$pdf->Cell(150,6,utf8_decode('_________________________________________________________________________________________________'),0,1,'D',0);
			//$pdf->SetFillColor(55,55,55);
			$pdf->SetFont('Arial','B',10); 
			$pdf->Cell(2);
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(20,6,utf8_decode('Cantidad'),1,0,'C',TRUE);
			$pdf->Cell(20,6,utf8_decode('Unidad'),1,0,'C',TRUE);
			$pdf->Cell(72,6,utf8_decode('Descripción'),1,0,'C',TRUE);
			$pdf->Cell(38,6,utf8_decode('P. Unitario'),1,0,'C',TRUE);
			$pdf->Cell(38,6,utf8_decode('P. Sub Total'),1,1,'C',TRUE);
			$pdf->SetTextColor(0,0,0); //COLOR
			$pdf->SetFont('Arial','I',10); 
			$importe_total=0;
			//$pdf->Cell(6);
			while ($row2=$resultado2->fetch_assoc()) {
			$pdf->Cell(20,6,utf8_decode($row2['cantidad']),0,0,'C',0);
			$pdf->Cell(3);
			$pdf->Cell(20,6,utf8_decode('Ticket'),0,0,'C',0);
			$pdf->Cell(72,6,utf8_decode($row2['nombre']),0,0,'D',0);
			$pdf->Cell(8);
			$pdf->Cell(38,6,$row2['moneda'].utf8_decode(number_format($row2['importe'],2)),0,0,'D',0);
			$pdf->Cell(38,6,$row2['moneda'].utf8_decode(number_format($row2['total'],2)),0,1,'D',0);
			$importe_total=$importe_total+$row2['total'];
			}

			
		
			$pdf->Cell(150,6,utf8_decode('_________________________________________________________________________________________________'),0,1,'D',0);
			$pdf->SetFont('Arial','B',10); 
			$pdf->Cell(112);
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(40,6,utf8_decode('SUB TOTAL:'),1,0,'D',TRUE);
			$pdf->SetTextColor(0,0,0); //COLOR
			$pdf->SetFont('Arial','I',10); 
			$pdf->Cell(38,6,'          '.$row['moneda'].utf8_decode(number_format($importe_total,2)),1,1,'D',0);
			$pdf->SetFont('Arial','B',10); 
			$pdf->Cell(112);
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(40,6,utf8_decode('IMPORTE TOTAL:'),1,0,'D',TRUE);
			$pdf->SetTextColor(0,0,0); //COLOR
			$pdf->SetFont('Arial','I',10); 
			$pdf->Cell(38,6,'          '.$row['moneda'].utf8_decode(number_format($importe_total,2)),1,1,'D',0);
			$pdf->SetDrawColor(188,188,188); //COLOR
			//$pdf->Line(0,100,100,100);//INSERTAR LINEA
			$pdf->Ln(5);
			$pdf->Cell(15);
			$pdf->SetFont('Arial','',7);
			//$pdf->Cell(38,6,utf8_decode('Valor Unitario'),1,1,'C',0);
			$pdf->Cell(160,4,utf8_decode('ADVERTENCIA: EL PRESENTE DOCUMENTO CONSTITUYE EL ÚNICO COMPROBANTE DE PAGO VÁLIDO PARA AMBAS PARTES.'),1,1,'C',0);

			//SELLO DE CANCELADO BCP
			$pdf->Ln(15);
			$pdf->SetTextColor(0,0,0); //COLOR
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(120); 
			$pdf->Cell(38,4,'CATEDRAL DE LIMA',0,1,'C',0);
			$pdf->SetFont('Arial','',10); 
			$pdf->Cell(120); 
			$pdf->Cell(38,4,'Oficina de Tesoreria',0,1,'C',0);
			$pdf->SetFont('Arial','B',10); 
			$pdf->Cell(120); 
			$pdf->Cell(38,4,'CANCELADO',0,1,'C',0);
			$pdf->SetFont('Arial','',10); 
			//if($fecha_cobranza_validar!= null){
				$dia_cobranza_validar=date("d", strtotime($row['fecha_cobranza']));
				$mes_cobranza_validar=date("m", strtotime($row['fecha_cobranza']));
				$nombremes='';
				if ($mes_cobranza_validar=='01'){
					$nombremes='ENERO';
				}elseif ($mes_cobranza_validar=='02'){
					$nombremes='FEBRERO';
				}elseif ($mes_cobranza_validar=='03'){
					$nombremes='MARZO';
				}elseif ($mes_cobranza_validar=='04'){
					$nombremes='ABRIL';
				}elseif ($mes_cobranza_validar=='05'){
					$nombremes='MAYO';
				}elseif ($mes_cobranza_validar=='06'){
					$nombremes='JUNIO';
				}elseif ($mes_cobranza_validar=='07'){
					$nombremes='JULIO';
				}elseif ($mes_cobranza_validar=='08'){
					$nombremes='AGOSTO';
				}elseif ($mes_cobranza_validar=='09'){
					$nombremes='SETIEMBRE';
				}elseif ($mes_cobranza_validar=='10'){
					$nombremes='OCTUBRE';
				}elseif ($mes_cobranza_validar=='11'){
					$nombremes='NOVIEMBRE';
				}elseif ($mes_cobranza_validar=='12'){
					$nombremes='DICIEMBRE';
				}else {
					$nombremes='';
				}
				$anio_cobranza_validar=date("Y", strtotime($row['fecha_cobranza']));
				$pdf->Cell(120); 
				$pdf->Cell(38,4,'El '.$dia_cobranza_validar.' de '.$nombremes.' del '.$anio_cobranza_validar,0,1,'C',0);
				//$pdf->SetDrawColor(188,188,188); //COLOR
			//}
			
			//}
			
	
	}
}


$pdf->Output('I','RECIBO_'.$nombre_recibo.'.pdf');
?>
