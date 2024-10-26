<?php
	
	require ('../config/config.php');
	
	$condicion = $_POST['condicion'];
    $condicion2 = $_POST['condicion2'];
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

    if ($caso=="3"){
        $importe=mysqli_query($con,"SELECT importe as importe,format(importe,2) as importe2 FROM tipos_ticket where id=$condicion");

        if (!$importe||mysqli_num_rows($importe)!=0){
            while($rowM = $importe->fetch_assoc())
                {
                $val=$rowM['importe'];
                
                }
        }else{
            $val= "0";
           
        }

        echo $val;
    }

    if ($caso=="4"){
        if ($condicion!=""){
            $importe=mysqli_query($con,"SELECT if(sum(c.importe)is null,0,sum(c.importe)) as importe FROM cobranza c, ticket t 
            where c.idticket=t.id and t.idestado_ticket<>3 and c.idformapago=6 and c.fecha='$condicion'");
            while($rowM = $importe->fetch_assoc())
            {
            $validar_importe=$rowM['importe'];
            }

            if ($validar_importe > 0){
                $val= "0";     
            }else{

                $importe2=mysqli_query($con,"SELECT if(sum(c.importe)is null,0,sum(c.importe)) as importe FROM cobranza c, ticket t 
                where c.idticket=t.id and t.idestado_ticket<>3 and c.idformapago=4 and c.fecha='$condicion'");
                while($rowM = $importe2->fetch_assoc())
                {
                $validar_importe2=$rowM['importe'];
           
                }

                if ($validar_importe2 > 0){
                   $val= $validar_importe2;
                }else{
                    $val= "0";
                           
                }    
               
                
            }
                
                
        }else{
                $val= "0";
                    
        }
        echo $val;
    }

    if ($caso=="5"){
        $dato=mysqli_query($con,"SELECT celular FROM agencias_guias where id='$condicion'");

        if (!$dato||mysqli_num_rows($dato)!=0){
            while($rowM = $dato->fetch_assoc())
                {
                $val=$rowM['celular'];
                
                }
        }else{
            $val= "0";
           
        }

        echo $val;
    }

    if ($caso=="6"){
        if ($condicion!=""){
            $importe=mysqli_query($con,"SELECT if(sum(c.importe)is null,0,sum(c.importe)) as importe FROM cobranza c, ticket t 
            where c.idticket=t.id and t.idestado_ticket<>3 and c.idformapago=6 and c.fecha='$condicion' and t.serie='$condicion2'  and t.id in
            (SELECT tt.id FROM cobranza cc, ticket tt 
            where cc.idticket=tt.id and tt.idestado_ticket<>3 and cc.idformapago=4 and cc.fecha='$condicion' and tt.serie='$condicion2' )");
            
            while($rowM = $importe->fetch_assoc())
            {
            $validar_importe=$rowM['importe'];
            }

            if ($validar_importe > 0){
                $val= "0";     
            }else{

                $importe2=mysqli_query($con,"SELECT if(sum(c.importe)is null,0,sum(c.importe)) as importe FROM cobranza c, ticket t 
                where c.idticket=t.id and t.idestado_ticket<>3 and c.idformapago=4 and c.fecha='$condicion' and t.serie='$condicion2'");
                while($rowM = $importe2->fetch_assoc())
                {
                $validar_importe2=$rowM['importe'];
           
                }

                if ($validar_importe2 > 0){
                   $val= $validar_importe2;
                }else{
                    $val= "0";
                           
                }    
               
                
            }
                
                
        }else{
                $val= "0";
                    
        }
        echo $val;
    }

    if ($caso=="7"){
        if ($condicion!=""){
            $importe=mysqli_query($con,"SELECT if(sum(c.importe)is null,0,sum(c.importe)) as importe FROM cobranza c, ticket t, agencias_movimientos am 
            where c.idticket=t.id and t.id=am.idticket and t.idestado_ticket<>3 and c.idformapago=6 and c.fecha='$condicion' and t.idclase_ticket=3 and am.idagencia='$condicion2'");
            while($rowM = $importe->fetch_assoc())
            {
            $validar_importe=$rowM['importe'];
            }

            if ($validar_importe > 0){
                $val= "0";     
            }else{

                $importe2=mysqli_query($con,"SELECT if(sum(t.monto_total)is null,0,sum(t.monto_total)) as importe FROM ticket t, agencias_movimientos am 
            where t.id=am.idticket and t.idestado_ticket=1 and t.fecha='$condicion' and t.idclase_ticket=3 and am.idagencia='$condicion2'");
                while($rowM = $importe2->fetch_assoc())
                {
                $validar_importe2=$rowM['importe'];
           
                }

                if ($validar_importe2 > 0){
                   $val= $validar_importe2;
                }else{
                    $val= "0";
                           
                }    
               
                
            }
                
                
        }else{
                $val= "0";
                    
        }
        echo $val;
    }
?>		