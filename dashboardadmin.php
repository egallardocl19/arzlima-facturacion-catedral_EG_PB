<!DOCTYPE html>
<html lang="en">
	<link  rel="icon"   href="images/favicon.png" type="image/png" />
    
<?php 
    $title ="Dashboard - "; 
    include "head.php";
    include "sidebaradmin.php";

  
 
    $query =mysqli_query($con,"CALL dashboard ('1','1','2','3');");
    

     if (!$query||mysqli_num_rows($query)!=0){
            
             while ($rowM=$query->fetch_assoc()) 
	 		{
	 			$monto1= $rowM['mes1'];	
                 $monto2= $rowM['mes2'];	
                 $monto3=$rowM['mes3']; 
                 $monto4=$rowM['mes4']; 
                 $monto5=$rowM['mes5']; 
                 $monto6=$rowM['mes6']; 
                 $monto7=$rowM['mes7']; 
                 $monto8=$rowM['mes8']; 
                 $monto9=$rowM['mes9']; 
                 $monto10=$rowM['mes10']; 
                 $monto11=$rowM['mes11']; 
                 $monto12=$rowM['mes12']; 
                
                 $conteo1=$rowM['mes1xx']; 
                 $conteo2=$rowM['mes2xx']; 
                 $conteo3=$rowM['mes3xx']; 
                 $conteo4=$rowM['mes4xx']; 
                 $conteo5=$rowM['mes5xx']; 
                 $conteo6=$rowM['mes6xx']; 
                 $conteo7=$rowM['mes7xx']; 
                 $conteo8=$rowM['mes8xx']; 
                 $conteo9=$rowM['mes9xx']; 
                 $conteo10=$rowM['mes10xx']; 
                 $conteo11=$rowM['mes11xx']; 
                 $conteo12=$rowM['mes12xx']; 
                 $conteo1x=$rowM['mes1xxx']; 
                 $conteo2x=$rowM['mes2xxx']; 
                 $conteo3x=$rowM['mes3xxx']; 
                 $conteo4x=$rowM['mes4xxx']; 
                 $conteo5x=$rowM['mes5xxx']; 
                 $conteo6x=$rowM['mes6xxx']; 
                 $conteo7x=$rowM['mes7xxx']; 
                 $conteo8x=$rowM['mes8xxx']; 
                 $conteo9x=$rowM['mes9xxx']; 
                 $conteo10x=$rowM['mes10xxx']; 
                 $conteo11x=$rowM['mes11xxx']; 
                 $conteo12x=$rowM['mes12xxx']; 
                 $conteo1xx=$rowM['mes1xxxx']; 
                 $conteo2xx=$rowM['mes2xxxx']; 
                 $conteo3xx=$rowM['mes3xxxx']; 
                 $conteo4xx=$rowM['mes4xxxx']; 
                 $conteo5xx=$rowM['mes5xxxx']; 
                 $conteo6xx=$rowM['mes6xxxx']; 
                 $conteo7xx=$rowM['mes7xxxx']; 
                 $conteo8xx=$rowM['mes8xxxx']; 
                 $conteo9xx=$rowM['mes9xxxx']; 
                 $conteo10xx=$rowM['mes10xxxx']; 
                 $conteo11xx=$rowM['mes11xxxx']; 
                 $conteo12xx=$rowM['mes12xxxx']; 
               
	 		}
		
            
     }else{
                 $monto1='0'; 
                 $monto2='0'; 
                 $monto3='0'; 
                 $monto4='0'; 
                 $monto5='0'; 
                 $monto6='0'; 
                 $monto7='0'; 
                 $monto8='0'; 
                 $monto9='0'; 
                 $monto10='0'; 
                 $monto11='0'; 
                 $monto12='0'; 
                 
                 $conteo1='0'; 
                 $conteo2='0'; 
                 $conteo3='0'; 
                 $conteo4='0'; 
                 $conteo5='0'; 
                 $conteo6='0'; 
                 $conteo7='0'; 
                 $conteo8='0'; 
                 $conteo9='0'; 
                 $conteo10='0'; 
                 $conteo11='0'; 
                 $conteo12='0'; 
                 $conteo1x='0'; 
                 $conteo2x='0'; 
                 $conteo3x='0'; 
                 $conteo4x='0'; 
                 $conteo5x='0'; 
                 $conteo6x='0'; 
                 $conteo7x='0'; 
                 $conteo8x='0'; 
                 $conteo9x='0'; 
                 $conteo10x='0'; 
                 $conteo11x='0'; 
                $conteo12x='0';  
                 $conteo1xx='0'; 
                $conteo2xx='0'; 
                 $conteo3xx='0'; 
                $conteo4xx='0'; 
                 $conteo5xx='0'; 
                 $conteo6xx='0'; 
                 $conteo7xx='0'; 
                 $conteo8xx='0'; 
                 $conteo9xx='0'; 
                 $conteo10xx='0'; 
                 $conteo11xx='0'; 
                 $conteo12xx='0';  
          
     }
     $query->close();
     $con->next_result();
   
    
    
