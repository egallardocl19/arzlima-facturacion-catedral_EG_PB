
    <div class="modal fade bs-example-modal-lg-addpermisos_roles" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><strong><i class="fa fa-book" aria-hidden="true"></i> Usuarios - Roles</strong></h4>
                </div>


                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add_rol" name="add_rol">
                        <div id="result_rol"></div> 
                            <input type="hidden" id="codigoxx" name="codigoxx">

                        <div class="form-group">

                                                        
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12"><i class="fa fa-user" aria-hidden="true"></i> Usuario:</label>
                                
                                <div class="col-md-10 col-sm-10 col-xs-12">

                                    <select  class="form-control selectpicker" data-show-subtext="true" data-live-search="true"  id="idusuario" name="idusuario" data-size="5" style="max-width: 100%!important;" >
                                    <option value="0">----Seleccionar Usuario----</option>  
                                    <?php foreach($usuario as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo 'USUARIO: '.$p['nombre'].' - CORREO: '.$p['email']; ?></option>
                                        <?php endforeach; ?>
                                    </select>	
                                
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12"><i class="fa fa-tag" aria-hidden="true"></i> Sub-Modulo:</label>
                                
                                <div class="col-md-10 col-sm-10 col-xs-12">

                                    <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"  id="idsubmodulo" name="idsubmodulo" data-size="5" style="max-width: 100%!important;" >
                                                                       
                                    </select>	
                                   
                                
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12"><i class="fa fa-sitemap" aria-hidden="true"></i> Permisos:</label>
                                
                                <div class="col-md-10 col-sm-10 col-xs-12">

                                    <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"  id="idpermisos" name="idpermisos" data-size="5" style="max-width: 100%!important;" >
                                    <option value="0">----Seleccionar Permisos----</option>
                                    
                                    
                                    </select>	
                                   
                                
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-10">
                                <?php
                                $permiso_token =mysqli_query($con,"CALL permisos('$id','$key1','$tok1');");
                                if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){
                                ?>
                                     <button id="save_rol" type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"> </i> Agregar Rol</button>
                                     <?php }
                                    $permiso_token->close();
                                    $con->next_result();
                                ?>
                                </div>
                            </div> 
                                                        
                        </div>
                       
                        <div class="ln_solid"></div> 
                        
                        <div class="form-group">  
                                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                                    
                                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><strong> Detalle de Roles</strong></h4>
                                </div>      
                                
                                <div role="tabpanel">
                                    
                                    <div class="tab-content"> 
                                        <div role="tabpanel" class="tab-pane active" id="seccion10">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                
                                                    <div class="table-responsive">
                                                    
                                                    <div id="resultados_roles"></div><!-- Carga los datos ajax --> 
                                                    <div class='outer_div_roles'></div><!-- Carga los datos ajax -->
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
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


		