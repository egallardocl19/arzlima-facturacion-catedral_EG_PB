<!DOCTYPE html>
<html lang="en">
	<link  rel="icon"   href="images/favicon.png" type="image/png" />
    
<?php 
    $title ="Dashboard - "; 
    include "head.php";
    include "sidebaradmin.php";
    echo("<meta http-equiv='refresh' content='300'>");
    $fecha_inicio = "2024-06-04"; //lanzamiento system
    $fecha_actual = date("Y-m-d");
    
?>

                    <div class="right_col" role="main"> <!-- page content -->
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
                                <div class="tile-stats" style="background-image: url('images/profiles/fonbo4.png'); width:100%;" >
                                <div class="icon"><a href="<?php echo  $ruta_envio?>"><i class="fa fa-ticket"></i></a></div> 
                                <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData) ?></div></a>
                                <a href="<?php echo  $ruta_envio?>" style="font-size:25px;"><i class="fa fa-bookmark"></i> Ticket Generales</a>
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
                                <div class="tile-stats" style="background-image: url('images/profiles/fonbo5.png'); width:100%;" >
                                <div class="icon"><a href="<?php echo  $ruta_envio?>"><i class="fa fa-ticket"></i></a></div>
                                <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData1) ?></div></a>
                                <a href="<?php echo  $ruta_envio?>" style="font-size:25px;"><i class="fa fa-bookmark"></i> Ticket Promocionales</a>
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
                            $submenu =mysqli_query($con,"CALL submenu('$id','0','71');");
                            if (!$submenu||mysqli_num_rows($submenu)!=0){
                            $submenu->close();
                            $con->next_result();
                                $permisos =mysqli_query($con,"CALL permisos('$id','71','0');");
                                
                                if (!$permisos||mysqli_num_rows($permisos)!=0){
                                
                                    while ($row_sub=$permisos->fetch_assoc()) { 
                                        $idsubmodulo= $row_sub['idsubmodulo'];
                                        
                                    }
                                    $ruta_envio='recibos.php?key1='.$idsubmodulo;
                                    
                            ?>
                           
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats" style="background-image: url('images/profiles/fonbo11.png'); width:100%;" >
                                <div class="icon"><a href="<?php echo  $ruta_envio?>"><i class="fa fa-ticket"></i></a></div>
                                <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData9) ?></div></a>
                                <a href="<?php echo  $ruta_envio?>" style="font-size:25px;"><i class="fa fa-bookmark"></i> Ticket Crédito</a>
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
                            $submenu =mysqli_query($con,"CALL submenu('$id','0','74');");
                            if (!$submenu||mysqli_num_rows($submenu)!=0){
                            $submenu->close();
                            $con->next_result();
                                $permisos =mysqli_query($con,"CALL permisos('$id','74','0');");
                                
                                if (!$permisos||mysqli_num_rows($permisos)!=0){
                                
                                    while ($row_sub=$permisos->fetch_assoc()) { 
                                        $idsubmodulo= $row_sub['idsubmodulo'];
                                        
                                    }
                                    $ruta_envio='recibos.php?key1='.$idsubmodulo;
                                    
                            ?>
                           
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats" style="background-image: url('images/profiles/fonbo12.png'); width:100%;" >
                                <div class="icon"><a href="<?php echo  $ruta_envio?>"><i class="fa fa-shopping-cart"></i></a></div>
                                <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData11) ?></div></a>
                                <a href="<?php echo  $ruta_envio?>" style="font-size:25px;"><i class="fa fa-bookmark"></i> Ticket Producto</a>
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
                                <div class="tile-stats" style="background-image: url('images/profiles/fonbo6.png'); width:100%;" >
                                <div class="icon"><a href="<?php echo  $ruta_envio?>"><i class="fa fa-binoculars"></i></a></div>
                                <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData2) ?></div></a>
                                <a href="<?php echo  $ruta_envio?>" style="font-size:25px;"><i class="fa fa-bookmark"></i> Ticket Control</a>
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
                                <div class="tile-stats" style="background-image: url('images/profiles/fonbo7.png'); width:100%;" >
                                <div class="icon"><a href="<?php echo  $ruta_envio?>"><i class="fa fa-money"></i></a></div>
                                <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData3) ?></div></a>
                                <a href="<?php echo  $ruta_envio?>" style="font-size:25px;"><i class="fa fa-bookmark"></i> Cobranza</a>
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
                            $submenu =mysqli_query($con,"CALL submenu('$id','0','73');");
                            if (!$submenu||mysqli_num_rows($submenu)!=0){
                                $submenu->close();
                                $con->next_result();
                                $permisos =mysqli_query($con,"CALL permisos('$id','73','0');");
                                if (!$permisos||mysqli_num_rows($permisos)!=0){
                                    while ($row_sub=$permisos->fetch_assoc()) { 
                                        $idsubmodulo= $row_sub['idsubmodulo'];
                                        
                                    }
                                    $ruta_envio='recibos_cobranza_auditoria.php?key1='.$idsubmodulo;
                                
                            ?>
                        
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats" style="background-image: url('images/profiles/fonbo7.png'); width:100%;" >
                                <div class="icon"><a href="<?php echo  $ruta_envio?>"><i class="fa fa-money"></i></a></div>
                                <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData7) ?></div></a>
                                <a href="<?php echo  $ruta_envio?>" style="font-size:25px;"><i class="fa fa-bookmark"></i> Cobranza Auditoria</a>
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
                                <div class="tile-stats" style="background-image: url('images/profiles/fonbo8.png'); width:100%;" >
                                <div class="icon"><a href="<?php echo  $ruta_envio?>"><i class="fa fa-database"></i></a></div>
                                <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData4) ?></div></a>
                                <a href="<?php echo  $ruta_envio?>" style="font-size:25px;"><i class="fa fa-bookmark"></i> ConcarSQL</a>
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
                            <div class="tile-stats" style="background-image: url('images/profiles/fonbo9.png'); width:100%;" >
                                <div class="icon"><a href="<?php echo  $ruta_envio?>"><i class="fa fa-users"></i></a></div>
                                <a href="<?php echo  $ruta_envio?>"><div class="count"><?php if ($idroles==$grupo1) {
                                                    echo mysqli_num_rows($TicketData5);
                                                    }else{ echo mysqli_num_rows($TicketData6);} ?></div></a>
                                <a href="<?php echo  $ruta_envio?>" style="font-size:25px;"><i class="fa fa-bookmark"></i> Usuarios</a>
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
                            $submenu =mysqli_query($con,"CALL submenu('$id','0','72');");
                            if (!$submenu||mysqli_num_rows($submenu)!=0){
                            $submenu->close();
                            $con->next_result();
                                $permisos =mysqli_query($con,"CALL permisos('$id','72','0');");
                                if (!$permisos||mysqli_num_rows($permisos)!=0){
                                    while ($row_sub=$permisos->fetch_assoc()) { 
                                        $idsubmodulo= $row_sub['idsubmodulo'];
                                        
                                    }
                                    $ruta_envio='recibos_seguimiento.php?key1='.$idsubmodulo;
                                
                            ?>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" id="precaucion" >
                                <div class="tile-stats" style="background-image: url('images/profiles/fonbo10.png'); width:100%;">
                            
                                <div class="icon" ><a href="<?php echo  $ruta_envio?>"><i  class="fa fa-bell"></i></a></div>
                                <a href="<?php echo  $ruta_envio?>"><div class="count"><?php echo mysqli_num_rows($TicketData8) ?></div></a>
                                <a href="<?php echo  $ruta_envio?>" style="font-size:25px;"><i class="fa fa-bookmark"></i> Seguimiento Alertas</a>
                                </div>
                                
                                <!-- <p id="precaucion">¡Tenga precaución!</p> -->
                            </div>
                           
                            <?php 
                            }
                            $permisos->close(); 
                            $con->next_result();
                            }
                            $con->next_result();
                            ?>
                            <div class="col-md-12 col-xs-12 col-sm-12">   <!-- COLUMNA PADRE -->
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

                                        
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                      
                                                            <nav class="navbar navbar-dark bg-primary text-white" style="background-color:#364d5f">
                                                                <div class="form-group">
                                                                    <div class="control-label col-md-2 col-sm-2 col-xs-12">
                                                                    <h2>Filtros Gráficos:</h2>
                                                                    </div>  
                                                                    <div class="control-label col-md-2 col-sm-2 col-xs-12">
                                                                    <h5><i class="fa fa-calendar" aria-hidden="true"></i> Fecha Desde:</h5>
                                                                    </div>  
                                                                    
                                                                    <div class="col-md-2 col-sm-3 col-xs-12">
                                                                    <input type="date" id="fe1" name="fe1" onchange="mostrarResultados1(this)" value="<?php echo $fecha_inicio ?>" min="<?php echo $fecha_inicio ?>" max="<?php echo $fecha_actual ?>"  class="form-control" onkeydown="return false">
                                                                    </div>

                                                                    <div class="control-label col-md-2 col-sm-2 col-xs-12">
                                                                    <h5><i class="fa fa-calendar" aria-hidden="true"></i> Fecha Hasta:</h5>
                                                                    </div>  
                                                                   
                                                                    <div class="col-md-2 col-sm-3 col-xs-12">
                                                                    <input type="date"  id="fe2" name="fe2" onchange="mostrarResultados2(this)" value="<?php echo $fecha_actual ?>"  min="<?php echo $fecha_inicio ?>" max="<?php echo $fecha_actual ?>" class="form-control" onkeydown="return false">
                                                                    </div>
                                                                        
                                                                </div>   
                                                            </div>
                                                     
                                        </div>
                                    
                                        <div class="col-md-6 col-xs-12 col-sm-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Ventas por Día</h2>
                                                    <ul class="nav navbar-right panel_toolbox ">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                
                                                <!-- Filtro -->
                                                        <div class="x_content">		
                                                            <div class="form-group">
                                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group"> 

                                                                    <label  class="control-label col-md-2 col-sm-3 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i></label>
                                                                </div>   
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <canvas id="myChart" width="400" height="100"></canvas>
                                                            </div>

                                                        </div>  
                                                    
                                            
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xs-12 col-sm-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Visitantes por Día </h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">

                                                                <div class="form-group">
                                                                    <div class="col-md-10 col-sm-10 col-xs-12 form-group"> 

                                                                          <label  class="control-label col-md-2 col-sm-3 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> </label>
             
                                                                    </div> 
                                                                </div> 
                                                                <div class="form-group">
                                                                
                                                                <canvas id="myChart3" width="400" height="100"></canvas>
                                                                
                                                                 </div> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xs-12 col-sm-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Visitantes por Día y Tipo Visitante</h2>
                                                    <ul class="nav navbar-right panel_toolbox ">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                
                                                <!-- Filtro -->
                                                        <div class="x_content">		
                                                            <div class="form-group">
                                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group"> 

                                                                    <label  class="control-label col-md-2 col-sm-3 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i></label>
                                                                </div>   
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <canvas id="myChart5" width="400" height="100"></canvas>
                                                            </div>

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
                                        
                                        <div class="col-md-6 col-xs-12 col-sm-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Ventas por Día y Tipo Pago</h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">

                                                                <div class="form-group">
                                                                    <div class="col-md-10 col-sm-10 col-xs-12 form-group"> 

                                                                          <label  class="control-label col-md-2 col-sm-3 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> </label>
                                                                                <!--<div class="col-md-2 col-sm-3 col-xs-12">
                                                                                <input type="date" id="fe3" name="fe3" onchange="mostrarResultados3(this)" value="<?php echo $fecha_inicio ?>" min="<?php echo $fecha_inicio ?>" max="<?php echo $fecha_actual ?>"  class="form-control" onkeydown="return false">
                                                                                </div>

                                                                        <label  class="control-label col-md-2 col-sm-3 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha Hasta:</label>
                                                                                <div class="col-md-2 col-sm-3 col-xs-12">
                                                                                <input type="date"  id="fe4" name="fe4" onchange="mostrarResultados4(this)" value="<?php echo $fecha_actual ?>"  min="<?php echo $fecha_inicio ?>" class="form-control" onkeydown="return false">
                                                                                </div>
                                                                            
                                                                                </div>  -->
                                                                    
                                                                    </div> 
                                                                </div> 
                                                                <div class="form-group">
                                                                
                                                                <canvas id="myChart2" width="400" height="100"></canvas>
                                                                
                                                                 </div> 
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
                                        
                                       

                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Detalle Visitantes por Día</h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                
                                                <!-- Filtro -->
                                                        <div class="x_content">		
                                                            <div class="form-group">
                                                                <div class="col-md-10 col-sm-10 col-xs-12 form-group"> 

                                                                    <label  class="control-label col-md-2 col-sm-3 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i></label>
                                                                          
                                                                        
                                                                </div>   
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <canvas id="myChart4" width="400" height="80"></canvas>
                                                            </div>

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
                                <div class="col-md-12 col-xs-12 col-sm-12">
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
                                            <div class="col-md-4 col-xs-12 col-sm-4">
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
                                        
                                            <div class="col-md-4 col-xs-12 col-sm-4">                          
                                                <div class="image view view-first">
                                                    <img class="thumb-image" style="width: 100%; display: block;" src="images/profiles/<?php echo $profile_pictwo; ?>" alt="image" />
                                                </div> 
                                            </div>	

                                            <div class="col-md-4 col-xs-12 col-sm-4">
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
                                    </div>
                                </div>
                            
                            </div> 
                        
                            <?php include "lib/alerts.php";
                                profile(); //llamada a la funcion de alertas
                                
                            ?>  
                     

                      
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
document.getElementById("precaucion").style.display = "block";
</script>

