
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


         $aColumns = array('CONCAT(t.serie,"-",t.numero)','t.fecha');//Columnas de busqueda  
         $sTable = "ticket_seguimiento ts, ticket t,ticket_motivos tm ";
         $sWhere = "WHERE ts.idticket=t.id  and ts.idmotivo=tm.id ";
      
        if ( $_GET['q'] != "" ) 
        {
            $sWhere = "WHERE ts.idticket=t.id  and ts.idmotivo=tm.id and  (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        if ( $_GET['q1'] != "" ) 
        {
            $sWhere = "WHERE ts.idticket=t.id  and ts.idmotivo=tm.id and  (t.fecha='".$q1."' OR ";
            
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        if ( $_GET['q'] != "" && $_GET['q1'] != "") 
        {
            $sWhere = "WHERE ts.idticket=t.id  and ts.idmotivo=tm.id and  t.fecha='".$q1."' and (";
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
        $sql="SELECT ts.id,ts.idticket,t.serie,t.numero,(select signo from tipo_moneda where id=t.idtipo_moneda) as signo,t.monto_total,t.fecha,t.hora,ts.idmotivo,
        if(ts.proceso=1,'PENDIENTE','FINALIZADO') as nombre_proceso,(CASE WHEN ts.estado is null THEN '' WHEN ts.estado=1 THEN 'APROBADO' WHEN ts.estado=2 THEN 'DESAPROBADO'END) 
        as nombre_estado,ts.estado,tm.nombre,ts.proceso,ts.iduser_add,
        (select username from user where id=ts.iduser_add) as cajero,ts.fecha_add,ts.hora_add,ts.iduser_upd,(select username from user where id=ts.iduser_upd) as super,ts.fecha_upd,ts.hora_upd 
        FROM  $sTable  $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                  
                        <th class="column-title">Proceso </th>
                        <th class="column-title">Ticket </th>
                        <th class="column-title">Precio </th>
                        <th class="column-title">Fecha </th>
                        <th class="column-title">Hora</th>
                        <th class="column-title">Motivo Anulación </th>
                        <th class="column-title">Cajero </th>
                        <th class="column-title">Fecha Registro </th>
                        <th class="column-title">Hora Registro  </th>
                        <th class="column-title">Estado  </th>
                        <th class="column-title">Supervisado </th>
                        <th class="column-title">Fecha Super </th>
                        <th class="column-title">Hora Super </th>
                        
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id'];//
                            $idticket=$r['idticket'];//
                            $serie=$r['serie'];//
                            $numero=$r['numero'];//
                            $signo=$r['signo'];//
                            $monto_total=$r['monto_total'];//
                            $fecha=$r['fecha'];//
                            $hora=$r['hora'];//
                            $idmotivo=$r['idmotivo'];//
                            $nombre_proceso=$r['nombre_proceso'];//
                            $nombre_estado=$r['nombre_estado'];//
                            $nombre=$r['nombre'];//
                            $proceso=$r['proceso'];//
                            $iduser_add=$r['iduser_add'];//
                            $cajero=$r['cajero'];//
                            $fecha_add=$r['fecha_add'];//
                            $hora_add=$r['hora_add'];//
                            $iduser_upd=$r['iduser_upd'];//
                            $super=$r['super'];//
                            $fecha_upd=$r['fecha_upd'];//
                            $hora_upd=$r['hora_upd'];//

                ?>
                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $idticket;?>" id="idticket<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $serie;?>" id="serie<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $numero;?>" id="numero<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $signo;?>" id="signo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $monto_total;?>" id="monto_total<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $fecha;?>" id="fecha<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $hora;?>" id="hora<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $idmotivo;?>" id="idmotivo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $nombre_proceso;?>" id="nombre_proceso<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $nombre_estado;?>" id="nombre_estado<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $proceso;?>" id="proceso<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $iduser_add;?>" id="iduser_add<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $cajero;?>" id="cajero<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $fecha_add;?>" id="fecha_add<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $hora_add;?>" id="hora_add<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $iduser_upd;?>" id="iduser_upd<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $fecha_upd;?>" id="fecha_upd<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $hora_upd;?>" id="hora_upd<?php echo $id;?>">

                    <tr class="even pointer">

                       
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?>style="color:#ff0000"<?php }?>>
                        <b><?php echo $nombre_proceso; ?></b></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?><?php }?>>
                        <?php echo $serie."-".$numero;?></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?><?php }?>>
                        <?php echo $signo."".$monto_total; ?></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?><?php }?>>
                        <?php echo $fecha; ?></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?><?php }?>>
                        <?php echo $hora; ?></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?><?php }?>>
                        <?php echo $nombre; ?></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?><?php }?>>
                        <b><?php echo $cajero; ?></b></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?><?php }?>>
                        <?php echo $fecha_add; ?></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?><?php }?>>
                        <?php echo $hora_add; ?></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?>style="color:#ff0000"<?php }?>>
                        <b><?php echo $nombre_estado; ?></b></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?><?php }?>>
                        <b><?php echo $super; ?></b></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?><?php }?>>
                        <?php echo $fecha_upd; ?></td>
                        <td <?php if ($nombre_proceso=="PENDIENTE") {?>style="color:#136B42"<?php }else if($nombre_proceso=="FINALIZADO") {?><?php }?>>
                        <?php echo $hora_upd; ?></td>
                               
                        <td ><span class="pull-right">
                        <!-- <a href="report/recibo_pago.php?variable1=<?php echo $id;?>" class='btn btn-primary' title='Imprimir Recibo' target="_blank" >|<i class="glyphicon glyphicon-print"></i></a> -->
                        <?php if($proceso==1){?>
                        <a href="#" class='btn btn-primary' title='Editar Seguimiento' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-addanular2">|<i class="glyphicon glyphicon-edit"></i></a>
                        <?php }?>
                        
                    </tr>
                <?php
                    } //en while
                ?>
                <tr>
                    <td colspan=14><span class="pull-right">
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