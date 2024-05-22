    <?php
     $rutalocal='../inmuebles/report/recibo_arrendamiento.php';
     $rutaserver='../report/recibo_arrendamiento.php';

    $permiso_token =mysqli_query($con,"CALL permisos('$id','$key1','$tok1');"); 
    if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){
        
    ?>
 <!-- Modal -->
    <!-- <div>
        <button type="button" id="agregar" class="btn btn-primary" data-toggle="modal" 
        data-target=".bs-example-modal-lg-add"  onclick="limpiarFormulario()"><i class="fa fa-plus-circle"></i> Agregar <?php echo  $titulo?></button>
    </div> -->

                    <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12" id="agregar1">
                        <div class="tile-stats" style="background-color:#FFE69A"> 
                        <div class="icon"><img src="images/ticket3.png" style="width:350%"></div>
                          <a data-toggle="modal" data-target=".bs-example-modal-lg-add-caja" ><div class="count"><?php echo mysqli_num_rows($TicketData) ?></div></a>
                          <a data-toggle="modal" data-target=".bs-example-modal-lg-add-caja" ><h3 style="color:#777E96">Ticket General</h3></a>           
                        </div>
                    </div>

                    <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12" id="agregar2">
                        <div class="tile-stats" style="background-color:#FFE69A">
                        <div class="icon"><img src="images/ticket3.png" style="width:350%"></div>
                        
                        <a data-toggle="modal" data-target=".bs-example-modal-lg-add-caja" ><div class="count"><?php echo mysqli_num_rows($TicketData1) ?></div></a>
                          <a data-toggle="modal" data-target=".bs-example-modal-lg-add-caja" ><h3 style="color:#777E96">Ticket Promocional</h3></a>
                        </div>
                    </div>

                    <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12" id="agregar2">
                        <div class="tile-stats" style="background-color:#FFE69A">
                        <div class="icon"><img src="images/shop.png" style="width:350%"></div>
                        
                        <a data-toggle="modal" data-target=".bs-example-modal-lg-add-caja2" ><div class="count">0</div></a>
                          <a data-toggle="modal" data-target=".bs-example-modal-lg-add-caja2" ><h3 style="color:#777E96">Ticket Productos</h3></a>
                        </div>
                    </div>
    
    <?php
    }
    $permiso_token->close();  
    $con->next_result();
    ?>
    <div class="modal fade bs-example-modal-lg-add-caja" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" >
                    <input type="hidden" id="valor_mantenimiento" name="valor_mantenimiento">
                    <input type="hidden" id="codigo" name="codigo">
                    <input type="hidden" id="clase" name="clase">
                    <div class="form-group">  

                            
                            <!-- ###################################################### -->
                            <div class="form-group" id="gp1">  
                            
                                <div class="col-md-6 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo1 ?>">
                                    <div class="form-group" >  
                                        <div class="col-md-12 col-sm-12 col-xs-12">

                                            <select class="form-control" id="idtipo1" name="idtipo1" data-size="5" style="max-width: 100%!important;" >
                                            
                                            </select>
                                        
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-8 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo1 ?>">
                                    <div class="form-group" >  
                                        <div class="col-md-3 col-sm-4 col-xs-4">
                                        <button type="button" class="btn btn-primary btn-circle btn-md" onclick="incrementar1()" style="font-weight: bold; font-size:20px;">+</button>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                        <input type="text" id="cantidad1" name="cantidad1"  class="form-control" style="font-weight: bold; font-size:20px;" value=0 readonly="true">
                                        </div>
                                        <div class="col-md-2 col-sm-4 col-xs-1">
                                        <button type="button" class="btn btn-primary btn-circle btn-md" onclick="decrementar1()" style="font-weight: bold; font-size:20px;">-</button>    
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-2 col-sm-4 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo1 ?>">
                                    <div class="form-group" > 
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="monto_total1" name="monto_total1"  class="form-control" style="color:red; font-weight: bold; font-size:20px;" placeholder="0.00" readonly="true">
                                        </div>
                                    </div>  
                                </div> 
                                
                            </div> 
                            
                            <!-- ###################################################### -->
                            <div class="form-group" id="gp2">  
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo2 ?>">
                            <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <select class="form-control" id="idtipo2" name="idtipo2" data-size="5" style="max-width: 100%!important;" >

                                    </select>
                               </div>
                               </div>
                           </div>

                                <div class="col-md-4 col-sm-8 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo2 ?>">
                                <div class="form-group" > 
                                <div class="col-md-3 col-sm-4 col-xs-4">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="incrementar2()" style="font-weight: bold; font-size:20px;">+</button>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                <input type="text" id="cantidad2" name="cantidad2"  class="form-control" style="font-weight: bold; font-size:20px;" value=0 readonly="true">
                                </div>
                               <div class="col-md-2 col-sm-4 col-xs-1">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="decrementar2()" style="font-weight: bold; font-size:20px;">-</button>    
                                </div>
                                </div>
                                </div>

                           <div class="col-md-2 col-sm-4 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo2 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                               <input type="text" id="monto_total2" name="monto_total2"  class="form-control" style="color:red; font-weight: bold; font-size:20px;" placeholder="0.00" readonly="true">
                               </div>
                               </div>  
                           </div>  
                           </div>
                          
                            <!-- ###################################################### -->
                            <div class="form-group" id="gp3"> 
                           <div class="col-md-6 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo3 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">

                                   <select class="form-control" id="idtipo3" name="idtipo3" data-size="5" style="max-width: 100%!important;" >
                                   
                                    </select>
                               
                               </div>
                           </div>
                           </div>
                                    
                          
                            <div class="col-md-4 col-sm-8 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo3 ?>">
                            <div class="form-group" > 
                                <div class="col-md-3 col-sm-4 col-xs-4">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="incrementar3()" style="font-weight: bold; font-size:20px;">+</button>
                                </div>   
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                <input type="text" id="cantidad3" name="cantidad3"  class="form-control" style="font-weight: bold; font-size:20px;" value=0 readonly="true">
                                </div>
                               <div class="col-md-2 col-sm-4 col-xs-1">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="decrementar3()" style="font-weight: bold; font-size:20px;">-</button>    
                                </div>
                           </div>
                           </div>

                           <div class="col-md-2 col-sm-4 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo3 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                               <input type="text" id="monto_total3" name="monto_total3"  class="form-control" style="color:red; font-weight: bold; font-size:20px;" placeholder="0.00" readonly="true">
                               </div>
                           </div>  
                           </div>  
                           </div>  
                           <!-- <div class="ln_solid" id="ln3"></div> -->
                            <!-- ###################################################### -->
                            <div class="form-group" id="gp4"> 
                           <div class="col-md-6 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo7 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <select class="form-control" id="idtipo4" name="idtipo4" data-size="5" style="max-width: 100%!important;" >
                                    
                                    </select>
                               </div>
                           </div>
                           </div>

                           <div class="col-md-4 col-sm-8 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo7 ?>">
                           <div class="form-group" > 
                                <div class="col-md-3 col-sm-4 col-xs-4">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="incrementar4()" style="font-weight: bold; font-size:20px;">+</button>
                                </div> 
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                <input type="text" id="cantidad4" name="cantidad4"  class="form-control" style="font-weight: bold; font-size:20px;" value=0 readonly="true">
                                </div>
                               <div class="col-md-2 col-sm-4 col-xs-1">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="decrementar4()" style="font-weight: bold; font-size:20px;">-</button>    
                                </div>
                           </div>
                           </div>

                           <div class="col-md-2 col-sm-4 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo7 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                               <input type="text" id="monto_total4" name="monto_total4"  class="form-control" style="color:red; font-weight: bold; font-size:20px;" placeholder="0.00" readonly="true">
                               </div>
                           </div>  
                           </div>  

                           </div> 
                           <!-- <div class="ln_solid" id="ln4"></div> -->
                           <!-- ###################################################### -->
                           <div class="form-group" id="gp5"> 
                           <div class="col-md-6 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo5 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <select class="form-control " id="idtipo5" name="idtipo5" data-size="5" style="max-width: 100%!important;" >
                                    
                                    </select>
                               </div>
                           </div>
                           </div>

                           <div class="col-md-4 col-sm-8 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo5 ?>">
                           <div class="form-group" > 
                                <div class="col-md-3 col-sm-4 col-xs-4">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="incrementar5()" style="font-weight: bold; font-size:20px;">+</button>
                                </div> 
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                <input type="text" id="cantidad5" name="cantidad5"  class="form-control" style="font-weight: bold; font-size:20px;" value=0 readonly="true">
                                </div>
                               <div class="col-md-2 col-sm-4 col-xs-1">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="decrementar5()" style="font-weight: bold; font-size:20px;">-</button>    
                                </div>
                           </div>
                           </div>

                           <div class="col-md-2 col-sm-4 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo5 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                               <input type="text" id="monto_total5" name="monto_total5"  class="form-control" style="color:red; font-weight: bold; font-size:20px;" placeholder="0.00" readonly="true">
                               </div>
                           </div>  
                           </div>  

                           </div> 
                            <!-- ###################################################### -->
                            <div class="form-group" id="gp6"> 
                           <div class="col-md-6 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo6 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <select class="form-control" id="idtipo6" name="idtipo6" data-size="5" style="max-width: 100%!important;" >
                                    
                                    </select>
                               </div>
                           </div>
                           </div>

                           <div class="col-md-4 col-sm-8 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo6 ?>">
                           <div class="form-group" > 
                                <div class="col-md-3 col-sm-4 col-xs-4">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="incrementar6()" style="font-weight: bold; font-size:20px;">+</button>
                                </div> 
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                <input type="text" id="cantidad6" name="cantidad6"  class="form-control" style="font-weight: bold; font-size:20px;" value=0 readonly="true">
                                </div>
                               <div class="col-md-2 col-sm-4 col-xs-1">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="decrementar6()" style="font-weight: bold; font-size:20px;">-</button>    
                                </div>
                           </div>
                           </div>

                           <div class="col-md-2 col-sm-4 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo6 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                               <input type="text" id="monto_total6" name="monto_total6"  class="form-control" style="color:red; font-weight: bold; font-size:20px;" placeholder="0.00" readonly="true">
                               </div>
                           </div>  
                           </div>  

                           </div> 
                            <!-- ###################################################### -->
                            <div class="form-group" id="gp7"> 
                           <div class="col-md-6 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo4 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <select class="form-control " id="idtipo7" name="idtipo7" data-size="5" style="max-width: 100%!important;" >
                                    
                                    </select>
                               </div>
                           </div>
                           </div>

                           <div class="col-md-4 col-sm-8 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo4 ?>">
                           <div class="form-group" > 
                                <div class="col-md-3 col-sm-4 col-xs-4">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="incrementar7()" style="font-weight: bold; font-size:20px;">+</button>
                                </div> 
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                <input type="text" id="cantidad7" name="cantidad7"  class="form-control" style="font-weight: bold; font-size:20px;" value=0 readonly="true">
                                </div>
                               <div class="col-md-2 col-sm-4 col-xs-1">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="decrementar7()" style="font-weight: bold; font-size:20px;">-</button>    
                                </div>
                           </div>
                           </div>

                           <div class="col-md-2 col-sm-4 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo4 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                               <input type="text" id="monto_total7" name="monto_total7"  class="form-control" style="color:red; font-weight: bold; font-size:20px;" placeholder="0.00" readonly="true">
                               </div>
                           </div>  
                           </div>  

                           </div> 
                        

                           <!-- ###################################################### -->
                           <div class="form-group" id="gp8"> 
                           <div class="col-md-6 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo4 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <select class="form-control " id="idtipo8" name="idtipo8" data-size="5" style="max-width: 100%!important;" >
                                    
                                    </select>
                               </div>
                           </div>
                           </div>

                           <div class="col-md-4 col-sm-8 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo4 ?>">
                           <div class="form-group" > 
                                <div class="col-md-3 col-sm-4 col-xs-4">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="incrementar8()" style="font-weight: bold; font-size:20px;">+</button>
                                </div> 
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                <input type="text" id="cantidad8" name="cantidad8"  class="form-control" style="font-weight: bold; font-size:20px;" value=0 readonly="true">
                                </div>
                               <div class="col-md-2 col-sm-4 col-xs-1">
                                <button type="button" class="btn btn-primary btn-circle btn-md" onclick="decrementar8()" style="font-weight: bold; font-size:20px;">-</button>    
                                </div>
                           </div>
                           </div>

                           <div class="col-md-2 col-sm-4 col-xs-12 form-group<?php echo $tamaniocampo ?>" style="background-color:<?php echo $colortipo4 ?>">
                           <div class="form-group" > 
                               <div class="col-md-12 col-sm-12 col-xs-12">
                               <input type="text" id="monto_total8" name="monto_total8"  class="form-control" style="color:red; font-weight: bold; font-size:20px;" placeholder="0.00" readonly="true">
                               </div>
                           </div>  
                           </div>  

                           </div> 
                           <div class="ln_solid" id="ln8"></div>
                            <!-- ###################################################### -->
                            <div class="form-group">  
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group<?php echo $tamaniocampo ?>">
                                <div class="form-group"> 
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> :<span class="required"></span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control"  value="<?php echo $fechahoy;?>" readonly="true" >
                                    </div>
                                    </div>  
                                </div>  

                                <div class="col-md-4 col-sm-6 col-xs-12 form-group<?php echo $tamaniocampo ?>">
                                <div class="form-group"> 
                                <label class="control-label col-md-5 col-sm-5 col-xs-12" style="color:red"><i class="fa fa-money" aria-hidden="true"></i> Total:</label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" id="monto_totalx" name="monto_totalx"  class="form-control" style="color:red; font-weight: bold; font-size:20px;" placeholder="0.00" readonly="true">
                                </div>
                                 </div>  
                                 </div>  

                                <div class="col-md-4 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>">
                                    <div class="form-group"> 
                                        <label class="control-label col-md-3 col-sm-2 col-xs-12"> Serie:</label>
                                    
                                        <div class="col-md-9 col-sm-10 col-xs-12">

                                            <select class="form-control"  id="serie" name="serie" data-size="5" style="max-width: 100%!important;" >
                                        
                                            <!-- <?php foreach($serie1 as $p):?>
                                                <option value="<?php echo $p['abrev']; ?>"><?php echo $p['abrev'];  ?></option>
                                                <?php endforeach; ?> -->
                                            </select>
                                        
                                        </div>
                                    </div>  
                                </div>

                            </div>
                            
                            
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>">
                            <div class="form-group" >
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"> Tipo Pago:</label>
                                
                                <div class="col-md-8 col-sm-8 col-xs-12">

                                    <select  class="selectpicker" id="tipo_pago" name="tipo_pago" data-size="5" style="max-width: 100%!important;" >
                                   
                                    <?php foreach($forma_pago as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                </div>
                                
                            </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>">
                            <div class="form-group" >
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"> N° Pago: </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="n_pago" name="n_pago"  class="form-control" placeholder="0000000000" maxlength="6">
                                </div>
                            </div>
                            </div>
                           
                            
                        </div>
                 
                        <!--------------------------------------------------------------------------------->
                        <div class="ln_solid"></div>
                        <div id="result"></div>
                        <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <button id="save_data" type="submit" class="btn<?php echo $tamaniocampo ?> btn-success"></button>
                                       
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <button id="nuevo" type="button" class="btn<?php echo $tamaniocampo ?> btn-warning" onclick="limpiarFormulario()"></button> 
                                    </div>
                                </div>
                        </div>    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-lg btn-danger" data-dismiss="modal" onclick="limpiarFormulario()"><i class="glyphicon glyphicon-remove"> </i> Cerrar</button>
                    
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->
    <script language="javascript" src="js/jquery-3.1.1.min.js"></script>

    <script language="javascript">
        $(document).ready(function(){
            const inputs = document.querySelectorAll('input');
            inputs.forEach(function(input) {
            input.addEventListener("keydown", (evento) => {
                if (evento.key == "Enter") {
                    // Prevenir
                    evento.preventDefault();
                    return false;
                }
            });
            });
          });                        
    </script> 
		
   

          <script language="javascript">
                $(document).ready(function(){
                    $("#tipo_pago").change(function () {
                        $("#tipo_pago option:selected").each(function () {
                            condicion = $(this).val();

                            if(condicion==5){
                                $("#n_pago").val('');
                                $("#n_pago").prop("readonly",false);
                            }else{
                                $("#n_pago").val('');
                                $("#n_pago").prop("readonly",true);
                            }   
                        });
                    })
                });      
    </script> 
 
   
   

<!-- <script language="javascript">
                $(document).ready(function(){
                    $("#idclase").change(function () {
                        $("#idclase option:selected").each(function () {
                            condicion = $(this).val();
                            $.post("includes/getRecibo_html.php", { caso: 1, condicion: condicion}, function(data){
                            $("#idtipo").html(data).addClass("selectpicker").selectpicker('refresh');              
                            }); 
                            $.post("includes/getRecibo_html.php", { caso: 2, condicion: condicion}, function(data){
                            $("#serie").html(data).addClass("selectpicker").selectpicker('refresh');              
                            }); 

                        });
                    })
                });      
    </script>  -->
