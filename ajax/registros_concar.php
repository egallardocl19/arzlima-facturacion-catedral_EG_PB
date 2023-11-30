
<?php
	
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
	include '../head2.php';
    $UserData=mysqli_query($con, "select * from user order by created_at desc");
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    $submod=$_SESSION['keytok0']; 
    
    if (isset($_GET['codigo_recibo'])){
        $id_del=($_GET['codigo_recibo']);
    
        if ($delete1=mysqli_query($con,"DELETE FROM contabilidad_concar_registros WHERE id>0 and fecha='".$id_del."'")){
            ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Aviso!</strong> Datos eliminados exitosamente.
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
         $aColumns = array('cc.fecha');//Columnas de busqueda
         $sTable = "contabilidad_concar_registros cc
         JOIN ticket as t ON  cc.idticket=t.id";
         $sWhere = "";
        if ( $_GET['q'] != "" )
        {
            $sWhere = "where (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" group by cc.fecha order by cc.fecha desc";
        include 'pagination.php'; //include pagination file
        //pagination variables
		
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        if (!$count_query|| mysqli_num_rows($count_query)==0){
            $numrows=0;
        }else{
            $row= mysqli_fetch_array($count_query);
            $numrows = $row['numrows'];
        }
        
        $total_pages = ceil($numrows/$per_page);
        $reload = './expences.php';
		//consulta principal para obtener los datos
        $sql="SELECT COUNT(distinct(cc.idticket)) as ticket,count(cc.idcontabilidad_concar) as registro_concar,
        count((select id from contabilidad_concar where tipo_cuenta='D' and id=cc.idcontabilidad_concar)) as debe,
        count((select id from contabilidad_concar where tipo_cuenta='H' and id=cc.idcontabilidad_concar)) as haber,
        cc.fecha,format((select SUM(monto_total) from ticket where fecha=cc.fecha),2) as monto FROM  $sTable  $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
					   
                        <th class="column-title">Fecha Registro </th>
                        <th class="column-title">Cantidad Ticket </th>
                        <th class="column-title">Monto Total </th>
                        <th class="column-title">Registro CONCAR</th>
                        <th class="column-title">Registro D </th>
                        <th class="column-title">Registro H </th>
						
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                             $id=$r['fecha'];//
                             $ticket=$r['ticket'];//
                             $registro_concar=$r['registro_concar'];//
                             $debe=$r['debe'];//
                             $haber=$r['haber'];//
                             $fecha=$r['fecha'];//
                             $monto=$r['monto'];//
                      
                ?>
                                                
                    <tr class="even pointer">

                        <td> <?php echo $fecha;?></td>
                        <td> <?php echo $ticket; ?></td>
                        <td> <?php echo $monto; ?></td>
                        <td> <?php echo $registro_concar; ?></td>
                        <td> <?php echo $debe; ?></td>
                        <td> <?php echo $haber; ?></td>
                       

                        
                                              
                        <td ><span class="pull-right">
                        <a href="report/reporte_concar_venta_excel.php?variable1=<?php echo $fecha;?>" class='btn btn-primary' title='Exportar EXCEL' target="_blank" >|<i class="fa fa-file-excel-o"></i></a> 
                        <?php
                        $id=$_SESSION['keytok1']; // Iniciando la sesion
                        $key1=$_SESSION['keytok2']; // Iniciando la sesion
                        $tok1=$_SESSION['keytok3']; // Iniciando la sesion
                        $tok2=$_SESSION['keytok4']; // Iniciando la sesion
                        $permiso_token =mysqli_query($con,"CALL permisos('$id','$key1','$tok2');");
                        if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){   
                        ?>
                        <a href="#" class='btn btn-danger' title='Borrar registros' onclick="eliminar('<?php echo $fecha; ?>')">|<i class="glyphicon glyphicon-trash"></i> </a></span></td>
                        <?php
                        }
                        $permiso_token->close();
                        $con->next_result();
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