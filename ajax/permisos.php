
<?php
	
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
	include '../head2.php';
    $UserData=mysqli_query($con, "select * from user order by created_at desc");
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    
        if (isset($_GET['id'])){
            $id_del2=($_GET['id']);
               
                if ($delete2=mysqli_query($con,"UPDATE seguridad_submodulo set idestado_dato=if(idestado_dato=1,2,1) WHERE idsubmodulo='".$id_del2."'")){
                    ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Aviso!</strong> Datos Actualizados exitosamente.
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
        
         
         $aColumns = array('ss.nombre','sm.nombre');//Columnas de busqueda  
         $sTable = "seguridad_submodulo ss,seguridad_modulo sm,estado_dato ed ";
         $sWhere = "WHERE ss.idmodulo=sm.idmodulo and ss.idestado_dato=ed.id";
        if ( $_GET['q'] != "" ) 
        {
            $sWhere = "WHERE ss.idmodulo=sm.idmodulo and ss.idestado_dato=ed.id and (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" order by sm.nombre,ss.nombre";
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
        $sql="SELECT ss.idsubmodulo as idsubmodulo,ss.nombre as nombre_submodulo,sm.idmodulo as idmodulo,sm.nombre as nombre_modulo,ss.idestado_dato,ed.nombre as nombre_estado
         FROM  $sTable  $sWhere LIMIT $offset,$per_page";
    
        $query = mysqli_query($con, $sql);
  
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">

                       
                        <th class="column-title">Modulo </th>
                        <th class="column-title">Sub-Modulo </th>
                        <th class="column-title">Estado </th>
                        						
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {

                            $id=$r['idsubmodulo'];
                            $codigo_submodulo=$r['idsubmodulo'];
                            $modulo=$r['nombre_modulo'];
                            $submodulo=$r['nombre_submodulo'];
                            $idestado=$r['idestado_dato'];
                            $estado=$r['nombre_estado'];
                            
                           
                          
                           
                ?>
                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $modulo;?>" id="modulo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $submodulo;?>" id="submodulo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">
                    
                   
                             
                    <tr class="even pointer">
                       
                        <td><?php echo $modulo;?></td>
                        <td><?php echo $submodulo;?></td>
                        <td>
                        <label class="switch">
                        <input type="checkbox" name="check_lista" 
                        <?php if ($idestado==1){?> 
                            checked 
                        <?php }?> 
                        <?php
                        $idx=$_SESSION['keytok1']; 
                        $key1=$_SESSION['keytok2']; 
                        $tok1=$_SESSION['keytok3']; 
                        $tok2=$_SESSION['keytok4']; 
                        $permiso_token =mysqli_query($con,"CALL permisos('$idx','$key1','$tok1');");
                        if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){   
                        ?>
                        onclick="editar('<?php echo $id;?>');"
                        <?php
                        }
                        $permiso_token->close();
                        $con->next_result();
                        ?>>
                        <span class="slider round"></span>
                        </label>
                        </td>

                        
						
                        
                                              
                        <td ><span class="pull-right">
                        
                         <a href="#" class='btn btn-primary' title='Ver Recibo' onclick="obtener_datos('<?php echo $id;?>'); load2(1,'<?php echo $id;?>');" 
                         data-toggle="modal" data-target=".bs-example-modal-lg-addpermisos_roles"><i class="fa fa-key"></i></a>
                        
                         </span></td>
                    </tr>
                <?php
                    } //en while   <?php echo $estado;
                ?>
                <tr>
                    <td colspan=4><span class="pull-right">
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