?>

    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="row top_tiles">
                
                <?php 
                  $submenu =mysqli_query($con,"CALL submenu('$id','0','2');");
                 if (!$submenu||mysqli_num_rows($submenu)!=0){
                    $submenu->close();
                    $con->next_result();
                          $permisos =mysqli_query($con,"CALL permisos('$id','2','0');");
                         
                          if (!$permisos||mysqli_num_rows($permisos)!=0){
                          
                              while ($row_sub=$permisos->fetch_assoc()) { 
                                 $idsubmodulo= $row_sub['idsubmodulo'];
                                  
                              }
                              $ruta_envio='recibos.php?key1='.$idsubmodulo;
                             
                          ?>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-cubes"></i></div>
                          <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData) ?></div></a>
                          <a href="<?php echo  $ruta_envio?>"><h3>Ticket Generales</h3></a>
                        </div>
                    </div>
                        <?php 
                      
                         
                        }
                        $permisos->close(); 
                        $con->next_result();
                         
                    }
                    
                    $con->next_result();
                        ?>
                        <?php 
                  $submenu =mysqli_query($con,"CALL submenu('$id','0','70');");
                 if (!$submenu||mysqli_num_rows($submenu)!=0){
                    $submenu->close();
                    $con->next_result();
                          $permisos =mysqli_query($con,"CALL permisos('$id','70','0');");
                         
                          if (!$permisos||mysqli_num_rows($permisos)!=0){
                          
                              while ($row_sub=$permisos->fetch_assoc()) { 
                                 $idsubmodulo= $row_sub['idsubmodulo'];
                                  
                              }
                              $ruta_envio='recibos.php?key1='.$idsubmodulo;
                             
                          ?>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-cubes"></i></div>
                          <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData1) ?></div></a>
                          <a href="<?php echo  $ruta_envio?>"><h3>Ticket Promocionales</h3></a>
                        </div>
                    </div>
                        <?php 
                      
                         
                        }
                        $permisos->close(); 
                        $con->next_result();
                         
                    }
                    
                    $con->next_result();
                        ?>
                        
                    <?php 
                      $submenu =mysqli_query($con,"CALL submenu('$id','0','64');");
                      if (!$submenu||mysqli_num_rows($submenu)!=0){
                         $submenu->close();
                         $con->next_result();
                          $permisos =mysqli_query($con,"CALL permisos('$id','64','0');");
                          if (!$permisos||mysqli_num_rows($permisos)!=0){
                              while ($row_sub=$permisos->fetch_assoc()) { 
                                 $idsubmodulo= $row_sub['idsubmodulo'];
                                 
                              }
                              $ruta_envio='recibos_control.php?key1='.$idsubmodulo;
                          
                          ?>
                 	 <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-university"></i></div>
                          <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData2) ?></div></a>
                          <a href="<?php echo  $ruta_envio?>"><h3>Control</h3></a>
                        </div>
                    </div>
                    <?php 
                     
                    }
                    $permisos->close(); 
                     $con->next_result();
                    }
                    $con->next_result();
                    
                    ?>
                    <?php 
                      $submenu =mysqli_query($con,"CALL submenu('$id','0','65');");
                      if (!$submenu||mysqli_num_rows($submenu)!=0){
                         $submenu->close();
                         $con->next_result();
                          $permisos =mysqli_query($con,"CALL permisos('$id','65','0');");
                          if (!$permisos||mysqli_num_rows($permisos)!=0){
                              while ($row_sub=$permisos->fetch_assoc()) { 
                                 $idsubmodulo= $row_sub['idsubmodulo'];
                                 
                              }
                              $ruta_envio='recibos_cobranza.php?key1='.$idsubmodulo;
                          
                          ?>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-child"></i></div>
                          <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData3) ?></div></a>
                          <a href="<?php echo  $ruta_envio?>"><h3>Cobranza</h3></a>
                        </div>
                    </div>
                    <?php 
                    
                    }
                    $permisos->close(); 
                    $con->next_result();
                    }
                    $con->next_result();
                    ?>
                  <?php 
                      $submenu =mysqli_query($con,"CALL submenu('$id','0','66');");
                      if (!$submenu||mysqli_num_rows($submenu)!=0){
                         $submenu->close();
                         $con->next_result();
                          $permisos =mysqli_query($con,"CALL permisos('$id','66','0');");
                          if (!$permisos||mysqli_num_rows($permisos)!=0){
                              while ($row_sub=$permisos->fetch_assoc()) { 
                                 $idsubmodulo= $row_sub['idsubmodulo'];
                                 
                              }
                              $ruta_envio='registros_concar.php?key1='.$idsubmodulo;
                          
                          ?>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-child"></i></div>
                          <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData4) ?></div></a>
                          <a href="<?php echo  $ruta_envio?>"><h3>ConcarSQL</h3></a>
                        </div>
                    </div>
                    <?php 
                    
                    }
                    $permisos->close(); 
                    $con->next_result();
                    }
                    $con->next_result();
                    ?>
                    <?php 
                     $submenu =mysqli_query($con,"CALL submenu('$id','0','6');");
                     if (!$submenu||mysqli_num_rows($submenu)!=0){
                       $submenu->close();
                       $con->next_result();
                          $permisos =mysqli_query($con,"CALL permisos('$id','6','0');");
                          if (!$permisos||mysqli_num_rows($permisos)!=0){
                              while ($row_sub=$permisos->fetch_assoc()) { 
                                 $idsubmodulo= $row_sub['idsubmodulo'];
                                 
                              }
                              $ruta_envio='usersadmin.php?key1='.$idsubmodulo;
                          
                          ?>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-users"></i></div>
                          <a href="<?php echo  $ruta_envio?>"><div class="count"><?php if ($idroles==$grupo1) {
                                            echo mysqli_num_rows($TicketData3);
                                            }else{ echo mysqli_num_rows($TicketData4);} ?></div></a>
                          <a href="<?php echo  $ruta_envio?>"><h3>Usuarios</h3></a>
                        </div>
                    </div>
                    <?php 
                     
                    }
                    $permisos->close(); 
                    $con->next_result();
                    }
                    $con->next_result();
                    ?>

                 
                </div>
                        
               
                <!-- content -->
                <br><br>
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      
                    <?php 
                      $submenu =mysqli_query($con,"CALL submenu('$id','0','65');");
                      if (!$submenu||mysqli_num_rows($submenu)!=0){
                         $submenu->close();
                         $con->next_result();
                          $permisos =mysqli_query($con,"CALL permisos('$id','65','0');");
                          if (!$permisos||mysqli_num_rows($permisos)!=0){
                              while ($row_sub=$permisos->fetch_assoc()) { 
                                 $idsubmodulo= $row_sub['idsubmodulo'];
                                 
                              }
                              $ruta_envio='recibos_cobranza.php?key1='.$idsubmodulo;
                          
                          ?>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Cobranza Mensual</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="action/upd_profile.php" method="post">
                                        
                                    <div class="form-group">
                                        
                                        <canvas id="myChart" width="200" height="200"></canvas>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php 
                        }
                        $permisos->close(); 
                        $con->next_result();
                        }
                        $con->next_result();
                        ?>
                        <?php 
                            $submenu =mysqli_query($con,"CALL submenu('$id','0','2');");
                            if (!$submenu||mysqli_num_rows($submenu)!=0){
                                $submenu->close();
                                $con->next_result();
                          $permisos =mysqli_query($con,"CALL permisos('$id','2','0');");
                         
                          if (!$permisos||mysqli_num_rows($permisos)!=0){
                          
                              while ($row_sub=$permisos->fetch_assoc()) { 
                                 $idsubmodulo= $row_sub['idsubmodulo'];
                                  
                              }
                              $ruta_envio='recibos.php?key1='.$idsubmodulo;
                             
                          ?>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Ticket Mensual</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="action/upd_profile.php" method="post">
                                        
                                    <div class="form-group">
                                        
                                        <canvas id="myChart2" width="200" height="200"></canvas>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php 
                      
                         
                        }
                        $permisos->close(); 
                        $con->next_result();
                         
                    }
                    
                    $con->next_result();
                        ?>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                         
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Información Institución</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">							
                                    
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label col-md-4 col-sm-4 col-xs-10" for="first-name">Ruc :
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12" >
                                                    <input type="text" name="name" id="first-name" class="form-control col-md-7 col-xs-12" value="<?php echo $ruc; ?>">
                                                </div>
                                            </div>
                                            
                                        
                                            <div class="form-group">
                                                <label class="control-label col-md-6 col-sm-6 col-xs-10" for="last-name">Razón social : 
                                                </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="text" id="last-name" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo $razonsocial; ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-6 col-sm-6 col-xs-10" for="last-name">Dirección : 
                                                </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="text" id="last-name" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo $direccion; ?>">
                                                </div>
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    
                                        <div class="col-md-12">
                                                                            
                                            <div class="image view view-first">
                                                <img class="thumb-image" style="width: 100%; display: block;" src="images/profiles/<?php echo $profile_pictwo; ?>" alt="image" />
                                            </div> 
                                            <!-- <span class="btn btn-my-button btn-file">
                                                <form method="post" id="formulario2" enctype="multipart/form-data">
                                                Cambiar Logo : <input type="file" name="file">
                                                </form>
                                            </span>
                                            <div id="respuesta"></div> -->
                                        </div>	
                                            
                                    </div>					
                                </div>
                                <div class="image view view-first">
                                <img class="thumb-image" style="width: 40%; display: block;" src="images/profiles/<?php echo $profile_pic; ?>" alt="image" />
                            </div>
                            <span class="btn btn-my-button btn-file">
                                <form method="post" id="formulario" enctype="multipart/form-data">
                                Cambiar Imagen de perfil: <input type="file" name="file">
                                </form>
                            </span>
                            <div id="respuesta"></div>
                            </div>
                            
                        </div>
                        
                            <?php include "lib/alerts.php";
                                profile(); //llamada a la funcion de alertas
                                
                            ?>  
                    </div>

                        <!-- <div class="col-md-6 col-xs-12 col-sm-12">                        
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Información personal</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                            <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="action/upd_profile.php" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="name" id="first-name" class="form-control col-md-7 col-xs-12" value="<?php echo $name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Correo electronico 
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="last-name" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo $email; ?>">
                                        </div>
                                    </div>
										
                                                          
									<div> 
										<a href="<?php echo  $ruta_envio?>"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Cambiar Contraseña</button></a>
									</div>
                                   
                                 
                                </form>
                            </div>
                        </div>
                        </div> -->
                      
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->
   