<?php       

            $query =mysqli_query($con,"CALL grafico_cob_diario (1);");
            if (!$query||mysqli_num_rows($query)!=0){ 
            while ($rowM=$query->fetch_assoc()) 
            {
                $miArray[] = $rowM["fecha"];
                $miArray2[]= $rowM["importe"];	
            }   
                unset($query);
            }
           
            $con->next_result();

            
            $query1 =mysqli_query($con,"CALL grafico_cob_diario (2);");
            if (!$query1||mysqli_num_rows($query1)!=0){ 
               while ($rowM=$query1->fetch_assoc()) 
               {
                    $miArray3[] = $rowM["fecha"];
                    $miArray4[]= $rowM["importe_efectivo"];	
                    $miArray5[]= $rowM["importe_pos"];	
                    $miArray6[]= $rowM["importe_trans"];	
                }   
                    unset($query1);
                }
    
             
            $con->next_result();

            $query2 =mysqli_query($con,"CALL grafico_cob_diario (3);");
            if (!$query2||mysqli_num_rows($query2)!=0){ 
               while ($rowM=$query2->fetch_assoc()) 
               {
                    $miArray7[] = $rowM["fecha"];
                    $miArray8[]= $rowM["emitidos"];	
                    $miArray9[]= $rowM["anulados"];	
                
                }   
                    unset($query2);
                }
    
             
            $con->next_result();

            $query3 =mysqli_query($con,"CALL grafico_cob_diario (4);");
            if (!$query3||mysqli_num_rows($query3)!=0){ 
               while ($rowM=$query3->fetch_assoc()) 
               {
                    $miArray10[] = $rowM["fecha"];
                    $miArray11[]= $rowM["cantidad1"];	
                    $miArray12[]= $rowM["cantidad2"];	
                    $miArray13[]= $rowM["cantidad3"];	
                    $miArray14[]= $rowM["cantidad4"];	
                    $miArray15[]= $rowM["cantidad5"];	
                    $miArray16[]= $rowM["cantidad6"];	
                    $miArray17[]= $rowM["cantidad7"];	
                    $miArray18[]= $rowM["cantidad8"];
                    $miArray22[]= $rowM["cantidad9"];
                    $miArray23[]= $rowM["cantidad10"];	
           
               
                
                }   
                    unset($query3);
                }
    
             
            $con->next_result();

            $query4 =mysqli_query($con,"CALL grafico_cob_diario (5);");
            if (!$query4||mysqli_num_rows($query4)!=0){ 
               while ($rowM=$query4->fetch_assoc()) 
               {
                    $miArray19[] = $rowM["fecha"];
                    $miArray20[]= $rowM["nacional"];	
                    $miArray21[]= $rowM["extranjero"];	
                    $miArray24[]= $rowM["nac_ext"];	
           
               
                
                }   
                    unset($query4);
                }
    
             
            $con->next_result();
            
                  
