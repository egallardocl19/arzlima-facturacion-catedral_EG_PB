
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
        <img src="../images/profiles/catedral2.png?<?php echo rand()?>" height="80" width="220" style="border: 0px solid #000;"/></br>

        <div class="contenedor">
            <!-- <img src="../images/profiles/logo4.png?<?php echo rand()?>" height="100" width="220"/> -->
        
            <!-- <font size="2" style="font-weight: bolder">MUSEO DE ARTE RELIGIOSO</font> -->
                <table border="1px" width ="50%" height ="10px" style="border-collapse:collapse; text-align:center;margin:auto">
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
            <Img src="resultado.png?<?php echo rand()?>" height="130" width="130"/>

            <table border="1px"  style="border-collapse:collapse; text-align:center; margin:auto">
                <tr>
                    <td ><font size="1" style="font-weight: bolder; font-family: Calibri">TIPO TICKET</font></td>
                    <td ><font size="1" style="font-weight: bolder; font-family: Calibri">CANT.</font></td>
                    <td ><font size="1" style="font-weight: bolder; font-family: Calibri">P.UNIT</font></td>
                    <td ><font size="1" style="font-weight: bolder; font-family: Calibri">SUBTOTAL</font></td>
                </tr>
                
                <?php
                while ($row=$resultado_detalle->fetch_assoc()) {
                ?>
                    <tr>
                    <td ><font size="1" style="font-weight: Calibri; font-family: Calibri"><?php echo substr($row['nombre'],0,19)?></font></td>
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
                <font size="1" style="font-weight: bolder;font-family: Calibri">*** <?php echo $nombre_estado?>***</font></br>
                <!-- <font size="1" style="font-weight: bolder">--------------------------------</font></br> -->
                <font size="1" style="font-weight: bolder;font-family: Calibri"><?php echo $tipo_pago?></font></br>
                <table border="0px"  style="border-collapse:collapse; text-align:center; margin:auto" width ="50%" height ="10px">
                <tr>
                    <td ><font size="1"  style="font-family: Calibri">EL PRESENTE DOCUMENTO CONSTITUYE EL ÚNICO COMPROBANTE DE PAGO VÁLIDO PARA AMBAS PARTES.</font></br>
                    <font style="font-family: Calibri;font-size: 50%;">INAFECTO: Por el convenio suscrito entre el Gobierno Peruano y la Santa Sede. Decreto Ley 23211 - Decreto Legislativo 628.</font></td>
                </table>
                
          

        </div>
        
    </div>



    </body>



</html>
