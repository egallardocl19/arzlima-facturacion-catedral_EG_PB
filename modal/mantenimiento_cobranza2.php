    <?php
     $rutalocal='../inmuebles/report/recibo_arrendamiento.php';
     $rutaserver='../report/recibo_arrendamiento.php';
    ?>
    <div class="modal fade bs-example-modal-lg-add-updatecobranza" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lm">
            <div class="modal-content">
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2" style="text-align: center"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add2" name="add2" >
                    <input type="hidden" id="valor_mantenimiento2" name="valor_mantenimiento2">
                    <input type="hidden" id="codigo2" name="codigo2">
                   
                        <!--------------------------------------------------------------------------------->
                        <div class="form-group" id="detalle_notas">  
                           
                                    
                                
                                   
                                        <div class="table-responsive">
                                            <div class="form-group">

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <label class="control-label col-md-5 col-sm-5 col-xs-12"> N° Cobranza:</label>
                                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <input type="text" id="n_cobranza2" name="n_cobranza2"  class="form-control" placeholder="0000000000" readonly="true">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> Fecha:</label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input type="date" id="fecha_cobranza2" name="fecha_cobranza2" class="form-control" placeholder="Fecha Hasta"  readonly="true" >
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-sm-7 col-xs-12 form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> N° Ticket:</label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input type="text" id="n_ticket2" name="n_ticket2"  class="form-control" placeholder="0000000000"   readonly="true">
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> Importe:</label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input type="text" id="importe2" name="importe2"  class="form-control" placeholder="0000000000"   readonly="true">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> T.Pago:</label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <select  class="form-control"   id="tipo_pago2" name="tipo_pago2" data-size="5" style="max-width: 100%!important;" >
                                                        
                                                        <?php foreach($forma_pago3 as $p):?>
                                                            <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre'];  ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12"> Referencia:</label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input type="number" id="referencia2" name="referencia2"  style="color:black; font-weight: bold; font-size:20px;" class="form-control" placeholder="0000" >
                                                    </div>
                                                </div>
                                               
                                              
                                               
                                            </div>
                                        </div>
                           
                                 
                        
                        </div>
                        <!--------------------------------------------------------------------------------->
                       
                       
                        <!--------------------------------------------------------------------------------->
                        <div class="ln_solid"></div>
                        <div id="result2"></div>
                        <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <button id="save_data2" type="submit" class="btn btn-success">Actualizar</button>
                                       
                                    </div>
                                   
                                </div>
                        </div>    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"> </i> Cerrar</button>
                    
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
		

     
    