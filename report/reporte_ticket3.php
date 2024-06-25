
<?php
require('../fpdf/fpdf.php');
include "../config/config.php";//Contiene funcion que conecta a la base de datos
include "../head2.php";

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

$cadena_script0="call reporte_ticket('6','$where')";
$consulta=$cadena_script0;
$resultado=$con->query($consulta);

		

class PDF extends FPDF
{	
// Cabecera de página
function Header()
{
	include "../config/configreport.php";//Contiene funcion que conecta a la base de datos
	//$dni = $_POST['dni'];
	$tipo_pago = $_POST['tipo_pago'];
	$tipo_ticket = $_POST['tipo_ticket'];
	$fecha1 = $_POST['fecha_inicio'];
	$fecha2 = $_POST['fecha_fin'];
	$nombre_clase ="";
	$nombre_pago ="";

	if ($tipo_ticket>0) {
		$consulta2="SELECT nombre from clase_ticket where id='$tipo_ticket'";
		$resultado2=$con->query($consulta2);
		while ($row=$resultado2->fetch_assoc()) {
			$nombre_clase=utf8_decode($row['nombre']);
		}

	}else{
		$nombre_clase="TODOS";
	}

	if ($tipo_pago>0) {
		$consulta3="SELECT nombre from formapago where id='$tipo_pago'";
		$resultado3=$con->query($consulta3);
		while ($row=$resultado3->fetch_assoc()) {
			$nombre_pago=utf8_decode($row['nombre']);
		}	
	}else{
			$nombre_pago="TODOS";
	}
	
	setlocale(LC_TIME, 'es_ES.UTF-8');
	setlocale(LC_TIME, 'spanish');
	$inicio ="";
	$inicio2 ="";

	if ($fecha1!="") {
		$fecha1=$fecha1;
		$inicio = strftime("%A, %d de %B del %Y", strtotime($fecha1));
	}else{
		$fecha1="";
	}
	if ($fecha2!="") {
		$fecha2=$fecha2;
		$inicio2 = strftime("%A, %d de %B del %Y", strtotime($fecha2));
	}else{
		$fecha2="";
	}


	$fecha =date('d/m/Y'); 
	$time =date('h:i:s a'); 
    // Logo
    $this->Image('../images/profiles/logo4.png',10,5,66);

    $this->SetFont('Arial','B',12);

    $this->Cell(100);

    $this->Cell(100,10,'REPORTE TICKET DETALLE - '.$nombre_clase,0,0,'C');
	$this->SetFont('Arial','B',8);
	$this->Cell(50);
	$this->Cell(20,10,'Fecha: '.$fecha,0,1,'C');
	$this->SetFont('Arial','B',9);
	$this->Cell(110);
	$this->SetTextColor(37,67,120);
	$this->Cell(30,5,utf8_decode('FECHA INICIO: '),0,0,'C');
	//$this->Cell(100);
	$this->Cell(50,5,$inicio,0,0,'C');
	$this->Cell(55);
	$this->Cell(25,5,'Hora: '.$time,0,1,'C');
	$this->Cell(110);
	$this->Cell(30,5,'FECHA FIN:',0,0,'C');
	//$this->Cell(50);
	$this->Cell(50,5,$inicio2,0,1,'C');
	$this->SetFont('Arial','B',8);
	$this->SetTextColor(0,0,0);
	
	$this->Cell(132);
	$this->SetTextColor(37,67,120);
	$this->Cell(30,5,utf8_decode('FORMA PAGO: ').$nombre_pago,0,1,'C');
	
	

    $this->Ln(3);

	$this->SetFont('Arial','B',8);

	$this->SetFillColor(37,67,120);//Fondo verde de celda
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
	$this->Cell(13,6,utf8_decode('SERIE'),1,0,'C',TRUE);
	$this->Cell(17,6,utf8_decode('NUMERO'),1,0,'C',TRUE);
	$this->Cell(20,6,utf8_decode('DIA'),1,0,'C',TRUE);
	$this->Cell(25,6,utf8_decode('FECHA EMISIÓN'),1,0,'C',TRUE);
	$this->Cell(15,6,utf8_decode('HORA'),1,0,'C',TRUE);
	$this->Cell(25,6,utf8_decode('TIPO TICKET'),1,0,'',TRUE);
	$this->Cell(55,6,utf8_decode('CONCEPTO'),1,0,'C',TRUE);
	$this->Cell(18,6,utf8_decode('PRECIO'),1,0,'C',TRUE);
	$this->Cell(13,6,utf8_decode('CANT.'),1,0,'C',TRUE);
	$this->Cell(18,6,utf8_decode('TOTAL'),1,0,'C',TRUE);
	$this->Cell(20,6,utf8_decode('TIPO PAGO'),1,0,'C',TRUE);
	$this->Cell(17,6,utf8_decode('N° PAGO'),1,0,'C',TRUE);
	$this->Cell(24,6,utf8_decode('CAJERO'),1,1,'C',TRUE); 
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
$suma_cantidad=0;
$suma_totales=0;
$suma_cantidad2=0;
$suma_totales2=0;
$suma_cantidad3=0;
$suma_totales3=0;
$producto_cantidad=0;
$producto_totales=0;
$producto_cantidad2=0;
$producto_totales2=0;
$producto_cantidad3=0;
$producto_totales3=0;
$moneda='';


	while ($row=$resultado->fetch_assoc()) {
		
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(13,5,utf8_decode($row['serie']),0,0,'C',0);
			$pdf->Cell(17,5,utf8_decode($row['numero']),0,0,'C',0);
			$pdf->Cell(20,5,strftime("%A", strtotime($row['fecha'])),0,0,'C',0);
			$pdf->Cell(25,5,utf8_decode($row['fecha']),0,0,'C',0);
			$pdf->Cell(15,5,utf8_decode($row['hora']),0,0,'C',0);
			$pdf->Cell(25,5,substr(utf8_decode($row['clase_ticket']),0,14),0,0,'',0);
			$pdf->Cell(55,5,utf8_decode($row['tipo_ticket']),0,0,'',0);
			$pdf->Cell(18,5,number_format(utf8_decode($row['importe']),2),0,0,'C',0); 
			$pdf->Cell(13,5,utf8_decode($row['cantidad']),0,0,'C',0);
			$pdf->Cell(18,5,number_format(utf8_decode($row['costo_total']),2),0,0,'C',0); 
			$pdf->Cell(20,5,utf8_decode($row['forma_pago']),0,0,'C',0);
			$pdf->Cell(17,5,utf8_decode($row['referencia']),0,0,'C',0);
			$pdf->Cell(24,5,utf8_decode($row['cajero']),0,1,'C',0);

			$clase_ticket=$row['idclase_ticket'];
			if ($clase_ticket ==1 or $clase_ticket ==2 or $clase_ticket ==3 ){
				//$moneda=$row['signo_moneda'];
				if($row['forma_pago']=="EFECTIVO"){
				$suma_cantidad=$suma_cantidad+$row['cantidad'];
				$suma_totales=$suma_totales+$row['costo_total'];
				}	
				if($row['forma_pago']=="IZIPAY"){
					$suma_cantidad2=$suma_cantidad2+$row['cantidad'];
					$suma_totales2=$suma_totales2+$row['costo_total'];
				}
				if($row['forma_pago']=="TRANSFERENCIA"){
					$suma_cantidad3=$suma_cantidad3+$row['cantidad'];
					$suma_totales3=$suma_totales3+$row['costo_total'];
				}
			}
			
			if ($clase_ticket ==5){
				//$moneda=$row['signo_moneda'];
				if($row['forma_pago']=="EFECTIVO"){
				$producto_cantidad=$producto_cantidad+$row['cantidad'];
				$producto_totales=$producto_totales+$row['costo_total'];
				}	
				if($row['forma_pago']=="IZIPAY"){
					$producto_cantidad2=$producto_cantidad2+$row['cantidad'];
					$producto_totales2=$producto_totales2+$row['costo_total'];
				}
				if($row['forma_pago']=="TRANSFERENCIA"){
					$producto_cantidad3=$producto_cantidad3+$row['cantidad'];
					$producto_totales3=$producto_totales3+$row['costo_total'];
				}
			}
			
	}
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			if($suma_cantidad>0){
			$pdf->Cell(80);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(60,5,utf8_decode('Total Venta Entrada EFECTIVO.:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			//$pdf->Cell(20);
			$pdf->Cell(40,5,'Personas: '.$suma_cantidad,1,0,'C',0);
			$pdf->Cell(40,5,'Ingreso Total: '.$moneda.number_format($suma_totales,2),1,1,'C',0);
			}
			if($suma_cantidad2>0){
			$pdf->Cell(80);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(60,5,utf8_decode('Total Venta Entrada POS.:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			//$pdf->Cell(20);
			$pdf->Cell(40,5,'Personas: '.$suma_cantidad2,1,0,'C',0);
			$pdf->Cell(40,5,'Ingreso Total: '.$moneda.number_format($suma_totales2,2),1,1,'C',0);
			}
			if($suma_cantidad3>0){
			$pdf->Cell(80);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(60,5,utf8_decode('Total Venta Entrada TRANSFERENCIA.:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			//$pdf->Cell(20);
			$pdf->Cell(40,5,'Personas: '.$suma_cantidad3,1,0,'C',0);
			$pdf->Cell(40,5,'Ingreso Total: '.$moneda.number_format($suma_totales3,2),1,1,'C',0);
			}
			$suma_cantidad_entradas=$suma_cantidad+$suma_cantidad2+$suma_cantidad3;
			if($suma_cantidad_entradas>0){
			$pdf->Cell(80);
			$pdf->SetFillColor(37,67,120);//Fondo verde de celda
			$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
			$pdf->Cell(60,5,utf8_decode('Total Venta Entrada Cobrado.:'),1,0,'C',TRUE);
			$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
			//$pdf->Cell(20);
			$pdf->Cell(40,5,'Personas: '.$suma_cantidad_entradas,1,0,'C',0);
			$pdf->Cell(40,5,'Ingreso Total: '.$moneda.number_format(($suma_totales+$suma_totales2+$suma_totales3),2),1,1,'C',0);
			$pdf->Ln(5);
			}

			if($producto_cantidad>0){
				$pdf->Cell(80);
				$pdf->SetFillColor(37,67,120);//Fondo verde de celda
				$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
				$pdf->Cell(60,5,utf8_decode('Total Venta Producto EFECTIVO.:'),1,0,'C',TRUE);
				$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
				//$pdf->Cell(20);
				$pdf->Cell(40,5,'Productos: '.$producto_cantidad,1,0,'C',0);
				$pdf->Cell(40,5,'Ingreso Total: '.$moneda.number_format($producto_totales,2),1,1,'C',0);
				}
				if($producto_cantidad2>0){
				$pdf->Cell(80);
				$pdf->SetFillColor(37,67,120);//Fondo verde de celda
				$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
				$pdf->Cell(60,5,utf8_decode('Total Venta Producto POS.:'),1,0,'C',TRUE);
				$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
				//$pdf->Cell(20);
				$pdf->Cell(40,5,'Productos: '.$producto_cantidad2,1,0,'C',0);
				$pdf->Cell(40,5,'Ingreso Total: '.$moneda.number_format($producto_totales2,2),1,1,'C',0);
				}
				if($producto_cantidad3>0){
				$pdf->Cell(80);
				$pdf->SetFillColor(37,67,120);//Fondo verde de celda
				$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
				$pdf->Cell(60,5,utf8_decode('Total Venta Producto TRANSFERENCIA.:'),1,0,'C',TRUE);
				$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
				//$pdf->Cell(20);
				$pdf->Cell(40,5,'Productos: '.$producto_cantidad3,1,0,'C',0);
				$pdf->Cell(40,5,'Ingreso Total: '.$moneda.number_format($producto_totales3,2),1,1,'C',0);
				}
				$suma_cantidad_productos=$producto_cantidad+$producto_cantidad2+$producto_cantidad3;
				if($suma_cantidad_productos>0){
				$pdf->Cell(80);
				$pdf->SetFillColor(37,67,120);//Fondo verde de celda
				$pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
				$pdf->Cell(60,5,utf8_decode('Total Venta Producto Cobrado.:'),1,0,'C',TRUE);
				$pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
				//$pdf->Cell(20);
				$pdf->Cell(40,5,'Productos: '.$suma_cantidad_productos,1,0,'C',0);
				$pdf->Cell(40,5,'Ingreso Total: '.$moneda.number_format(($producto_totales+$producto_totales2+$producto_totales3),2),1,1,'C',0);
				}
$pdf->Output();

?>
