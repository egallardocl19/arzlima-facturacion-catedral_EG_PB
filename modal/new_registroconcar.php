<?php
  
    $Anio = date("Y"); 
    $Mes = date("m"); 

    $permiso_token =mysqli_query($con,"CALL permisos('$id','$key1','$tok1');");
    if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){
        
    ?>
    <div> <!-- Modal -->
        <button type="button" id="agregar" class="btn btn-primary" data-toggle="modal" 
        data-target=".bs-example-modal-lg-registroconcar"  onclick="limpiarFormulario()"><i class="fa fa-plus-circle"></i> Agregar <?php echo  $titulo?></button>
    </div>
    <?php
    }
    $permiso_token->close();  
    $con->next_result();
    ?>

   
    <div class="modal fade bs-example-modal-lg-registroconcar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lm">
            <div class="modal-content"> 
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><strong><i class="fa fa-book" aria-hidden="true"></i> Plantilla Contabilidad Concar</strong></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="addregistroconcar" name="addregistroconcar" target="_blank">
                        <div id="result1"></div>
                        
                        <div class="form-group">
                        
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> F. Inicio:<span class="required"></span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="date" id="fecha" name="fecha" class="form-control" placeholder="Fecha Inicio" >
                                </div>

                            </div>   
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> F. Fin:<span class="required"></span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="date" id="fecha2" name="fecha2" class="form-control" placeholder="Fecha Inicio" >
                                </div>

                            </div>  

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-5 col-sm-5 col-xs-12"><i class="fa fa-inbox" aria-hidden="true"></i> Último N° Comprobante: <span class="required"></span></label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" id="n_comprobante" name="n_comprobante" class="form-control" placeholder="Último N° Comprobante"  maxlength="10" >
                                </div>
                            </div>

                        </div>

                       

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                            <button id="save_data_registroconcar" type="submit" class="btn btn-success" ></button>
                            
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
