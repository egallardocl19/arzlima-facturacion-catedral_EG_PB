
<link  rel="icon"   href="images/favicon.png" type="image/png" />
<?php
    $title ="Recibos | ";
    include "head.php";
    include "sidebaradmin.php";

    //KEY
    if (empty($_GET['key1'])){
        $key1='1';
    }else{
        $key1=$_GET['key1'];
    }
    $_SESSION['keytok0']=$key1; 
   //NOMBRE CONTENEDOR
    $nombretitulo= mysqli_query($con, "SELECT max(observacion) as titulo from seguridad_submodulo where idsubmodulo='$key1'");
    if (!$nombretitulo||mysqli_num_rows($nombretitulo)!=0){
        while ($row1=$nombretitulo->fetch_assoc()) {
            $titulo=$row1['titulo'];
        }
        
    }else{
        $titulo= "";
    }

    //Variables
    $estado_pago =mysqli_query($con, "SELECT * from estado_pago where id=1");
    $colorheder="info"; //COLOR  CABECERA MODAL
    $fechahoy=date("Y-m-d"); 
    $Mes = date("m");  
    $forma_pago=mysqli_query($con, "SELECT * FROM formapago where idestado_dato=1");
    $clase=mysqli_query($con, "SELECT * FROM clase_ticket where idestado_dato=1 and id in(5)");
    //$tipo_venta=mysqli_query($con, "SELECT * FROM tipo_venta where idestado_dato=1");
    $moneda=mysqli_query($con, "SELECT * FROM tipo_moneda");

    //Conteos 
    //$info0=mysqli_query($con, "select * from recibos WHERE tipo_recibo in(select abrev from recibos_serial where idsubmodulo='$key1')"); //TOTAL
    //$info1=mysqli_query($con, "select * from recibos WHERE idestado_recibo=1 and tipo_recibo in(select abrev from recibos_serial where idsubmodulo='$key1')"); //PENDIENTE
    //$info2=mysqli_query($con, "select * from recibos WHERE idestado_recibo=2 and tipo_recibo in(select abrev from recibos_serial where idsubmodulo='$key1')"); //PAGADO
    //$info3=mysqli_query($con, "select * from recibos WHERE idestado_recibo=3 and tipo_recibo in(select abrev from recibos_serial where idsubmodulo='$key1')"); //ANULADO
    //$info4=mysqli_query($con, "select * from recibos WHERE idestado_recibo=4 and tipo_recibo in(select abrev from recibos_serial where idsubmodulo='$key1')"); //FRACCIONADO
                               
    //PERMISOS
      $submenu =mysqli_query($con,"CALL submenu('$id','0','$key1');");
      if (!$submenu||mysqli_num_rows($submenu)!=0){
       
          $submenu->close();
          $con->next_result();

      $permisos_validate =mysqli_query($con,"CALL permisos('$id','$key1','$tok0');");
      if (!$permisos_validate||mysqli_num_rows($permisos_validate)!=0){
          $_SESSION['keytok1']=$id; 
          $_SESSION['keytok2']=$key1; 
          $_SESSION['keytok3']=$tok2; 
          $_SESSION['keytok4']=$tok3; 
          $permisos_validate->close();
          $con->next_result();
          $permiso_token2 =mysqli_query($con,"CALL permisos('$id','$key1','$tok1');");
          if (!$permiso_token2||mysqli_num_rows($permiso_token2)!=0){
              $permiso_crear="1";
          }else{
              $permiso_crear="";
          }
          $permiso_token2->close();
          $con->next_result();
          $permiso_token3 =mysqli_query($con,"CALL permisos('$id','$key1','$tok2');");
          if (!$permiso_token3||mysqli_num_rows($permiso_token3)!=0){
              $permiso_editar="1";
          }else{
              $permiso_editar="";
          }
          $permiso_token3->close();
          $con->next_result();
      ?><?php 
      
         
?>
        
    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php
                    
                            include("modal/mantenimiento_recibos_producto.php");

                            ?>

                            <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $titulo; ?> : </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                                    </div>
                                        <!-- form search -->
                                        <form class="form-horizontal" role="form" id="category_expence"   onsubmit="return false;">
                                            <!--<div class="form-group">-->
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group"> 
                                                    <label for="q" class="control-label col-md-1 col-sm-1 col-xs-12">Busqueda </label>

                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                        <input type="text" class="form-control" id="q" name="q" placeholder="Código Recibo - Inquilino - Contrato - Fecha" ><!--//onkeyup='load(1);'-->
                                                    </div>
                                                  
                                                        <div class="col-mg-3 col-sm-3 col-xs-12">
                                                            <button type="button" class="btn btn-warning" onclick='load(1);'>
                                                                <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                                                <span id="loader"></span>
                                                        </div>
                                                </div>
                                                
                                            </div>
                                        </form> 
                                        
                                                                <!-- end form search -->
                                        <div class="x_content">
                                            <div class="table-responsive">
                                                <!-- ajax -->
                                                <div id="resultados"></div><!--Carga los datos ajax -->
                                                <div class='outer_div'></div><!-- Carga los datos ajax -->
                                                <!-- /ajax -->
                                            </div>
                                        </div>                            
                                                               
                            </div> 
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

<?php include "footer.php" ?>

<script type="text/javascript" src="js/recibos.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>

<script>
   

   
    $( "#add" ).submit(function( event ) {
    var parametros = $(this).serialize();
        $.ajax({
                type: "POST",
                url: "action/mantenimiento_recibos.php",
                data: parametros,
                beforeSend: function(objeto){
                    $("#result").show();
                    $("#result").html("Mensaje: Cargando...");
                },
                success: function(datos){
                $("#result").html(datos);
                $('#save_data').attr("disabled", false);
                load(1);
            }
        });
    
    event.preventDefault();
    })

       
       function limpiarFormulario() {
        document.getElementById("add").reset();
        $('#idclase').val(0).addClass("selectpicker").selectpicker('refresh'); 
        condicion = $('#idclase').val();
        $.post("includes/getRecibo_html.php", { caso: 1, condicion: condicion}, function(data){
        $("#idtipo").html(data).addClass("selectpicker").selectpicker('refresh');              
        }); 
        $.post("includes/getRecibo_html.php", { caso: 2, condicion: condicion}, function(data){
        $("#serie").html(data).addClass("selectpicker").selectpicker('refresh');              
        }); 
        $('#cantidad').val(1)
        $('#tipo_pago').val(4).addClass("selectpicker").selectpicker('refresh');         
        $("#n_pago").prop("readonly",true);
        
        $("#result").hide(); 
        }

                
</script>
<!-- CAMPO POR DEFAULT AL INICIAR BOTON AGREGAR -->
<script language="javascript">
   
            document.getElementById('q').addEventListener('focus', function(){
                document.onkeydown = function(e){
                    var ev = document.all ? window.event : e;
                    if(ev.keyCode==13) {
                      load(1);

                    }
                }

            })
           
            document.getElementById('agregar').addEventListener('click', function(){
            var titulo = '<?=$titulo?>';
            document.getElementById('myModalLabel').innerHTML= '<strong><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar '+titulo+'</strong>';
            
            var permiso_crear = '<?=$permiso_crear?>';
            if (permiso_crear == 1){
            document.getElementById("save_data").style.display = "block";
            document.getElementById('save_data').innerHTML= '<i class="glyphicon glyphicon-ok"> </i> Guardar'; 
            document.getElementById("nuevo").style.display = "block";
            document.getElementById('nuevo').innerHTML= '<i class="glyphicon glyphicon-pencil"> </i> Nuevo'; 
            $("#codigo").val(0);    
            $("#valor_mantenimiento").val(1);  
            }
           
             $("#result").hide();
             $("#n_pago").prop("readonly",true);
             document.getElementById("recibo_contable").style.display = "none";
             document.getElementById("detalle_notas").style.display = "none";
            }); 
           
            
            
                   
</script> 


<?php 
    }else{

        include "informacion.php";
        
    }
  }else{

        include "informacion.php";
        
    }
       
    ?><?php 