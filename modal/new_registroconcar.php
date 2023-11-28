<?php
    $rutalocal='../syscatedral/report/reporte_concar_venta.php';
    $rutalocal2='../syscatedral/report/reporte_concar_venta_excel.php';
    $rutaserver='../report/reporte_concar_venta.php';
    $rutaserver2='../report/reporte_concar_venta_excel.php';

    $Anio = date("Y"); 
    $Mes = date("m"); 
    $colorheder="info"; //COLOR  CABECERA MODAL
?> 

    <!--<div>  Modal 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-addrecibo"><i class="fa fa-plus-circle"></i> Agregar Contrato</button>
    </div>-->
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
                        
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha:<span class="required"></span>
                                </label>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="date" id="fecha" name="fecha" class="form-control" placeholder="Fecha Inicio" >
                                </div>

                            </div>   

                            <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-suitcase" aria-hidden="true"></i> Año: <span class="required"></span></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="number" id="anio" name="anio" step="any" class="form-control" placeholder="0000" >
                                </div>
                            </div>

                           
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><i class="fa fa-tag" aria-hidden="true"></i> Mes:
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="mes" name="mes" data-size="5" style="max-width: 100%!important;" >
                                <option value="" >-- Selecciona Mes --</option>
                                        <option value="01"  >Enero</option>
                                        <option value="02"  >Febrero</option>  
                                        <option value="03"  >Marzo</option>  
                                        <option value="04"  >Abril</option>  
                                        <option value="05"  >Mayo</option>  
                                        <option value="06"  >Junio</option>  
                                        <option value="07"  >Julio</option>  
                                        <option value="08"  >Agosto</option>  
                                        <option value="09"  >Septiembre</option>  
                                        <option value="10"  >Octubre</option>  
                                        <option value="11"  >Noviembre</option>  
                                        <option value="12"  >Diciembre</option>  
                                </select>
                                </div>
                            </div> -->
                            
                        

                        </div>

                       

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button id="save_data_registroconcar" type="submit" class="btn btn-primary" ><i class="fa fa-file-pdf-o"> </i> Generar Registros</button>
                            
                            <button class="btn btn-success" name="export2" formaction="<?php echo $rutalocal2 ?>"><span class="fa fa-file-excel-o"></span> Exportar a Excel</button>
                         
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
