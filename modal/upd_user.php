



    <div class="modal fade bs-example-modal-lg-upd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><strong><i class="fa fa-users"></i> Editar Usuario</strong></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" id="upd_user" name="upd_user">
                        <div id="result_user2"></div>
                        <input type="hidden" id="mod_id" name="mod_id">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="mod_dni" id="mod_dni" type="text" class="form-control has-feedback-left" maxlength="8" placeholder="Dni">
                                <span class="fa fa-flickr form-control-feedback left" aria-hidden="true"></span>
                        </div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="mod_celular" id="mod_celular" type="text" class="form-control" maxlength="9" placeholder="Celular">
                                <span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
                        </div>
						
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input name="mod_name" id="mod_name" type="text" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Nombre y Apellido">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
						
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input name="mod_email" id="mod_email" type="text" class="form-control has-feedback-left" required placeholder="Email">
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                      
                        
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input id="mod_username" name="mod_username" type="text" class="form-control has-feedback-left" placeholder="Nombre Usuario"   onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <select class="form-control" id="mod_status" name="mod_status" <?php if ($idroles==$grupo1) {?><?php }else {?>disabled<?php } ?> >
                                    <option value="" selected>-- Selecciona estado --</option>
									<?php foreach($estado as $p):?>
									<option value="<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></option>
									<?php endforeach; ?>
                                </select>
                        </div>
                      
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Contraseña<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12">
                                <p class="text-muted">La contraseña solo se modificara si escribes algo, en caso contrario no se modifica.</p>
                            </div>
                        </div>
						
						<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="mod_ruc" id="mod_ruc" type="text" class="form-control has-feedback-left" maxlength="11" placeholder="Ruc">
                                <span class="fa fa-university form-control-feedback left" aria-hidden="true"></span>
                        </div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="mod_razon" id="mod_razon" type="text" class="form-control" placeholder="Razón Social" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <span class="fa fa-university form-control-feedback right" aria-hidden="true"></span>
                        </div>
						
						<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input name="mod_direccion" id="mod_direccion" type="text" class="form-control has-feedback-left" placeholder="Dirección" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <span class="fa fa-map form-control-feedback left" aria-hidden="true"></span>
                        </div>
						</div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                              <button id="upd_data" type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"> </i> Actualizar</button>
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