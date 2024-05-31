
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
       
        $qqq = mysqli_real_escape_string($con,(strip_tags($_REQUEST['qqq'], ENT_QUOTES)));
        $qqq1 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['qqq1'], ENT_QUOTES)));
        
         $aColumns = array('CONCAT(t.serie,"-",t.numero)','t.fecha','t.dni');//Columnas de busqueda  
         $sTable = "cobranza c, ticket t,formapago f";
         $sWhere = "WHERE c.idticket=t.id and c.idformapago=f.id and c.idformapago=5 ";

         if ( $_GET['qqq'] != "" ) 
        {
            $sWhere = "WHERE c.idticket=t.id and c.idformapago=f.id and c.idformapago=5 and  (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$qqq."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        if ( $_GET['qqq1'] != "" ) 
        {
            $sWhere = "WHERE c.idticket=t.id and c.idformapago=f.id and c.idformapago=5 and  (c.fecha='".$qqq1."' OR ";
            
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        if ( $_GET['qqq'] != "" && $_GET['qqq1'] != "") 
        {
            $sWhere = "WHERE c.idticket=t.id and c.idformapago=f.id and c.idformapago=5 and  c.fecha='".$qqq1."' and (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$qqq."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        $sWhere.=" order by c.n_cobranza desc";
        include 'pagination2_2.php'; //include pagination file  
        //pagination variables
		
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 5; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './expences.php';
		//consulta principal para obtener los datos
        $sql="SELECT c.id,c.n_cobranza,c.fecha,c.idticket,concat(t.serie,'-',t.numero) as ticket,
        (select signo from tipo_moneda where id=t.idtipo_moneda) as moneda ,
        c.importe,c.idformapago,f.nombre as nombre_pago,c.n_deposito,c.n_referencia  FROM  $sTable  $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
					   
                        <th class="column-title">N° Cobranza </th>
                        <th class="column-title">Fecha</th>
                        <th class="column-title">N° Ticket </th>
                        <th class="column-title">Importe</th>
                        <th class="column-title">Tipo Pago </th>
                       
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id'];//
                            $n_cobranza=$r['n_cobranza'];//
                            $fecha=$r['fecha'];//
                            $idticket=$r['idticket'];//
                            $ticket=$r['ticket'];//
                            $moneda=$r['moneda'];//
                            $importe=$r['importe'];//
                            $idformapago=$r['idformapago'];//
                            $nombre_pago=$r['nombre_pago'];//
                            $n_deposito=$r['n_deposito'];//
                            $n_referencia=$r['n_referencia'];//
                          
     

                           
                ?>
                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $n_cobranza;?>" id="n_cobranza<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $fecha;?>" id="fecha<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $idticket;?>" id="idticket<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $moneda;?>" id="moneda<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $importe;?>" id="importe<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $idformapago;?>" id="idformapago<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $nombre_pago;?>" id="nombre_pago<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $n_deposito;?>" id="n_deposito<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $n_referencia;?>" id="n_referencia<?php echo $id;?>">
    

                   
                             
                    <tr class="even pointer">

                        <td >
                        <?php echo $n_cobranza;?></td>
                        <td >
                        <?php echo $fecha; ?></td>
                        <td >
                        <?php echo $ticket; ?></td>
                        <td>
                        <?php echo $moneda." ".$importe; ?></td>
                        <td >
                        <?php echo $nombre_pago; ?></td>
                       

                        
                                              
                        <td ><span class="pull-right">
                        <a href="report/recibo_pago_concretado.php?variable1=<?php echo $id;?>" class='btn btn-primary' title='Imprimir Recibo' target="_blank" >|<i class="glyphicon glyphicon-print"></i></a> 
                        <?php  
                        if ($idformapago==6){
                        ?>
                        <a href="#" class='btn btn-info' title='Ver Recibo' onclick="" data-toggle="modal" data-target=".bs-example-modal-lg-add">|<i class="glyphicon glyphicon-file"></i></a>
                        <?php 
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