<?php
	
	require ('../config/config.php');
	
	$condicion = $_POST['condicion'];
    $caso = $_POST['caso'];

    if ($caso=="1"){
        $importe=mysqli_query($con,"SELECT importe as importe,format(importe,2) as importe2 FROM tipos_ticket where id=$condicion");

        if (!$importe||mysqli_num_rows($importe)!=0){
            while($rowM = $importe->fetch_assoc())
                {
                $val=$rowM['importe'];
                $val2=$rowM['importe2'];
                $val3= "";
                $val4= "";
                $val5= "0";
                $val6= "0";
                $val7= "0";
                }
        }else{
            $val= "0";
            $val2= "0";
            $val3= "";
            $val4= "";
            $val5= "0";
            $val6= "0";
            $val7= "0";
        }

        echo $val,'-',$val2;
    }

    if ($caso=="2"){
        $ticket=mysqli_query($con,"SELECT t.id, t.dni,t.nombre,t.direccion,date_format(t.fecha,'%Y/%m/%d') as fecha,t.cantidad,format(t.monto_total,2) as monto_total,
        (select format(importe,2) from tipos_ticket where id=t.idtipo_ticket) as importe FROM ticket t where t.id=$condicion");

        if (!$ticket||mysqli_num_rows($ticket)!=0){
            while($rowM = $ticket->fetch_assoc())
                {
                $val=$rowM['dni'];
                $val2=$rowM['nombre'];
                $val3=$rowM['direccion'];
                $val4=$rowM['fecha'];
                $val5=$rowM['cantidad'];
                $val6=$rowM['monto_total'];
                $val7=$rowM['importe'];
                }
        }else{
            $val= "";
            $val2= "";
            $val3= "";
            $val4= "";
            $val5= "0";
            $val6= "0";
            $val7= "0";
        }

        echo $val,'-',$val2,'-',$val3,'-',$val4,'-',$val5,'-',$val6,'-',$val7;
    }

    
?>		