?>      

 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
 <?php 
 $alert_seg=mysqli_num_rows($TicketData8);
 if($alert_seg>0){ 
 ?>
 <style>
    #precaucion {
        text-transform: capitalize;  
        /* background: red; */
        animation: alerta 1.5s linear 100ms infinite;
        opacity: 0;
        display: none;
      }
      
      @-webkit-keyframes alerta {
          from {opacity: 0;}
          25% {opacity: 1;}
          75% {opacity: 1;}
          to {opacity: 0;}
      } 
      
      @keyframes alerta {
          from {opacity: 0;}
          25% {opacity: 1;}
          75% {opacity: 1;}
          to {opacity: 0;}
      }
      </style>
<?php 
 }
 ?>
<script> 


const dateArrayJS =<?php echo json_encode($miArray);?>;        
const dateChartJS = dateArrayJS.map((day,index)=>{
let diajs = new Date(day);
return diajs.setHours(24,24,24,24);
});

 const config = {
         type: 'line',
         data:
         {
 labels:  dateChartJS,
 datasets:   [{
     label: 'S/. SOLES',
     data: <?php echo json_encode($miArray2);?>,
     pointRadius: 8,
     backgroundColor:[
         'rgba(255, 99, 132, 0.2)'
     ],
     borderColor: [
         'rgba(255, 99, 132, 1)'
     ],
     fill: true,
     tension: 0.1,
     borderWidth: 2
             }]
 }
 ,
         options:    {                   
         scales: {
             x: {
                 min: $("#fe1").val() ,
                 max: $("#fe2").val(),
                 type:'time',
                 time:{
                     unit:'day'
                 }
                
                 },
             y: {
                 beginAtZero: true,
                
                 }
                
                 },
                
           
            
                   
                }
        
     };
     
     
    
    const myChart = new Chart(
     document.getElementById('myChart'),config
    );
    
 </script>
 


