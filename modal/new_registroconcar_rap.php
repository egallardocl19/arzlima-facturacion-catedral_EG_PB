<?php
   
    $administrado =mysqli_query($con, "select * from administrado");
    $Anio = date("Y"); 
    $Mes = date("m"); 
    $colorheder="info"; //COLOR  CABECERA MODAL
?> 

    <!--<div>  Modal 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-addrecibo"><i class="fa fa-plus-circle"></i> Agregar Contrato</button>
    </div>-->
    <div class="modal fade bs-example-modal-lg-registroconcarrap" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"> 
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><strong><i class="fa fa-book" aria-hidden="true"></i> Plantilla Contabilidad Concar</strong></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="addregistroconcar_prop" name="addregistroconcar_prop" ><!--target="_blank"-->
                        <div id="result_registroconcar_prop"></div>
                        
                        <div class="form-group">

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-suitcase" aria-hidden="true"></i> Año: <span class="required"></span></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="number" id="anio_rat" name="anio_rat" step="any" class="form-control" placeholder="0.00" value="<?php echo $Anio ?>">
                                </div>
                            </div>

                           
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><i class="fa fa-tag" aria-hidden="true"></i> Mes:
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="idmes_rat" name="idmes_rat" data-size="5" style="max-width: 100%!important;" >
                                <option value="" >-- Selecciona Mes --</option>
                                        <option value="01" <?php if ($Mes =="01") {?>selected<?php } ?> >Enero</option>
                                        <option value="02" <?php if ($Mes =="02") {?>selected<?php } ?> >Febrero</option>  
                                        <option value="03" <?php if ($Mes =="03") {?>selected<?php } ?> >Marzo</option>  
                                        <option value="04" <?php if ($Mes =="04") {?>selected<?php } ?> >Abril</option>  
                                        <option value="05" <?php if ($Mes =="05") {?>selected<?php } ?> >Mayo</option>  
                                        <option value="06" <?php if ($Mes =="06") {?>selected<?php } ?> >Junio</option>  
                                        <option value="07" <?php if ($Mes =="07") {?>selected<?php } ?> >Julio</option>  
                                        <option value="08" <?php if ($Mes =="08") {?>selected<?php } ?> >Agosto</option>  
                                        <option value="09" <?php if ($Mes =="09") {?>selected<?php } ?> >Septiembre</option>  
                                        <option value="10" <?php if ($Mes =="10") {?>selected<?php } ?> >Octubre</option>  
                                        <option value="11" <?php if ($Mes =="11") {?>selected<?php } ?> >Noviembre</option>  
                                        <option value="12" <?php if ($Mes =="12") {?>selected<?php } ?> >Diciembre</option>  
                                </select>
                                </div>
                            </div>
                            
                        

                        </div>

                       

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                            <button id="save_data_registroconcar2" type="submit" class="btn btn-primary" ><i class="fa fa-file-pdf-o"> </i> Generar Registros</button>
                            
                            <button class="btn btn-success" name="export" formaction="../inmuebles/report/reporte_consis_admin_excel.php"><span class="fa fa-file-excel-o"></span> Exportar a Excel</button>
                         
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
