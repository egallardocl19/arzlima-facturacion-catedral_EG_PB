
<?php
	
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
	include '../head2.php';
    $UserData=mysqli_query($con, "select * from user order by created_at desc");
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['abrev'])){
        $id_del=$_GET['abrev'];
        $query=mysqli_query($con, "SELECT * from recibos_serial where abrev='".$id_del."'"); 
        $count=mysqli_num_rows($query);

        //SCRIPT VALIDAR PARA ELIMINAR
		$sqlvalidarregistro =mysqli_query($con, "SELECT numero FROM ticket where serie ='".$id_del."'");
        if (mysqli_num_rows($sqlvalidarregistro)==0){
                if ($delete1=mysqli_query($con,"DELETE FROM recibos_serial WHERE abrev='".$id_del."'")){
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
             
        }else {
            ?>
       <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> La SERIE TICKET no se puede eliminar porque tiene registros de Tickets.
        </div>
            <?php
         } //end else condicion para eliminar

        } //end if
    			?>

<?php
	
    if($action == 'ajax'){
		
       
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        
         $aColumns = array('rs.serial','rs.abrev','(select nombre from seguridad_submodulo where idsubmodulo=rs.idsubmodulo)');//Columnas de busqueda
         $sTable = "recibos_serial rs";
         $sWhere = "";
        if ( $_GET['q'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" order by rs.serial";
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
        $sql="SELECT  rs.idrecibos_tipos,(select nombre from recibos_tipos where id=rs.idrecibos_tipos) tipo_recibo,rs.serial,rs.abrev,rs.activo,
        (select nombre from estado_dato where id=rs.activo) recibo_activo,rs.anio,rs.idsubmodulo,
        (select nombre from seguridad_submodulo where idsubmodulo=rs.idsubmodulo) as nombre_submodulo FROM  $sTable  $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //recorrer los datos obtenidos
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">

                       
						<th class="column-title">Tipo Recibo </th>
                        <th class="column-title">Serie Recibo </th>
						<th class="column-title">Serie Sistema </th>
                        <th class="column-title">Estado</th>
                        <th class="column-title">Año</th>
                        <th class="column-title">SubModulo</th>
                  
						
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['abrev'];
                            $abrev=$r['abrev'];
                            $idrecibos_tipos=$r['idrecibos_tipos'];
                            $tipo_recibo=$r['tipo_recibo'];
                            $serial=$r['serial'];
                            $activo=$r['activo'];
                            $recibo_activo=$r['recibo_activo'];
                            $anio=$r['anio'];
                            $idsubmodulo=$r['idsubmodulo'];
                            $nombre_submodulo=$r['nombre_submodulo'];
                          
                           
                          

                ?>
                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $abrev;?>" id="abrev<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $idrecibos_tipos;?>" id="idrecibos_tipos<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $tipo_recibo;?>" id="tipo_recibo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $serial;?>" id="serial<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $activo;?>" id="activo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $recibo_activo;?>" id="recibo_activo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $anio;?>" id="anio<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $idsubmodulo;?>" id="idsubmodulo<?php echo $id;?>">
             
                     <tr class="even pointer">
                        
						<td><?php echo $tipo_recibo; ?></td>
                        <td><?php echo $serial; ?></td>
						<td><?php echo $abrev; ?></td> 
                        <td><?php echo $recibo_activo; ?></td> 
                        <td><?php echo $anio; ?></td> 
                        <td><?php echo $nombre_submodulo; ?></td> 
                                              
                        <td ><span class="pull-right">
                        
                        <a href="#" class='btn btn-info' title='Editar registro' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="glyphicon glyphicon-edit"></i></a> 
                        <?php
                        $id=$_SESSION['keytok1']; 
                        $key1=$_SESSION['keytok2'];
                        $tok3=$_SESSION['keytok4'];
                        $permiso_token =mysqli_query($con,"CALL permisos('$id','$key1','$tok3');");
                        if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){   
                        ?>
                        <a href="#" class='btn btn-danger' title='Borrar registro' onclick="eliminar('<?php echo $abrev; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
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
                    <td colspan=7><span class="pull-right">
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