<!-- DISEÑO GRAFICO 2 -->
<script> 

const dateArrayJS2 =<?php echo json_encode($miArray3);?>;         
const dateChartJS2 = dateArrayJS2.map((day,index)=>{
let diajs = new Date(day);
return diajs.setHours(24,24,24,24);
});

 const config2 = {
         type: 'bar',
         data:
         {
            labels:  dateChartJS2,
            datasets:   [{
             label: 'EFECTIVO',
             data: <?php echo json_encode($miArray4);?>,
             backgroundColor: [
                 'rgba(54, 162, 235, 0.2)'
             ],
             borderColor: [
                 'rgba(54, 162, 235, 1)'
             ],
             borderWidth: 2
            }
                    ,
                {
            label: 'POS',
             data: <?php echo json_encode($miArray5);?>,
             backgroundColor: [
                 'rgba(170, 226, 165, 0.8)'
                
             ],
             borderColor: [
                 'rgba(22, 129, 12, 0.8)'
             ],
             borderWidth: 2
         },
         {
             label: 'TRANSFERENCIA',
             data: <?php echo json_encode($miArray6);?>,
             backgroundColor: [
               
                 'rgba(194, 100, 24, 0.2)'
             ],
             borderColor: [
              
                 'rgba(194, 100, 24, 1)'
             ],
             borderWidth: 2 
          }]
  }
         ,
         options:    {
         scales: {
             x: {
                 min: $("#fe1").val() ,
                 max: $("#fe2").val(),
                 type:'time',
                 time:{
                     unit:'day'
                 }
                 },
             y: {
                 beginAtZero: true
                 }
                 }
                 }
  };
      

  const myChart2 = new Chart(
     document.getElementById('myChart2'),config2
 );

