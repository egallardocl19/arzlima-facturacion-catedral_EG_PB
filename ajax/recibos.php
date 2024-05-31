
<?php
	
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
	include '../head2.php';
    $UserData=mysqli_query($con, "select * from user order by created_at desc");
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    $submod=$_SESSION['keytok0']; 
    
 
    			?>

<?php
	
    if($action == 'ajax'){
		
        // escaping, additionally removing everything that could be (html/javascript-) code
       
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $q1 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));
        $q2 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q2'], ENT_QUOTES)));

         $aColumns = array('CONCAT(t.serie,"-",t.numero)');//Columnas de busqueda  
         $sTable = "ticket t, tipo_moneda tm";
         $sWhere = "where t.idtipo_moneda=tm.id and t.idclase_ticket=1";
    
        if ( $_GET['q'] != "" ) 
        {
            $sWhere = "where t.idtipo_moneda=tm.id and t.idclase_ticket=1  and  (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        if ( $_GET['q1'] != "" ) 
        {
            $sWhere = "where t.idtipo_moneda=tm.id and t.idclase_ticket=1  and  (t.fecha='".$q1."' OR ";
            
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
 
        if ( $_GET['q2']!= "" ) 
        {
            $sWhere = "where t.idtipo_moneda=tm.id and t.idclase_ticket=1  and  (t.idestado_ticket='".$q2."' OR ";
            
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        if ( $_GET['q'] != "" && $_GET['q1'] != "") 
       {
           $sWhere = "where t.idtipo_moneda=tm.id and t.idclase_ticket=1  and  t.fecha='".$q1."' and (";
           for ( $i=0 ; $i<count($aColumns) ; $i++ )
           {
               $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
           }
           $sWhere = substr_replace( $sWhere, "", -3 );
           $sWhere .= ')';
       }
       if ( $_GET['q'] != "" && $_GET['q2'] != "") 
       {
           $sWhere = "where t.idtipo_moneda=tm.id and t.idclase_ticket=1  and  t.idestado_ticket='".$q2."' and (";
           for ( $i=0 ; $i<count($aColumns) ; $i++ )
           {
               $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
           }
           $sWhere = substr_replace( $sWhere, "", -3 );
           $sWhere .= ')';
       }
       if ( $_GET['q1'] != "" && $_GET['q2'] != "") 
       {
           $sWhere = "where t.idtipo_moneda=tm.id and t.idclase_ticket=1  and  (t.fecha='".$q1."' and  t.idestado_ticket='".$q2."' OR ";
           
           $sWhere = substr_replace( $sWhere, "", -3 );
           $sWhere .= ')';
       }
       if ( $_GET['q'] != "" && $_GET['q1'] != "" && $_GET['q2'] != "") 
       {
           $sWhere = "where t.idtipo_moneda=tm.id and t.idclase_ticket=1  and  t.fecha='".$q1."' and  t.idestado_ticket='".$q2."' and (";
           for ( $i=0 ; $i<count($aColumns) ; $i++ )
           {
               $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
           }
           $sWhere = substr_replace( $sWhere, "", -3 );
           $sWhere .= ')';
       }

        $sWhere.=" order by t.id desc";
        include 'pagination.php'; //include pagination file  
        //pagination variables
		
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './expences.php';
		//consulta principal para obtener los datos
        $sql="SELECT t.id,t.serie,t.numero,t.fecha,t.hora,t.dni,t.cantidad_total,tm.signo,format(t.monto_total,2) as importe,
        (select nombre from estado_ticket where id=t.idestado_ticket) as estado FROM  $sTable  $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
					   
                        <th class="column-title">Ticket </th>
                        <th class="column-title">Fecha </th>
                        <th class="column-title">Hora </th>
                        <th class="column-title">Cant. </th>
                        <th class="column-title">Monto </th>
                        <th class="column-title">Estado </th>
						
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id'];//
                            $serie=$r['serie'];//
                            $numero=$r['numero'];//
                            $fecha=$r['fecha'];//
                            $hora=$r['hora'];//
                            $dni=$r['dni'];//
                            $cantidad_total=$r['cantidad_total'];//
                            $signo=$r['signo'];//
                            $importe=$r['importe'];//
                            $estado=$r['estado'];//
                        
                          
     

                           
                ?>
                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $serie;?>" id="serie<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $numero;?>" id="numero<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $fecha;?>" id="fecha<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $dni;?>" id="dni<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $cantidad_total;?>" id="cantidad_total<?php echo $cantidad_total;?>">
                    <input type="hidden" value="<?php echo $signo;?>" id="signo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $importe;?>" id="importe<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">

                   
                             
                    <tr class="even pointer">

                        <td <?php if ($estado=="ANULADO") {?>style="color:#ff0000"<?php }else if($estado=="PAGADO") {?>style="color:#128F1B"<?php }?>>
                        <?php echo $serie."-".$numero;?></td>
                        <td <?php if ($estado=="ANULADO") {?>style="color:#ff0000"<?php }else if($estado=="PAGADO") {?>style="color:#128F1B"<?php }?>>
                        <?php echo $fecha; ?></td>
                        <td <?php if ($estado=="ANULADO") {?>style="color:#ff0000"<?php }else if($estado=="PAGADO") {?>style="color:#128F1B"<?php }?>>
                        <?php echo $hora; ?></td>
                        <td <?php if ($estado=="ANULADO") {?>style="color:#ff0000"<?php }else if($estado=="PAGADO") {?>style="color:#128F1B"<?php }?>>
                        <?php echo $cantidad_total; ?></td>
                        <td <?php if ($estado=="ANULADO") {?>style="color:#ff0000"<?php }else if($estado=="PAGADO") {?>style="color:#128F1B"<?php }?>>
                        <?php echo $signo." ".$importe; ?></td>
                        <td <?php if ($estado=="ANULADO") {?>style="color:#ff0000"<?php }else if($estado=="PAGADO") {?>style="color:#128F1B"<?php }?>>
                        <?php echo $estado; ?></td>
                       

                        
                                              
                        <td ><span class="pull-right">
                        <a href="report/recibo_pago2.php?variable1=<?php echo $id;?>" class='btn btn-primary' title='Imprimir Recibo' target="_blank" >|<i class="glyphicon glyphicon-print"></i></a> 
                        <?php  
                        $date_actual=date("Y-m-d");
                        if ($date_actual==$fecha){
                            if ($estado=="PAGADO" or $estado=="PENDIENTE"){
                        ?>
                            <!-- <a href="#" class='btn btn-danger' title='Anular Recibo' onclick="eliminar('<?php echo $id; ?>')">|<i class="glyphicon glyphicon-trash"></i></a> -->
                            <a href="#" class='btn btn-danger' title='Anular Recibo' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-addanular">|<i class="glyphicon glyphicon-remove"></i></a>
                        <?php 
                            } 
                        }
                        ?>
                       
                        
                    </tr>
                <?php
                    } //en while
                ?>
                <tr>
                    <td colspan=11><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
            </div>
            <?php
        }else{
           ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> No hay datos para mostrar!
            </div>
        <?php    
        }
    }
?>