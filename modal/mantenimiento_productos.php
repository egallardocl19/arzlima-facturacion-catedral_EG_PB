    <?php
  

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

                                                 
                           
                    <div class="form-group">  
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><i class="fa fa-university" aria-hidden="true"></i> Nombre: <span class="required"></span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text"  id="nombre" name="nombre" class="form-control"  placeholder="Nombre Producto" maxlength="200" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>

                            </div>   
                            <div class="form-group">   
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><i class="fa fa-money" aria-hidden="true"></i> Precio: <span class="required"></span></label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text"  id="precio" name="precio" class="form-control"  placeholder="Precio" maxlength="9">
                                </div>
                            </div>

                            </div>   
                            <div class="form-group">                  
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><i class="fa fa-tag" aria-hidden="true"></i> Estado:</label>
                                
                                <div class="col-md-4 col-sm-4 col-xs-12">

                                    <select  class="form-control" id="estado_producto" name="estado_producto" data-size="5" >
                                    
                                    <?php foreach($estado_dato as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                </div>
                                
                            </div>              
                            </div>
                        </div>
                 
                        <!--------------------------------------------------------------------------------->
                        <div class="ln_solid"></div>
                        <div id="result"></div>
                        <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-2">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <button id="save_data" type="submit" class="btn<?php echo $tamaniocampo ?> btn-success"></button>
                                       
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group<?php echo $tamaniocampo ?>">
                                        <button id="nuevo" type="button" class="btn<?php echo $tamaniocampo ?> btn-warning" onclick="limpiarFormulario()"></button> 
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
		
         <script> //VALIDAR CARACTERES PARA INGRESAR AL CAMPO TEXTO
            $(document).ready(function(){      
                document.getElementById("precio").addEventListener("keypress",verificar_numeros);
                               
                function verificar_numeros(e) {
                if(e.key.match(/[0-9.]/i)===null) {
                    e.preventDefault();
                    
                }
                
                }
             })
            </script> 

           

        <script> //VALIDAR CARACTERES PARA INGRESAR AL CAMPO TEXTO
                   
                    document.getElementById("nombre").addEventListener("keypress",verificar);
                    
                    function verificar(e) {
                        if(e.key.match(/[0-9a- zA-ZÁÉÍÓÚáéíóú'Ññ&-.()/]/i)===null) {
                            // Si la tecla pulsada no es la correcta, eliminado la pulsación
                            e.preventDefault();
                            
                        }
                        
                    }

            </script>
  
                    
    