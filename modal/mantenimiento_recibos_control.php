    <?php
     $rutalocal='../inmuebles/report/recibo_arrendamiento.php';
     $rutaserver='../report/recibo_arrendamiento.php';

    $permiso_token =mysqli_query($con,"CALL permisos('$id','$key1','$tok1');");
    if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){
        
    ?>
    <div> <!-- Modal -->
        <button type="button" id="agregar" class="btn btn-primary" data-toggle="modal" 
        data-target=".bs-example-modal-lg-add"  onclick="limpiarFormulario()"><i class="fa fa-plus-circle"></i> <?php echo  $titulo?></button>
    </div>
    <?php
    }
    $permiso_token->close();  
    $con->next_result();
    ?>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lm">
            <div class="modal-content">
                <div class="modal-header bg-<?php echo $colorheder ?> text-white" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" >
                    <input type="hidden" id="valor_mantenimiento" name="valor_mantenimiento">
                    <input type="hidden" id="codigo" name="codigo">
                    <div class="form-group">  
                    <div class="col-md-12">
                            <!--Iniciando la camara-->
                            <div class="contenedor_camara">
                            <div class="text-center" id="loadingMessage">
                                🎥 No se puede acceder a la transmisión de video (asegúrese de
                                tener una cámara web habilitada)
                            </div>
                            <canvas id="canvas" hidden></canvas>
                            <div class="mb-4" id="output" hidden>
                                <div id="outputMessage">Aún no se ha detectado código QR</div>
                                <div hidden>
                                <b>Código:</b> <span id="outputData"></span>
                                </div>
                            </div>
                            </div>
                            <!--fin-->
                        </div>
                        <div class="col-md-12 mb-12">
                            <div id="resultado">

                            </div>
                        </div>

                           
                            
                        </div>
 
                        <div id="result"></div>
                        
                        <div style="position: fixed;top: -60px;">
                            <audio controls id="sonido_qr" style="width: 0px !important;height: 0px !important;">
                            <source src="assets/sonido/beep.mp3" type="audio/mpeg">
                            </audio>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarFormulario()"><i class="glyphicon glyphicon-remove"> </i> Cerrar</button>
                    
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->
 
   
     <!-- ESCANER QR CON CAMARA--16/11/2023-->
     <script src="assets/js/jquery-3.1.1.min.js"></script> <!-- JQUERY -->
     <script src="assets/js/qr/jsQR.js"></script> <!-- inicio nueva librerias para escanear codigo qr -->
     <script src="assets/js/scanear_qr.js"></script>