</script>

<!-- DISEÑO GRAFICO 3 -->
<script> 

const dateArrayJS3 =<?php echo json_encode($miArray19);?>;       
const dateChartJS3 = dateArrayJS3.map((day,index)=>{
let diajs = new Date(day);
return diajs.setHours(24,24,24,24);
});

 const config3 = {
         type: 'line',
         data:
         {
            labels:  dateChartJS3,
            datasets:   [{
            label: 'VISITANTES',
             data: <?php echo json_encode($miArray24);?>,
             pointRadius: 8,
             backgroundColor: [
                 'rgba(48, 2, 231, 0.2)'
                
             ],
             borderColor: [
                 'rgba(48, 2, 231, 0.8)'
             ],
     fill: true,
     tension: 0.1,
     borderWidth: 2
         }]
  }
         ,
         options:    {
         scales: {
             x: {
                 min: $("#fe1").val() ,
                 max: $("#fe2").val(),
                 type:'time',
                 time:{
                     unit:'day'
                 }
                 },
             y: {
                 beginAtZero: true
                 }
                 }
                 }
  };
      

  const myChart3 = new Chart(
     document.getElementById('myChart3'),config3
 );

</script>

<!-- DISEÑO GRAFICO 4 -->
<script> 

const dateArrayJS4 =<?php echo json_encode($miArray10);?>;       
const dateChartJS4 = dateArrayJS4.map((day,index)=>{
let diajs = new Date(day);
return diajs.setHours(24,24,24,24);
});

