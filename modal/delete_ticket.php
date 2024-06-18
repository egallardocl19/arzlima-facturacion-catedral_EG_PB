
  
    <div class="modal fade bs-example-modal-lg-addanular" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-mg">
            <div class="modal-content">
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><strong><i class="fa fa-ban" aria-hidden="true"></i> Anular Ticket</strong></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="del" name="del">
                    <input type="hidden" id="mod_id" name="mod_id">
                        
                        <div class="form-group">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> N° Ticket: </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" id="n_ticket" name="n_ticket"  class="form-control" readonly="true" style="color:red; font-weight: bold; font-size:20px;">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group<?php echo $tamaniocampo ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"><i class="fa fa-inbox" aria-hidden="true"></i> Motivo:</label>
                                        
                                        <div class="col-md-9 col-sm-9 col-xs-12">

                                            <select class="form-control"  id="idmotivo" name="idmotivo" data-size="5" style="max-width: 100%!important;" >
                                            <option value="">----- Seleccionar Motivo -----</option>  	
                                            <?php foreach($ticket_motivos as $p):?>
                                                <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        
                                        </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="ln_solid"></div> 
                        <div id="result2"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                              <button id="save_data" type="submit" class="btn<?php echo $tamaniocampo ?> btn-success"><i class="glyphicon glyphicon-ok"> </i> Anular</button>
                            </div>
                        </div>    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn<?php echo $tamaniocampo ?> btn-danger" data-dismiss="modal" onclick="limpiarFormulario_reciboantiguo()"><i class="glyphicon glyphicon-remove"> </i> Cerrar</button>
                    
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