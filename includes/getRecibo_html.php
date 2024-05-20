<?php
	
	require ('../config/config.php');
	
	$condicion = $_POST['condicion'];
    $caso = $_POST['caso'];
    $tipo = $_POST['tipo'];

    if ($caso=="1"){
        if ($condicion!=""){
            $tipo =mysqli_query($con, "SELECT tt.id,tt.nombre,tm.signo,format(tt.importe,2) as importe FROM tipos_ticket tt, tipo_moneda tm 
            where tt.idtipo_moneda=tm.id and tt.idclase_ticket=$condicion and tt.idestado_dato=1 order by tt.importe desc");

            $html= "<option value=''>-- Seleccionar Tipo Ticket --</option>";
            while($rowM = $tipo->fetch_assoc())
            {
                $html.= "<option value='".$rowM['id']."'>".$rowM['nombre']."   -   ".$rowM['signo'].$rowM['importe']."</option>";  
            } 
            echo $html;
        }else{
            $html= "<option value=''>-- Seleccionar Clase Ticket --</option>";
            echo $html;
            }

        
    }

    if ($caso=="2"){
        if ($condicion!=""){
            $tipo_recibo=mysqli_query($con, "SELECT rs.abrev,rs.serial as serial,
            (select nombre from recibos_tipos where id=rs.idrecibos_tipos) as nombre FROM recibos_serial rs where activo=1 and abrev in 
            (select idrecibos_serial from clase_ticket where id=$condicion)");

            
            while($rowM = $tipo_recibo->fetch_assoc())
            {
                $html= "<option value='".$rowM['abrev']."'>".$rowM['serial']."   -   ".$rowM['nombre']."</option>";  
            } 
            echo $html;
        }else{
            $html= "<option value=''>-- Seleccionar Clase Ticket --</option>";
            echo $html;
            }

        
    }

    if ($caso=="3"){
        if ($condicion!=""){
            $ticket=mysqli_query($con, "SELECT t.id,concat(t.serie,'-',t.numero) as ticket,t.fecha,t.dni,
            (select signo from tipo_moneda where id=
            (select idtipo_moneda from tipos_ticket where id=t.idtipo_ticket)) as moneda,
            format(t.monto_total,2) as monto FROM ticket t where t.idestado_ticket=1 order by fecha desc;");

            $html= "<option value=''>-- Seleccionar Ticket--</option>";
            while($rowM = $ticket->fetch_assoc())
            {
                $html.= "<option value='".$rowM['id']."'>"."N° ".$rowM['ticket']."   -  Fecha: ".$rowM['fecha'].
                " - DNI/RUC: ".$rowM['dni']." - Importe: ".$rowM['moneda'].$rowM['monto']."</option>";  
            } 
            echo $html;
        }else{
            $html= "<option value=''>-- Seleccionar Ticket--</option>";
            echo $html;
            }

        
    }
    
    if ($caso=="4"){
        if ($condicion!=""){
            $tipo =mysqli_query($con, "SELECT tt.id,tt.nombre,tm.signo,format(tt.importe,2) as importe FROM tipos_ticket tt, tipo_moneda tm 
            where tt.idtipo_moneda=tm.id and tt.idclase_ticket=$condicion and tt.id=$tipo and  tt.idestado_dato=1 order by tt.importe desc");


            while($rowM = $tipo->fetch_assoc())
            {
                $html= "<option value='".$rowM['id']."'>".$rowM['nombre']."   -   ".$rowM['signo'].$rowM['importe']."</option>";  
            } 
            echo $html;
        }else{
            $html= "<option value=''>-- Seleccionar Tipo Ticket --</option>";
            echo $html;
            }

        
    }

    if ($caso=="5"){
        if ($condicion!=""){
            $tipo =mysqli_query($con, "SELECT rs.abrev as abrev,ct.id as id FROM recibos_serial rs, clase_ticket ct 
            where rs.abrev=ct.idrecibos_serial and  rs.activo=1 and ct.id=$condicion");


            while($rowM = $tipo->fetch_assoc())
            {
                $html= "<option value='".$rowM['id']."'>".$rowM['abrev']."</option>";  
            } 
            echo $html;
        }else{
            $html= "<option value=''>-- Seleccionar Clase Ticket --</option>";
            echo $html;
            }

        
    }

  
    
?>		