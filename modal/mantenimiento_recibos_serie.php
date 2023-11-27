    <?php
    
    $permiso_token =mysqli_query($con,"CALL permisos('$id','$key1','$tok1');");
    if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){
        
    ?>
    <div> <!-- Modal -->
        <button type="button" id="tipo_mantenimiento" class="btn btn-primary" data-toggle="modal" 
        data-target=".bs-example-modal-lg-add" ><i class="fa fa-plus-circle"></i> Agregar Serie Ticket</button>
    </div>
    <?php
    }
    $permiso_token->close(); 
    $con->next_result();
    ?>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><strong><i class="fa fa-cubes" aria-hidden="true"></i> Agregar Serie Ticket</strong></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add">
                    <input type="hidden" id="valor_mantenimiento" name="valor_mantenimiento">
                    <input type="hidden" id="codigo" name="codigo">
                    <div class="form-group">  
                           
                          

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-flag" aria-hidden="true"></i> Tipo Ticket:</label>
                                
                                <div class="col-md-8 col-sm-8 col-xs-12">

                                    <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="idtiporecibo"  name="idtiporecibo" data-size="5" style="max-width: 100%!important;" >
                                    <option value="">-- Seleccionar Tipo Recibo --</option>  		
                                    <?php foreach($tipo_recibo as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-building" aria-hidden="true"></i> Serie Ticket: <span class="required"></span></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="idserie_recibo" name="idserie_recibo" class="form-control" placeholder="Serie para recibos fisicos" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="5">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-building" aria-hidden="true"></i> Serie Sistema: <span class="required"></span></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text"  id="idserie_sistema" name="idserie_sistema" class="form-control" placeholder="Serie para sistema interno"  onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="5">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-flag" aria-hidden="true"></i> Estado Ticket:</label>
                                
                                <div class="col-md-8 col-sm-8 col-xs-12">

                                    <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="idestado"  name="idestado" data-size="5" style="max-width: 100%!important;" >
                                    		
                                    <?php foreach($estado as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-suitcase" aria-hidden="true"></i> Periodo: <span class="required"></span></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="number" id="anio" name="anio" class="form-control" placeholder="Periodo" value="<?php echo $anio;?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-flag" aria-hidden="true"></i> Sub-Modulo:</label>
                                
                                <div class="col-md-8 col-sm-8 col-xs-12">

                                    <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="idsubmodulo"  name="idsubmodulo" data-size="5" style="max-width: 100%!important;" >
                                    <option value="">-- Seleccionar SubModulo --</option>  
                                    <?php foreach($submodulo as $p):?>
                                        <option value="<?php echo $p['idsubmodulo']; ?>"><?php echo $p['modulo']." - ".$p['submodulo']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                </div>
                            </div>
                            
                           
                        
                        
						</div>

                        
                        <div class="ln_solid"></div>
                        <div id="result"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                          
                              <button id="save_data" name="save_data" type="submit" class="btn btn-success" ><i class="glyphicon glyphicon-ok"></i></button>

                            </div>
                        </div>    
                        </div>  
                    </form>
             
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"> </i> Cerrar</button>
                        </div>
                        </div>
            </div>   
        </div>
    </div> <!-- /Modal -->
    <script language="javascript">
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
       
                            
    </script>
		
    