var bordernum=2;
const config4 = {
         type: 'bar',
         data:
         {
 labels:  dateChartJS,
 datasets:   [{
     label: 'G.NACIONAL',
     data: <?php echo json_encode($miArray11);?>,
     pointRadius: 4,
     backgroundColor:[
        'rgba(255, 65, 56, 0.2)'
     ],
     borderColor: [
         'rgba(255, 65, 56, 1)'
        
     ],
     fill: true,
     tension: 0.1,
     borderWidth: bordernum
             },
             {
     label: 'G.EXTRANJERO',
     data: <?php echo json_encode($miArray15);?>,
     pointRadius: 4,
     backgroundColor:[
        'rgba(185, 194, 23, 0.2)'
     ],
     borderColor: [
            'rgba(185, 194, 23, 1)'
     ],
     fill: true,
     tension: 0.1,
     borderWidth: bordernum
             },
             {
     label: 'ADULTO Y NIÑO NACIONAL',
     data: <?php echo json_encode($miArray12);?>,
     pointRadius: 4,
     backgroundColor:[
          'rgba(48, 2, 231, 0.2)'
     ],
     borderColor: [
          'rgba(48, 2, 231, 0.8)'
     ],
     fill: true,
     tension: 0.1,
     borderWidth: bordernum
             },
             {
     label: 'UNIV - INST NACIONAL',
     data: <?php echo json_encode($miArray13);?>,
     pointRadius: 4,
     backgroundColor:[
         'rgba(170, 226, 165, 0.8)'
     ],
     borderColor: [
          'rgba(22, 129, 12, 0.8)'
     ],
     fill: true,
     tension: 0.1,
     borderWidth: bordernum
             },
             {
     label: 'ESCOLAR NACIONAL',
     data: <?php echo json_encode($miArray14);?>,
     pointRadius: 4,
     backgroundColor:[
        'rgba(54, 162, 235, 0.2)'
     ],
     borderColor: [
         'rgba(54, 162, 235, 1)'
     ],
     fill: true,
     tension: 0.1,
     borderWidth: bordernum
             },
             {
     label: 'NIÑO EXTRANJERO',
     data: <?php echo json_encode($miArray16);?>,
     pointRadius: 4,
     backgroundColor:[
        'rgba(194, 100, 24, 0.2)'
     ],
     borderColor: [
         'rgba(194, 100, 24, 1)'
     ],
     fill: true,
     tension: 0.1,
     borderWidth: bordernum
             },
             {
     label: 'GRATUITO',
     data: <?php echo json_encode($miArray17);?>,
     pointRadius: 4,
     backgroundColor:[
         'rgba(214, 136, 248 , 0.2)'
     ],
     borderColor: [
         'rgba(214, 136, 248 , 1)'
     ],
     fill: true,
     tension: 0.1,
     borderWidth: bordernum
             },
             {
     label: 'CONADIS',
     data: <?php echo json_encode($miArray18);?>,
     pointRadius: 4,
     backgroundColor:[
         'rgba(143, 255, 50 , 0.2)'
     ],
     borderColor: [
         'rgba(143, 255, 50 , 1)'
     ],
     fill: true,
     tension: 0.1,
     borderWidth: bordernum
             },
             {
     label: 'PROMO1',
     data: <?php echo json_encode($miArray22);?>,
     pointRadius: 4,
     backgroundColor:[
         'rgba(236, 72, 255 , 0.2)'
     ],
     borderColor: [
         'rgba(236, 72, 255 , 1)'
     ],
     fill: true,
     tension: 0.1,
     borderWidth: bordernum
             },
             {
     label: 'PROMO2',
     data: <?php echo json_encode($miArray23);?>,
     pointRadius: 4,
     backgroundColor:[
         'rgba(18, 175, 185 , 0.2)'
     ],
     borderColor: [
         'rgba(18, 175, 185 , 1)'
     ],
     fill: true,
     tension: 0.1,
     borderWidth: bordernum
             }]
 }
 ,
         options:    {                   
         scales: {
             x: {
                 min: $("#fe1").val() ,
                 max: $("#fe2").val(),
                 type:'time',
                 time:{
                     unit:'day'
                 }
                
                 },
             y: {
                 beginAtZero: true,
                
                 }
                
                 },
                
           
            
                   
                }
        
     };
      

  const myChart4 = new Chart(
     document.getElementById('myChart4'),config4
 );

