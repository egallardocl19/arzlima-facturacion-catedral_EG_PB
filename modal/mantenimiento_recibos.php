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

                    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tile-stats" style="background-color:#FFE69A">
                        <a data-toggle="modal" data-target=".bs-example-modal-lg-reporterecibosarrendamiento" >
                          <img src="images/ticket3.png" style="width:350%"></div>
                          <a href="recibos.php?key1=2"><div class="count"><?php echo mysqli_num_rows($TicketData) ?></div></a>
                          <a href="recibos.php?key1=2"><h3 style="color:#777E96">Ticket Nacionales</h3></a>
                        
                                            
                        </div>
                    </div>

                    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tile-stats" style="background-color:#FFE69A">
                        <div class="icon"><img src="images/ticket3.png" style="width:350%"></div>
                        
                          <a href="recibos.php?key1=2"><div class="count"><?php echo mysqli_num_rows($TicketData) ?></div></a>
                          <a href="recibos.php?key1=2"><h3 style="color:#777E96">Ticket Extranjeros</h3></a>
                        </div>
                    </div>

                    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tile-stats" style="background-color:#FFE69A">
                        <div class="icon"><img src="images/ticket3.png" style="width:350%"></div>
                        
                          <a href="recibos.php?key1=2"><div class="count"><?php echo mysqli_num_rows($TicketData) ?></div></a>
                          <a href="recibos.php?key1=2"><h3 style="color:#777E96">Ticket Crédito</h3></a>
                        </div>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><i class="fa fa-child" aria-hidden="true"></i> Clase Ticket:</label>
                                
                                <div class="col-md-9 col-sm-9 col-xs-12">

                                    <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="idclase" name="idclase" data-size="5" style="max-width: 100%!important;" >
                                    <option value="">-- Seleccionar Clase--</option> 
                                    <?php foreach($clase as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                </div>
                            </div>
                        
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><i class="fa fa-child" aria-hidden="true"></i> Tipo Ticket:</label>
                                
                                <div class="col-md-9 col-sm-9 col-xs-12">

                                    <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="idtipo" name="idtipo" data-size="5" style="max-width: 100%!important;" >
                                      <option value="">-- Seleccionar Clase Ticket --</option>  	
                                    
                                    </select>
                                
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><i class="fa fa-cubes" aria-hidden="true"></i> Serie:</label>
                                
                                <div class="col-md-9 col-sm-9 col-xs-12">

                                    <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="serie" name="serie" data-size="5" style="max-width: 100%!important;" >
                                    <option value="">-- Seleccionar Clase Ticket --</option>  
                                   
                                    </select>
                                
                                </div>
                            </div>
                            
                            

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha:<span class="required"></span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control"  value="<?php echo $fechahoy;?>" readonly="true" >
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
                            </div>

                           

                     

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"> Moneda:</label>
                                
                                <div class="col-md-8 col-sm-8 col-xs-12">

                                    <select  class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="tipo_moneda" name="tipo_moneda" data-size="5" style="max-width: 100%!important;" >
                                    
                                    <?php foreach($moneda as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                </div>
                                
                            </div>

                           
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-money" aria-hidden="true"></i> Costo: </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="importe" name="importe"  class="form-control" placeholder="0.00" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-5 col-sm-5 col-xs-12"><i class="fa fa-suitcase" aria-hidden="true"></i> Cantidad: <span class="required"></span></label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="cantidad" value="1">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" style="color:red"><i class="fa fa-money" aria-hidden="true"></i> Monto Total: </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                               
                                <!-- <label  id="monto_total_ticket" name="monto_total_ticket" style="font-size: x-large" ></label> -->
                                <input type="text" id="monto_total_ticket" name="monto_total_ticket"  class="form-control" style="color:red; font-weight: bold; font-size:20px;" placeholder="0.00" readonly="true">
                                </div>
                            </div>  
                            
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"> Tipo Pago:</label>
                                
                                <div class="col-md-8 col-sm-8 col-xs-12">

                                    <!-- <select  class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="tipo_pago" name="tipo_pago" data-size="5" style="max-width: 100%!important;" > -->
                                    <select  class="form-control"   id="tipo_pago" name="tipo_pago" data-size="5" style="max-width: 100%!important;" >
                                    <?php foreach($forma_pago as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                </div>
                                
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"> N° Pago: </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="n_pago" name="n_pago"  class="form-control" placeholder="0000000000" >
                                </div>
                            </div>

                           
                            
                        </div>
                 
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
            let input = document.getElementById('cantidad');
            input.addEventListener('focus', function(){
               document.onkeyup    = function(e){
                        $cantidad1=$("#cantidad").val();
                        $importe1=$("#importe").val();
                         if ($cantidad1==''){
                            $cantidad1=0;
                         }else{
                            $cantidad1=parseFloat($cantidad1);
                         }
                         if ($importe1==''){
                            $importe1=0;
                         }else{
                            $importe1=parseFloat($importe1);
                         }
                         $valor_total=($importe1*$cantidad1);
                         $("#monto_total_ticket").val($valor_total.toFixed(2));
                        // document.getElementById('monto_total_ticket').innerHTML=$valor_total.toFixed(2); 

                }

            })
        })          
</script> 
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
    </script> 

    <script language="javascript">
           
                $(document).ready(function(){
                    $("#idtipo").change(function () {
                        $("#idtipo option:selected").each(function () {
                            condicion = $(this).val();
                            caso = "1";
                            $.post("includes/getRecibo_val.php", { caso: caso, condicion: condicion}, function(data){
                             var res = data.split("-");    
                            $("#importe").val(res[1]);  
                            $valor_importe=res[0];
                             $valor_cantidad=$("#cantidad").val();
                             $valor_total=($valor_importe*$valor_cantidad);
                             $("#monto_total_ticket").val($valor_total.toFixed(2));
                            //  document.getElementById('monto_total_ticket').innerHTML=$valor_total.toFixed(2);                                             
                            });                          
                        });
                    })
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
 
         <script> //VALIDAR CARACTERES PARA INGRESAR AL CAMPO TEXTO
            $(document).ready(function(){      
                document.getElementById("dni").addEventListener("keypress",verificar_numeros);
                
                function verificar_numeros(e) {
                if(e.key.match(/[0-9]/i)===null) {
                    e.preventDefault();
                    
                }
                
                }
             })
            </script> 


            <script language="javascript">
                
                    $(document).ready(function(){
                        let input = document.getElementById('dni');
                        input.addEventListener('focus', function(){
                        document.onkeyup    = function(e){
                                    $cantidadx=$("#dni").val();
                                    //$cantidad=$cantidadx.length;
                                    if($cantidadx.length==8 || $cantidadx.length==11){
                                        $cantidadxx=$("#dni").val();
                                        $.post("includes/getCliente_nombre_api.php", { id_numero_identidad: $cantidadxx}, function(data){
                                            var res = data.split("-");    
                                            $("#razon_social").val(res[0].trim()); 
                                            $("#direccion").val(res[1].trim()); 
                                                            
                                        }); 
                                    }else{
                                        $("#razon_social").val(''); 
                                        $("#direccion").val(''); 
                                    }
                            }

                        })
                    }) 
                       
            </script> 


        <script> //VALIDAR CARACTERES PARA INGRESAR AL CAMPO TEXTO
                    // creamos el evento para cada tecla pulsada
                    document.getElementById("razon_social").addEventListener("keypress",verificar);
                    
                    function verificar(e) {
                    
                        // comprovamos con una expresion regular que el caracter pulsado sea
                        // una letra, numero o un espacio
                        if(e.key.match(/[A-Za-zÁÉÍÓÚáéíóú'Ññ&-.()/]/i)===null) {
                            // Si la tecla pulsada no es la correcta, eliminado la pulsación
                            e.preventDefault();
                            
                        }
                        
                    }

            </script>
    
    