<?php include "footer.php" ?>

<script>
    $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "action/upload-profile.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
    });


// success

</script>
	
<script>
    $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario2")[0]);
            var ruta = "action/upload-profiletwo.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
    });


// success

</script>

<!-- jQuery graficos 27/02/2022-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.esm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/helpers.esm.min.js"></script>

<?php 

     $mes1 = date('Y-m', strtotime("first day of -0 month"));
     $mes2 = date('Y-m', strtotime("first day of -1 month"));
     $mes3 = date('Y-m', strtotime("first day of -2 month"));
     $mes4 = date('Y-m', strtotime("first day of -3 month"));
     $mes5 = date('Y-m', strtotime("first day of -4 month"));
     $mes6 = date('Y-m', strtotime("first day of -5 month"));
   
     
?>


<script>
    var mes1 = '<?=$mes1?>';
    var mes2 = '<?=$mes2?>';
    var mes3 = '<?=$mes3?>';
    var mes4 = '<?=$mes4?>';
    var mes5 = '<?=$mes5?>';
    var mes6 = '<?=$mes6?>';
    var monto1 = '<?=$monto1?>';
    var monto2 = '<?=$monto2?>';
    var monto3 = '<?=$monto3?>';
    var monto4 = '<?=$monto4?>';
    var monto5 = '<?=$monto5?>';
    var monto6 = '<?=$monto6?>';
   
    var conteo1 = '<?=$conteo1?>';
    var conteo2 = '<?=$conteo2?>';
    var conteo3 = '<?=$conteo3?>';
    var conteo4 = '<?=$conteo4?>';
    var conteo5 = '<?=$conteo5?>';
    var conteo6 = '<?=$conteo6?>';
    var conteo1x = '<?=$conteo1x?>';
    var conteo2x = '<?=$conteo2x?>';
    var conteo3x = '<?=$conteo3x?>';
    var conteo4x = '<?=$conteo4x?>';
    var conteo5x = '<?=$conteo5x?>';
    var conteo6x = '<?=$conteo6x?>';
    var conteo1xx = '<?=$conteo1xx?>';
    var conteo2xx = '<?=$conteo2xx?>';
    var conteo3xx = '<?=$conteo3xx?>';
    var conteo4xx = '<?=$conteo4xx?>';
    var conteo5xx = '<?=$conteo5xx?>';
    var conteo6xx = '<?=$conteo6xx?>';
   
  
    const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        
        labels: [mes1,mes2, mes3, mes4,mes5, mes6],
        datasets: [{
            label: 'S/. SOLES',
            data: [monto1,monto2,monto3,monto4,monto5,monto6],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
    function CargarDatosGraficoBar(){


    }
</script>
<script>
    var mes1 = '<?=$mes1?>';
    var mes2 = '<?=$mes2?>';
    var mes3 = '<?=$mes3?>';
    var mes4 = '<?=$mes4?>';
    var mes5 = '<?=$mes5?>';
    var mes6 = '<?=$mes6?>';
    const ctx2 = document.getElementById('myChart2');
const myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: [mes1,mes2, mes3, mes4,mes5, mes6],
        datasets: [{
            label: 'PENDIENTE',
            data: [conteo1,conteo2,conteo3,conteo4,conteo5,conteo6],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 2
        },
        {
            label: 'PAGADO',
            data: [conteo1x,conteo2x,conteo3x,conteo4x,conteo5x,conteo6x],
            backgroundColor: [
                'rgba(170, 226, 165, 0.8)',
                'rgba(170, 226, 165, 0.8)',
                'rgba(170, 226, 165, 0.8)',
                'rgba(170, 226, 165, 0.8)',
                'rgba(170, 226, 165, 0.8)',
                'rgba(170, 226, 165, 0.8)'
            ],
            borderColor: [
                'rgba(22, 129, 12, 0.8)',
                'rgba(22, 129, 12, 0.8)',
                'rgba(22, 129, 12, 0.8)',
                'rgba(22, 129, 12, 0.8)',
                'rgba(22, 129, 12, 0.8)',
                'rgba(22, 129, 12, 0.8)'
            ],
            borderWidth: 2
        },
        {
            label: 'ANULADO',
            data: [conteo1xx,conteo2xx,conteo3xx,conteo4xx,conteo5xx,conteo6xx],
            backgroundColor: [
                
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
    
</script>