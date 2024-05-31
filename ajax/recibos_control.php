
<?php
	
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
	include '../head2.php';
    $UserData=mysqli_query($con, "select * from user order by created_at desc");
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    $submod=$_SESSION['keytok0']; 
    
    if (isset($_GET['codigo_recibo'])){
        $id_del=($_GET['codigo_recibo']);
        $query=mysqli_query($con, "SELECT * from ticket where  serie in(select abrev from recibos_serial where idsubmodulo=$submod)"); //codigogruposervice='".$gruposervice."' and tiposervicio=1 and 
        $count=mysqli_num_rows($query);

            if ($delete1=mysqli_query($con,"UPDATE ticket set tipo_recibo in('RA','RP') and  idestado_recibo=3  WHERE codigo_recibo='".$id_del."'")){
				?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos anulados exitosamente.
            </div>
        		<?php 
            }else {
        			?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
                </div>
   				 <?php
            } //end else
        } //end if
    			?>

<?php
	
    if($action == 'ajax'){
		
        // escaping, additionally removing everything that could be (html/javascript-) code
       
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $q1 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));


         $aColumns = array('CONCAT(t.serie,"-",t.numero)','t.fecha','t.dni');//Columnas de busqueda  
         $sTable = "ticket_control t, clase_ticket tt, tipo_moneda tm";
         $sWhere = "WHERE t.idclase_ticket=tt.id and t.idtipo_moneda=tm.id ";
      
        if ( $_GET['q'] != "" ) 
        {
            $sWhere = "WHERE t.idclase_ticket=tt.id and t.idtipo_moneda=tm.id and  (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        if ( $_GET['q1'] != "" ) 
        {
            $sWhere = "WHERE t.idclase_ticket=tt.id and t.idtipo_moneda=tm.id and  (t.fecha='".$q1."' OR ";
            
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        if ( $_GET['q'] != "" && $_GET['q1'] != "") 
        {
            $sWhere = "WHERE t.idclase_ticket=tt.id and t.idtipo_moneda=tm.id and  t.fecha='".$q1."' and (";
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
        $sql="SELECT t.id,t.serie,t.numero,t.fecha,t.cantidad_total,t.hora,t.dni,tt.nombre,tm.signo,format(t.monto_total,2) as importe,
        (select nombre from estado_ticket where id=t.idestado_ticket) as estado FROM  $sTable  $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
					   
                        <th class="column-title">Ticket </th>
                        <th class="column-title">Fecha Ingreso </th>
                        <th class="column-title">Hora Ingreso </th>
                        <th class="column-title">Cant. </th>
                        <th class="column-title">Clase </th>
                        <!-- <th class="column-title">Monto </th> -->
                        
						
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id'];//
                            $serie=$r['serie'];//
                            $numero=$r['numero'];//
                            $cantidad=$r['cantidad_total'];//
                            $fecha=$r['fecha'];//
                            $dni=$r['dni'];//
                            $nombre=$r['nombre'];//
                            $signo=$r['signo'];//
                            $importe=$r['importe'];//
                            $estado=$r['estado'];//
                            $hora=$r['hora'];//
                          
     

                           
                ?>
                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $serie;?>" id="serie<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $numero;?>" id="numero<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $fecha;?>" id="fecha<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $dni;?>" id="dni<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $signo;?>" id="signo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $importe;?>" id="importe<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">

                   
                             
                    <tr class="even pointer">

                        <td><?php echo $serie."-".$numero;?></td>
                        <td><?php echo $fecha; ?></td>
                        <td><?php echo $hora; ?></td>
                        <td><?php echo $cantidad; ?></td>
                        <td><?php echo $nombre; ?></td>
                        
                       

                        
                                              
                        <td ><span class="pull-right">
                        <!-- <a href="report/recibo_pago.php?variable1=<?php echo $id;?>" class='btn btn-primary' title='Imprimir Recibo' target="_blank" >|<i class="glyphicon glyphicon-print"></i></a> 
                        <a href="#" class='btn btn-primary' title='Ver Recibo' onclick="obtener_datos('<?php echo $id_cod;?>'); carga_recibo_contable('<?php echo $tipo_recibo.$codigo_recibo;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-add">|<i class="glyphicon glyphicon-file"></i></a>
                       -->
                        
                    </tr>
                <?php
                    } //en while
                ?>
                <tr>
                    <td colspan=6><span class="pull-right">
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