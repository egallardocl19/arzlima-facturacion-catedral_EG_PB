
    <div> <!-- Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-addpermisos"><i class="fa fa-plus-circle"></i> Agregar SubModulo</button>
    </div>
    <div class="modal fade bs-example-modal-lg-addpermisos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-mg">
            <div class="modal-content">
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><strong><i class="fa fa-inbox" aria-hidden="true"></i> Agregar Sub-Modulo</strong></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add">
                        
                        
                        <div class="form-group">
                            
                          
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-inbox" aria-hidden="true"></i> Modulo:</label>
                                
                                <div class="col-md-8 col-sm-8 col-xs-12">

                                    <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="idmodulo" name="idmodulo" data-size="5" style="max-width: 100%!important;" >
                                    <option value="0">----- Seleccionar Modulo -----</option>  	
                                    <?php foreach($modulo as $p):?>
                                        <option value="<?php echo $p['idmodulo']; ?>"><?php echo $p['nombre']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-inbox" aria-hidden="true"></i> Nombre Sub-Modulo: <span class="required"></span></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="submodulo" name="submodulo" class="form-control" placeholder="SubModulo" >
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-file-archive-o" aria-hidden="true"></i> Nombre Plantilla: <span class="required"></span></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="plantilla" name="plantilla" class="form-control" placeholder="plantilla.php" >
                                </div>
                            </div>
                            
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-building" aria-hidden="true"></i> Titulo Plantilla: <span class="required"></span></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea id="observaciones" name="observaciones" class="form-control" placeholder="Titulo Plantilla" maxlength="100" ></textarea>
                                
                                </div>
                            </div>
                            

                          
                            
                        </div>

                        <div class="ln_solid"></div> 
                        <div id="result"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                              <button id="save_data" type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"> </i> Guardar</button>
                            </div>
                        </div>    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarFormulario_reciboantiguo()"><i class="glyphicon glyphicon-remove"> </i> Cerrar</button>
                    
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->

     

        <script> //VALIDAR CARACTERES PARA INGRESAR AL CAMPO TEXTO
            // creamos el evento para cada tecla pulsada
            document.getElementById("submodulo").addEventListener("keypress",verificar);
            function verificar(e) {
                // comprovamos con una expresion regular que el caracter pulsado sea
                // una letra, numero o un espacio
                if(e.key.match(/[a-z0-9ñáéíóú./\s]/i)===null) {
                    // Si la tecla pulsada no es la correcta, eliminado la pulsación
                    e.preventDefault();
                }
            }




            </script>