</script>

<!-- DISEÑO GRAFICO 5 -->
<script> 

const dateArrayJS5 =<?php echo json_encode($miArray19);?>;       
const dateChartJS5 = dateArrayJS5.map((day,index)=>{
let diajs = new Date(day);
return diajs.setHours(24,24,24,24);
});

 const config5 = {
         type: 'bar',
         data:
         {
            labels:  dateChartJS3,
            datasets:   [{
             label: 'NACIONAL',
             data: <?php echo json_encode($miArray20);?>,
             backgroundColor: [
                 'rgba(54, 162, 235, 0.2)'
             ],
             borderColor: [
                 'rgba(54, 162, 235, 1)'
             ],
             borderWidth: 2
            }
                    ,
                {
            label: 'EXTRANJERO',
             data: <?php echo json_encode($miArray21);?>,
             backgroundColor: [
                 'rgba(194, 100, 24, 0.2)'
                
             ],
             borderColor: [
                 'rgba(194, 100, 24, 1)'
             ],
             borderWidth: 2
         }]
  }
         ,
         options:    {
         scales: {
             x: {
                 min: $("#fe1").val() ,
                 max: $("#fe2").val(),
                 type:'time',
                 time:{
                     unit:'day'
                 }
                 },
             y: {
                 beginAtZero: true
                 }
                 }
                 }
  };
      

  const myChart5 = new Chart(
     document.getElementById('myChart5'),config5
 );

</script>
<script> 
 function mostrarResultados1(date) {
          const startDate=new Date(date.value);
          myChart.config.options.scales.x.min= startDate.setHours(12,12,12,12);
          myChart2.config.options.scales.x.min= startDate.setHours(12,12,12,12);
          myChart3.config.options.scales.x.min= startDate.setHours(12,12,12,12);
          myChart4.config.options.scales.x.min= startDate.setHours(12,12,12,12);
          myChart5.config.options.scales.x.min= startDate.setHours(12,12,12,12);
          myChart.update();
          myChart2.update();
          myChart3.update();
          myChart4.update();
          myChart5.update();
 
 }

 function mostrarResultados2(date) {
          const endDate=new Date(date.value);
          myChart.config.options.scales.x.max= endDate.setHours(24,24,24,24);
          myChart2.config.options.scales.x.max= endDate.setHours(12,12,12,12);
          myChart3.config.options.scales.x.max= endDate.setHours(12,12,12,12);
          myChart4.config.options.scales.x.max= endDate.setHours(12,12,12,12);
          myChart5.config.options.scales.x.max= endDate.setHours(12,12,12,12);
          myChart.update();
          myChart2.update();
          myChart3.update();
          myChart4.update();
          myChart5.update();
 }


</script>


<!-- <script src="js/jqFancyTransitions.js" type="text/javascript"></script>

<script>
$('#slideImagenes').jqFancyTransitions({ width: 900, height: 250 });      
</script> -->
<!-- <div id="slideImagenes">
    	<img src="imagenes/ibe.jpg" alt="" />
        <img src="imagenes/blrh.jpg" alt="" />
    </div> -->
