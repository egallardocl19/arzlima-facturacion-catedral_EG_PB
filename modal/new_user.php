
    <div> <!-- Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Usuario</button>
    </div>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><strong><i class="fa fa-users"></i> Agregar Usuario</strong></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" id="add_user" name="add_user">
						<div id="result_user"></div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="dni" type="text" class="form-control has-feedback-left" placeholder="Dni" maxlength="8">
                                <span class="fa fa-flickr form-control-feedback left" aria-hidden="true"></span>
                        </div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="celular" type="text" class="form-control" placeholder="Celular" maxlength="9">
                                <span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="name" required type="text" class="form-control has-feedback-left" placeholder="Nombre"  onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input name="lastname" type="text" class="form-control" placeholder="Apellidos" required  onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input name="email" type="text" class="form-control has-feedback-left" placeholder="Correo Electronico" required>
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>

                      

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input name="username" type="text" class="form-control has-feedback-left" placeholder="Usuario"  onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <select class="form-control" id="estado" name="estado"  >
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
                                <input type="password" id="password" name="password" required class="form-control col-md-7 col-xs-12" placeholder="**********">
                            </div>
                        </div>
						
						<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="ruc" type="text" class="form-control has-feedback-left" placeholder="Ruc" maxlength="11">
                                <span class="fa fa-university form-control-feedback left" aria-hidden="true"></span>
                        </div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input name="razon" type="text" class="form-control" placeholder="Razón Social" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <span class="fa fa-university form-control-feedback right" aria-hidden="true"></span>
                        </div>
						
						<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input name="direccion" type="text" class="form-control has-feedback-left" placeholder="Dirección" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <span class="fa fa-map form-control-feedback left" aria-hidden="true"></span>
                        </div>
						</div>
						
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                              <button id="save_data" type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"> </i> Guardar</button>
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