
<?php
//require('../fpdf/pdf_js.php');
//include "../service/config/config.php";//Contiene funcion que conecta a la base de datos
include "../config/config.php";//Contiene funcion que conecta a la base de datos
include "../head2.php";
include('../phpqrcode/qrlib.php'); 



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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript">
            function imprimir() {
                if (window.print) {
                    window.print();
                } else {
                    alert("La función de impresion no esta soportada por su navegador.");
                }
            }
        </script>
        
    </head>
    <link href="../css/style.css" rel="stylesheet" type="text/css" /> 
    <link
  href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
  rel="stylesheet"
  type="text/css" />
    <body  style="width:100%;"
      onload="imprimir();" >
  
      <!-- <img src="../images/profiles/fondo.png"  alt=""  height="400" width="300" /> -->
    <div class="contenedor">
        <!-- <img src="../images/profiles/fondo.png?<?php echo rand()?>" height="1000" width="300"/> -->
    
        <div class="contenedor">
            <!-- <img src="../images/profiles/logo4.png?<?php echo rand()?>" height="100" width="220"/> -->
        
            <!-- <font size="2" style="font-weight: bolder">MUSEO DE ARTE RELIGIOSO</font> -->
                <table border="0px" width ="50%" height ="10px" style="border-collapse:collapse; text-align:center;margin:auto">
                <tr>
                    <td>
                    <div class="contenedor">
                     <!-- <img src="../images/profiles/recta.png?<?php echo rand()?>" height="25" width="250">  -->
                     <!-- <div class="centrado"> color="#FFFFFF"-->
                    <font  style="font-weight: bolder; font-family: Calibri" size="4">Nº TICKET</font>
                    <!-- </div> -->
                    </div>
                    </td>
                   
                </tr>
                <!-- </table>
                <table border="1px" width ="50%" height ="10px" style="border-collapse:collapse; text-align:center;margin:auto"> -->
                <tr>
                    <td><font size="3" style="font-weight: bolder; font-family: Calibri"><?php echo $serie."-".$numero?></font></td>
                </tr>
                </table>
            <font size="1" style="font-weight: bolder; font-family: Calibri">  FECHA:<?php echo $fecha?> - HORA: <?php echo $hora?></font>  </br>
            <font size="1" style="font-weight: bolder; font-family: Calibri">  TICKET:<?php echo utf8_decode($clase)?> - CAJERO: <?php echo $iduser_add?></font>
        </br>
 
            <?php
            $contenido = $serie."-".$numero;
            QRcode::png($contenido,"resultado.png",QR_ECLEVEL_L,10,2);
            ?>
            <Img src="resultado.png?<?php echo rand()?>" height="180" width="180"/>

            <table border="0px"  style="border-collapse:collapse; text-align:center; margin:auto">
                <tr style="background-color: black">
                    <td ><font size="1" style="font-weight: bolder; font-family: Calibri">TIPO TICKET</font></td>
                    <td ><font size="1" style="font-weight: bolder; font-family: Calibri">CANT.</font></td>
                    <td ><font size="1" style="font-weight: bolder; font-family: Calibri">P.UNIT</font></td>
                    <td ><font size="1" style="font-weight: bolder; font-family: Calibri">SUBTOTAL</font></td>
                </tr>
                
                <?php
                while ($row=$resultado_detalle->fetch_assoc()) {
                ?>
                    <tr>
                    <td ><font size="1" style="font-weight: Calibri; font-family: Calibri"><?php echo substr(utf8_decode($row['nombre']),0,19)?></font></td>
                    <td><font size="1" style="font-weight: Calibri; font-family: Calibri"><?php echo $row['cantidad']?></font></td>
                    <td><font size="1" style="font-weight: Calibri; font-family: Calibri"><?php echo $row['moneda'].$row['importe']?></font></td>
                    <td><font size="1" style="font-weight: Calibri; font-family: Calibri"><?php echo $row['moneda'].$row['total']?></font></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
                if($monto_total==0){
                $nombre_monto="POR DEFINIR";
                }else{
                $nombre_monto=$signo.$monto_total;  
                }

            ?>
             </br>
                <font size="3" style="font-family: Calibri">TOTAL: <?php echo $nombre_monto?></font></br>
                <!-- <font size="2" style="font-weight: bolder; font-family: Courier">  DNI:<?php echo utf8_decode($dni)?> - <?php echo utf8_decode($nombre)?></font> </br> -->
                <?php
                if($estado=="PAGADO"){
                    $nombre_estado="CANCELADO";
                }else if($estado=="ANULADO"){
                    $nombre_estado="ANULADO";  
                }else {
                    $nombre_estado="";  
                }

            ?>
                <font size="1" style="font-family: Calibri">*** <?php echo $nombre_estado?>***</font></br>
                <!-- <font size="1" style="font-weight: bolder">--------------------------------</font></br> -->
                <font size="1" style="font-family: Calibri"><?php echo $tipo_pago?></font></br>
                <img src="../images/profiles/catedral2.png?<?php echo rand()?>" height="100" width="250" style="border: 0px solid #000;"/></br>
                
                <font size="1" style="font-family: Calibri">EL PRESENTE DOCUMENTO CONSTITUYE EL</font>
                <font size="1" style="text-align:center; font-family: Calibri">ÚNICO COMPROBANTE DE PAGO VÁLIDO PARA AMBAS PARTES.</font>
          

        </div>
        
    </div>
<!--     
    <style>
         .contenedor{
            position: relative;
            display: inline-block;
            text-align: center;
        }
        .centrado{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        table {
            min-width: 235px;
            height: 20px;
            }
            @font-face {
                font-family: 'Roboto';
                src: url('../images/profiles/Roboto/Roboto-Regular.ttf');
            }
            .roboto {
                font-family: 'Roboto', sans-serif;
            } 
        </style> -->


    </body>



</html>
<!-- class PDF extends FPDF 
//{
	
// Cabecera de página
//function Header()
//{
	
    // Logo
  
   //$this->Image('../images/profiles/fondo.png', 0, 0, 100, 300);
   // $this->Image('../images/profiles/logo4.png',13,10,76);
    
   // $this->SetFont('Arial','B',11);
    
    //$this->Cell(100);

    //$this->Ln(35);
    //$this->Cell(80,5,'MUSEO DE ARTE RELIGIOSO',0,1,'C');
	//$this->SetFont('Arial','B',8);

	//$this->SetDrawColor(188,188,188); //COLOR
	//$this->Line(0,45,100,45);//INSERTAR LINEA
   
    //$this->Ln(1);
	
//}

// Pie de página
//function Footer()
//{
   
  
    //$this->SetY(-23);
    //$this->MultiCell(80,4,utf8_decode('EL PRESENTE DOCUMENTO CONSTITUYE EL ÚNICO COMPROBANTE DE PAGO VÁLIDO PARA AMBAS PARTES.'),'','C',false);
    //$this->SetFont('Arial','I',8);
    //$this->Cell(84,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
//}
//}




// $pdf = new PDF('P', 'mm', array(100,300)); //DIMENSION BOLETA
// $pdf -> AliasNbPages();
// $pdf->AddPage();

// $pdf->SetFont('Arial','B',10);
// $pdf->Cell(0,2,'',0,1,'D',0);
// $pdf->SetFillColor(00,00,00);//Fondo verde de celda
// $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
// $pdf->Cell(80,6,utf8_decode(' Nº TICKET'),1,1,'C',TRUE);
// $pdf->SetTextColor(00,00,00);  // Establece el color del texto (en este caso es blanco)
// $pdf->Cell(80,6,$serie."-".$numero,1,1,'C',0);


//  $pdf->Ln(4);
//  $pdf->SetFont('Arial','B',10);
//  $pdf->Cell(40,5,'FECHA: '.$fecha,0,0,'D',0);
//  $pdf->Cell(40,5,'HORA: '.$hora,0,1,'D',0);
//  $pdf->Cell(45,5,'TICKET: '.utf8_decode($clase),0,0,'D',0);
//  $pdf->Cell(45,5,'CAJERO: '.utf8_decode($iduser_add),0,1,'D',0);
//  $pdf->SetFont('Arial','B',10);

//  if($cantidad==0){
//     $nombre_cantidad="POR DEFINIR";
//     }else{
//     $nombre_cantidad=$cantidad;  
//     }
//     $pdf->Ln(62);
//      $pdf->SetFillColor(00,00,00);//Fondo verde de celda
// 	 $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
// 	 $pdf->Cell(35,6,utf8_decode('TIPO'),1,0,'C',TRUE);
// 	 $pdf->Cell(15,6,utf8_decode('CANT.'),1,0,'C',TRUE);
// 	 $pdf->Cell(15,6,utf8_decode('P.UNIT'),1,0,'C',TRUE);
// 	 $pdf->Cell(15,6,utf8_decode('TOTAL'),1,1,'C',TRUE);

//   while ($row=$resultado_detalle->fetch_assoc()) {
//     $pdf->SetFillColor(37,67,120);//Fondo verde de celda
//  	$pdf->SetTextColor(00,00,00);  // Establece el color del texto (en este caso es blanco)
//     $pdf->Cell(35,5,substr(utf8_decode($row['nombre']),0,19),1,0,'C',0);
//     $pdf->Cell(15,5,utf8_decode($row['cantidad']),1,0,'C',0);
//     $pdf->Cell(15,5,utf8_decode($row['moneda']).$row['importe'],1,0,'C',0);
//     $pdf->Cell(15,5,utf8_decode($row['moneda']).$row['total'],1,1,'C',0);
//   }  

// include('../phpqrcode/qrlib.php'); 
// $contenido = $serie."-".$numero;
// QRcode::png($contenido,"resultado.png",QR_ECLEVEL_L,10,2);
// $pdf->Image('resultado.png', 20, 79, 60, 60);

// $pdf->Ln(2);
// $pdf->SetTextColor(00,00,00);  // Establece el color del texto (en este caso es blanco)
//  $pdf->SetFont('Arial','B',14);
//  if($monto_total==0){
//     $nombre_monto="POR DEFINIR";
//     }else{
//     $nombre_monto=$signo.$monto_total;  
//     }

//  $pdf->Cell(80,5,'TOTAL: '.$nombre_monto,0,1,'C',0);
//  $pdf->Ln(2);
//  $pdf->SetFont('Arial','B',10);
// $pdf->Cell(40,5,'DNI: '.$dni.' - '.$nombre,0,1,'D',0);
// $pdf->SetDrawColor(188,188,188); //COLOR
// $pdf->Line(0,100,100,100);//INSERTAR LINEA
// $pdf->Ln(1);
// $pdf->SetFont('Arial','B',10);
// if($estado=="PAGADO"){
//     $nombre_estado="CANCELADO";
// }else if($estado=="ANULADO"){
//     $nombre_estado="ANULADO";  
// }else {
//     $nombre_estado="";  
// }
// $pdf->Cell(80,3,'***'.$nombre_estado.'***',0,1,'C',0);
// $pdf->Cell(80,3,'---------------------------',0,1,'C',0);
// $pdf->Cell(80,3,$tipo_pago,0,1,'C',0);
// $pdf->Ln(6);

// $pdf->Image('../images/profiles/catedral1.png',11, 195, 80, 80);
// $pdf->Ln(128);
// $pdf->AutoPrint(true);
// //$pdf->Output();
// $pdf->Output('I','recibo'.$serie."-".$numero.'.pdf');


//readfile($rutaArchivo);

//?>

-->