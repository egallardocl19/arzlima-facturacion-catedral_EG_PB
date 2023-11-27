
<?php
	
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
	include '../head2.php';
    $UserData=mysqli_query($con, "select * from user order by created_at desc");
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    
        if (isset($_GET['id'])){
            $id_del2=($_GET['id']);
               
                if ($delete2=mysqli_query($con,"UPDATE seguridad_roles set idestado_dato=if(idestado_dato=1,2,1) WHERE idroles='".$id_del2."'")){
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

            if (isset($_GET['id_codigoroles'])){
                $id_del3=($_GET['id_codigoroles']);
                   
                    if ($delete2=mysqli_query($con,"DELETE FROM seguridad_roles  WHERE idroles='".$id_del3."'")){
                        ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Aviso!</strong> Datos Eliminados exitosamente.
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
	
        $qq = mysqli_real_escape_string($con,(strip_tags($_REQUEST['qq'], ENT_QUOTES)));
  
         
         $aColumns = array('ss.idsubmodulo','ss.nombre','u.nombre');//Columnas de busqueda  
         $sTable = "seguridad_roles sr,seguridad_permisos sp,user u, seguridad_submodulo ss ";
         $sWhere = "WHERE sr.idpermisos=sp.idpermisos and sr.iduser=u.id and sp.idsubmodulo=ss.idsubmodulo";
        if ( $_GET['qq'] != "" ) 
        {
            $sWhere = "WHERE sr.idpermisos=sp.idpermisos and sr.iduser=u.id and sp.idsubmodulo=ss.idsubmodulo and (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$qq."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" order by ss.nombre,sr.idroles";
        include 'pagination_roles.php'; //include pagination file  
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
        $sql="SELECT sr.idroles,ss.idsubmodulo,ss.nombre as nombre_submodulo,sp.nombre as nombre_permiso,sr.idestado_dato,sr.iduser,u.nombre as usuario
         FROM  $sTable  $sWhere LIMIT $offset,$per_page";
    
        $query = mysqli_query($con, $sql);
  
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">

                       
                        <th class="column-title">SubModulo </th>
                        <th class="column-title">Permisos </th>
                        <th class="column-title">Estado </th>
                        <th class="column-title">Usuario </th>
                        						
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {

                            $idroles=$r['idroles'];
                            $id_codigoroles=$r['idroles'];
                            $idsubmodulo=$r['idsubmodulo'];
                            $nombre_submodulo=$r['nombre_submodulo'];
                            $nombre_permiso=$r['nombre_permiso'];
                            $idestado=$r['idestado_dato'];
                            $usuario=$r['usuario'];
                            
                           
                          
                           
                ?>
                    <input type="hidden" value="<?php echo $idroles;?>" id="idroles<?php echo $idroles;?>">
                    <input type="hidden" value="<?php echo $nombre_submodulo;?>" id="nombre_submodulo<?php echo $idroles;?>">
                    <input type="hidden" value="<?php echo $nombre_permiso;?>" id="nombre_permiso<?php echo $idroles;?>">
                    <input type="hidden" value="<?php echo $idestado;?>" id="idestado<?php echo $idroles;?>">
                    <input type="hidden" value="<?php echo $usuario;?>" id="usuario<?php echo $idroles;?>">
                    
                   
                             
                    <tr class="even pointer">
                       
                        <td><?php echo $nombre_submodulo;?></td>
                        <td><?php echo $nombre_permiso;?></td>
                        <td>
                        <label class="switch">
                        <input type="checkbox" name="check_lista" 
                        <?php if ($idestado==1){?> 
                            checked 
                        <?php }?> 
                        <?php
                        $id=$_SESSION['keytok1']; // Iniciando la sesion
                        $key1=$_SESSION['keytok2']; // Iniciando la sesion
                        $tok1=$_SESSION['keytok3']; // Iniciando la sesion
                        $tok2=$_SESSION['keytok4']; // Iniciando la sesion
                        $permiso_token =mysqli_query($con,"CALL permisos('$id','$key1','$tok2');");
                        if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){   
                        ?>
                        onclick="editar_roles('<?php echo $idroles;?>','<?php echo $idsubmodulo;?>');"
                        <?php
                        }
                        $permiso_token->close();
                        $con->next_result();
                        ?>
                        >
                        <span class="slider round"></span>
                        </label>
                        <td><?php echo $usuario;?></td>
                        </td>

                        
						
                        
                                              
                        <td ><span class="pull-right">
                        
                        <?php
                        
                        $permiso_token =mysqli_query($con,"CALL permisos('$id','$key1','$tok2');");
                        if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){   
                        ?>
                        <a href="#" class='btn btn-danger' title='Eliminar registro' onclick="eliminar('<?php echo $idsubmodulo;?>','<?php echo $id_codigoroles; ?>')"><i class="glyphicon glyphicon-remove"></i> </a>
                    
                        <?php
                        }
                        $permiso_token->close();
                        $con->next_result();
                        ?>
                        </span></td>
                    </tr>
                <?php
                    } //en while   <?php echo $estado;
                ?>
                <tr>
                    <td colspan=5><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents, $qq);?>
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
