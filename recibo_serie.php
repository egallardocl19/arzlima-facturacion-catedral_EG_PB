
<link  rel="icon"   href="images/favicon.png" type="image/png" />
<?php
    $title ="Recibo Serie | ";
    include "head.php";
    include "sidebaradmin.php";
    $estado =mysqli_query($con, "select * from estado_dato");
    $tipo_administrado =mysqli_query($con, "select * from tipo_administrado where idestado_dato=1");
    $tipo_recibo =mysqli_query($con, "select * from recibos_tipos where idestado_dato=1");
    $submodulo =mysqli_query($con, "SELECT ss.idsubmodulo as idsubmodulo , ss.nombre as submodulo, sm.nombre as modulo 
    FROM seguridad_submodulo ss, seguridad_modulo sm where ss.idmodulo=sm.idmodulo order by modulo,submodulo"); 
    $producto =mysqli_query($con, "SELECT * FROM recibos_producto");
    $colorheder="info"; //COLOR  CABECERA MODAL
    $anio = date("Y");

    if (empty($_GET['key1'])){
        $key1='1';
      }else{
          $key1=$_GET['key1'];
      }  
  
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
                    
                       
                       include("modal/mantenimiento_recibos_serie.php");
                    
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Recibos Serie:</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                        <!-- form search -->
                        <form class="form-horizontal" role="form" id="category_expence" onsubmit="return false;">
                            <div class="form-group row">
                                <label for="q" class="col-md-2 control-label">Busqueda </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Serie" onkeyup='load(1);'>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-warning" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                    <span id="loader"></span>
                                </div>
                            </div>
                        </form>    
                        <!-- end form search -->

                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

<?php include "footer.php" ?>
<script type="text/javascript" src="js/recibos_serie.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>
    // SCRIPT PARA MANDAR DATOS AL PA INSERT-UPDATE
$( "#add" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/mantenimiento_recibos_serie.php",
            data: parametros,
             beforeSend: function(objeto){
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


// OBTENER DATOS CON EL BOTON EDITAR
function obtener_datos(codigo){
            var abrev = $("#abrev"+codigo).val();
  			var idtipo_administrado = $("#idtipo_administrado"+codigo).val();    
            var idrecibos_tipos = $("#idrecibos_tipos"+codigo).val();    
            var serial = $("#serial"+codigo).val();    
            var activo = $("#activo"+codigo).val();    
            var anio = $("#anio"+codigo).val();
            var idsubmodulo = $("#idsubmodulo"+codigo).val();   
            var idrecibo_producto = $("#idrecibo_producto"+codigo).val();    
            var observaciones = $("#observaciones"+codigo).val();
            $("#codigo").val(codigo);    
            $("#valor_mantenimiento").val("2");    
            $("#idserie_sistema").val(abrev);
            $('#idtipoadministrado').val(idtipo_administrado).addClass("selectpicker").selectpicker('refresh'); 
            $('#idtiporecibo').val(idrecibos_tipos).addClass("selectpicker").selectpicker('refresh'); 
            $("#idserie_recibo").val(serial);
            $("#idestado").val(activo).addClass("selectpicker").selectpicker('refresh'); 
            $("#anio").val(anio);
            $("#idsubmodulo").val(idsubmodulo).addClass("selectpicker").selectpicker('refresh'); 
            $("#idproducto").val(idrecibo_producto).addClass("selectpicker").selectpicker('refresh'); 
            document.getElementById('myModalLabel').innerHTML= '<strong><i class="fa fa-cubes" aria-hidden="true"></i> Editar Serie Recibo</strong>';
            var permiso_editar = '<?=$permiso_editar?>';
            if (permiso_editar == 1){
                document.getElementById("save_data").style.display = "block";
                document.getElementById('save_data').innerHTML= '<i class="glyphicon glyphicon-ok"> </i> Actualizar'; 
            }else{
                document.getElementById("save_data").style.display = "none";
            }
            $("#idserie_sistema").prop("readonly",true);
            $("#idserie_recibo").prop("readonly",true);
}
   
</script>
<!-- CAMPO POR DEFAULT AL INICIAR BOTON AGREGAR -->
<script language="javascript">
            let input = document.getElementById('tipo_mantenimiento');
            input.addEventListener('click', function(){
            document.getElementById('myModalLabel').innerHTML= '<strong><i class="fa fa-cubes" aria-hidden="true"></i> Agregar Serie Recibo</strong>';
            $("#codigo").val(0);    
            $("#valor_mantenimiento").val("1");    
            $("#idserie_recibo").val("");
            $("#idserie_sistema").val("");
            $("#idtipoadministrado").val(0).addClass("selectpicker").selectpicker('refresh'); 
            $("#idtiporecibo").val(0).addClass("selectpicker").selectpicker('refresh'); 
            $("#idestado").val(1).addClass("selectpicker").selectpicker('refresh'); 
            $("#idsubmodulo").val(0).addClass("selectpicker").selectpicker('refresh'); 
            $("#idproducto").val(0).addClass("selectpicker").selectpicker('refresh'); 
            var permiso_crear = '<?=$permiso_crear?>';
            if (permiso_crear == 1){
            document.getElementById("save_data").style.display = "block";
            document.getElementById('save_data').innerHTML= '<i class="glyphicon glyphicon-ok"> </i> Guardar'; 
            }else{
                document.getElementById("save_data").style.display = "none";
            }
            $("#idserie_sistema").prop("readonly",false);
            $("#idserie_recibo").prop("readonly",false);

            });  
                   
</script> 
<!--BUSQUEDA EN EL LISTADO CON LA TECLA ENTER  -->
<script language="javascript">
            let input = document.getElementById('q');
            input.addEventListener('focus', function(){
                document.onkeydown = function(e){
                    var ev = document.all ? window.event : e;
                    if(ev.keyCode==13) {
                      load(1);

                    }
                }

            })
                    
</script>
<?php 
    }else{

        include "informacion.php";
        
    }
}else{

    include "informacion.php";
    
}
    ?><?php