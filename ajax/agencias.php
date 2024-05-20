
<?php
	
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
	include '../head2.php';
    $UserData=mysqli_query($con, "select * from user order by created_at desc");
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    $submod=$_SESSION['keytok0']; 
    
    if (isset($_GET['codigo_recibo'])){
        $id_del=($_GET['codigo_recibo']);
        $query=mysqli_query($con, "SELECT * from ticket where  serie in(select abrev from recibos_serial where idsubmodulo=$submod)"); 
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
        
         $aColumns = array('dni_ruc','nombre');//Columnas de busqueda  
         $sTable = "agencia";
         $sWhere = "";
        if ( $_GET['q'] != "" ) 
        {
            $sWhere = " WHERE  (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" order by nombre desc";
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
        $sql="SELECT * FROM  $sTable  $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
					   
                        <th class="column-title">Ruc </th>
                        <th class="column-title">Razón Social </th>
                        <th class="column-title">Dirección </th>
                        <th class="column-title">Celular </th>
                        <th class="column-title">Correo </th>
                        <th class="column-title">Estado </th>
						
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id'];//
                            $dni_ruc=$r['dni_ruc'];//
                            $nombre=$r['nombre'];//
                            $direccion=$r['direccion'];//
                            $celular=$r['celular'];//
                            $correo=$r['correo'];//
                            $idestado_dato=$r['idestado_dato'];//
                            if ($idestado_dato==1){$nombre_estado="ACTIVO";}else {$nombre_estado="INACTIVO";}

                           
                ?>
                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $dni_ruc;?>" id="dni_ruc<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $direccion;?>" id="direccion<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $celular;?>" id="celular<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $correo;?>" id="correo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $idestado_dato;?>" id="idestado_dato<?php echo $id;?>">
                                 
                             
                    <tr class="even pointer">

                        <td >
                        <?php echo $dni_ruc;?></td>
                        <td >
                        <?php echo $nombre; ?></td>
                        <td >
                        <?php echo $direccion; ?></td>
                        <td >
                        <?php echo $celular; ?></td>
                        <td >
                        <?php echo $correo; ?></td>
                        <td >
                        <?php echo $nombre_estado; ?></td>
                       

                        
                                              
                        <td ><span class="pull-right">
                        <!-- <a href="report/recibo_pago.php?variable1=<?php echo $id;?>" class='btn btn-primary' title='Imprimir Recibo' target="_blank" >|<i class="glyphicon glyphicon-print"></i></a>  -->
                        <a href="#" class='btn btn-info' title='Editar Agencia' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="glyphicon glyphicon-edit"></i></a> 
                      
                        
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