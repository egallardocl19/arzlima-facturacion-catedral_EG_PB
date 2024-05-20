    <?php
     $rutalocal='../inmuebles/report/recibo_arrendamiento.php';
     $rutaserver='../report/recibo_arrendamiento.php';

    $permiso_token =mysqli_query($con,"CALL permisos('$id','$key1','$tok1');");
    if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){
        
    ?>
    <div> <!-- Modal -->
        <button type="button" id="agregar" class="btn btn-primary" data-toggle="modal" 
        data-target=".bs-example-modal-lg-add"  onclick="limpiarFormulario()"><i class="fa fa-plus-circle"></i> Agregar <?php echo  $titulo?></button>
    </div>
    <?php
    }
    $permiso_token->close();  
    $con->next_result();
    ?>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lm">
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
                    <div class="form-group">  

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Cobranza:</label>
                                
                                <div class="col-md-7 col-sm-7 col-xs-12">

                                    <!-- <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="idticket" name="idticket" data-size="5" style="max-width: 100%!important;" >
                                    <option value="">-- Seleccionar Ticket--</option> 
                                 
                                    </select> -->
                                    <input type="date" id="fecha" name="fecha" class="form-control" placeholder="Fecha Hasta" >
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                               
                                        <button id="buscar" type="button" class="btn btn-primary" onclick="buscarcobranza()">Buscar</button> 
                                </div>
                            </div>

<!-- 
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha:<span class="required"></span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="fecha_inicio" name="fecha_inicio" class="form-control" >
                                </div>

                            </div>   

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"> DNI / RUC: <span class="required"></span></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text"  id="dni" name="dni" class="form-control"  placeholder="DNI" maxlength="11">
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12"> Nombre: <span class="required"></span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text"  id="razon_social" name="razon_social" class="form-control"  placeholder="Nombre - Razón Social" maxlength="11">
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12"> Dirección: <span class="required"></span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text"  id="direccion" name="direccion" class="form-control"  placeholder="Dirección" maxlength="11">
                                </div>
                            </div> -->

                           

                     

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12"><i class="fa fa-money" aria-hidden="true"></i> Moneda:</label>
                                
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <select  class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="tipo_moneda" name="tipo_moneda" data-size="5" style="max-width: 100%!important;" >
                                    
                                    <?php foreach($moneda as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                </div>
                                
                            </div>

                           
                            <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-money" aria-hidden="true"></i> Costo: </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="importe" name="importe"  class="form-control" placeholder="0.00" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-5 col-sm-5 col-xs-12"><i class="fa fa-suitcase" aria-hidden="true"></i> Cantidad: <span class="required"></span></label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" id="cantidad" name="cantidad" class="form-control" placeholder="0" >
                                </div>
                            </div> -->

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12" style="color:red"><i class="fa fa-money" aria-hidden="true"></i> Monto Total: </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                               
                                <!-- <label  id="monto_total_ticket" name="monto_total_ticket" style="font-size: x-large" ></label> -->
                                <input type="text" id="monto_total_ticket" name="monto_total_ticket"  class="form-control" style="color:red; font-weight: bold; font-size:20px;" placeholder="0.00" readonly="true">
                                </div>
                            </div>  
                            
                            

                           
                            
                         </div>
                        <!--------------------------------------------------------------------------------->
                        <div class="form-group" id="detalle_notas">  
                            <div class="ln_solid"></div> 
                                    <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                                        
                                        <h4 class="modal-title" id="myModalLabel_notas" style="text-align: center"><strong> Detalle Cobranza</strong></h4>
                                    </div>      
                                    
                                <div class="x_panel">
                                    <div class="x_content">
                                        <div class="table-responsive">
                                            <div class="form-group">
                                                
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12"> F.Deposito:</label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="date" id="fecha2" name="fecha2" class="form-control" placeholder="Fecha Hasta" >
                                                </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> T.Pago:</label>
                                                
                                                    <div class="col-md-8 col-sm-8 col-xs-12">

                                                        <select  class="form-control"   id="tipo_pago" name="tipo_pago" data-size="5" style="max-width: 100%!important;" >
                                                        
                                                        <?php foreach($forma_pago as $p):?>
                                                            <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre'];  ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    
                                                    </div>
                                                
                                                </div>

                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> N° Operación: </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input type="text" id="n_operacion" name="n_operacion"  class="form-control" placeholder="0000000000" >
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> Banco: </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input type="text" id="banco" name="banco"  class="form-control" value="BCP" readonly="true" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> Cuenta: </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input type="text" id="cuenta" name="cuenta"  class="form-control" value="999-999-999-999" readonly="true" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <label class="control-label col-md-2 col-sm-2 col-xs-12"> Observación: </label>
                                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                                    <textarea id="observaciones" name="observaciones" class="form-control" placeholder="Observación" maxlength="249" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 
                            </div>
                        </div>
                        <!--------------------------------------------------------------------------------->
                       
                       
                        <!--------------------------------------------------------------------------------->
                        <div class="ln_solid"></div>
                        <div id="result"></div>
                        <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <button id="save_data" type="submit" class="btn btn-success"></button>
                                       
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <button id="nuevo" type="button" class="btn btn-warning" onclick="limpiarFormulario()"></button> 
                                    </div>
                                </div>
                        </div>    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarFormulario()"><i class="glyphicon glyphicon-remove"> </i> Cerrar</button>
                    
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
                    $("#idticket").change(function () {
                        $("#idticket option:selected").each(function () {
                            condicion = $(this).val();
                            caso = "2";
                            $.post("includes/getRecibo_val.php", { caso: caso, condicion: condicion}, function(data){
                             var res = data.split("-");    
                            $("#dni").val(res[0]);  
                            $("#razon_social").val(res[1]);  
                            $("#direccion").val(res[2]);  
                            $("#fecha_inicio").val(res[3]);  
                            $("#cantidad").val(res[4]); 
                            $("#monto_total_ticket").val(res[5]);  
                            $("#importe").val(res[6]);  

                           
                                                                       
                            });                          
                        });
                    })
                });      
    </script> 

     
    