<?php
       
    $rutalocal='../syscatedral/report/reporte_ticket2.php';
    $rutalocal2='../syscatedral/report/reporte_ticket_excel2.php';
    $rutaserver='../report/reporte_ticket2.php';
    $rutaserver2='../report/reporte_ticket_excel2.php';
?> 

   
    <div class="modal fade bs-example-modal-lg-reporteticket2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-mg">
            <div class="modal-content"> 
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><strong><i class="fa fa-book" aria-hidden="true"></i> Reporte Resumen Ventas</strong></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="addreporte_propi" name="addreporte_propi" target="_blank">
                        <div id="resultreportepropi"></div>
                        
                        <div class="form-group">

                      

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha :<span class="required"></span>
                                </label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="date" name="fecha_inicio" class="form-control" placeholder="Fecha Inicio" value="<?php echo $fecha ?>" >
                                </div>

                            </div>   

                           

                            </div>
                        
                        <div class="ln_solid"></div>
                           
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                            <button id="save_data_reportepropi" type="submit" class="btn btn-primary"  formaction="<?php echo $rutaserver ?>" ><i class="fa fa-file-pdf-o"> </i> Generar Reporte</button>
                            
                            <!-- <button class="btn btn-success" name="export" formaction="<?php echo $rutalocal2 ?>"><span class="fa fa-file-excel-o"></span> Exportar a Excel</button> -->
                         
                            </div>
                        </div>    
                        </form>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"> </i> Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->
    <script language="javascript" src="js/jquery-3.1.1.min.js"></script>
    