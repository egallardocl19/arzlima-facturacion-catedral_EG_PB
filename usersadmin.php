<link  rel="icon"   href="images/favicon.png" type="image/png" />
<?php
    $title ="Usuarios | ";
    include "head.php"; 
    include "sidebaradmin.php";
    
    $estado =mysqli_query($con, "select * from estado_dato");
    $colorheder="info"; //COLOR  CABECERA MODAL
    
    $user=$_SESSION['user_id'];
        $consulta_codigo_user =mysqli_query($con,"SELECT idroles FROM user where id=$user");
       
                if (!$consulta_codigo_user||mysqli_num_rows($consulta_codigo_user)!=0){
                    if ($row = mysqli_fetch_array($consulta_codigo_user)){
                        $consulta_rol=$row['idroles']; 
                    }
                }
   
       
    
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
        ?><?php 
    
    
?>  
    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                      $permisos_validate->close();
                      $con->next_result();
                      $permiso_token =mysqli_query($con,"CALL permisos('$id','$key1','$tok1');");
                      if (!$permiso_token||mysqli_num_rows($permiso_token)!=0){
                        include("modal/new_user.php");
                      }
                      $permiso_token->close();
                      $con->next_result();
                        include("modal/upd_user.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">

                            <h2>Usuarios : <?php if ($idroles==$grupo1) {
                                            echo mysqli_num_rows($TicketData5);
                                            }else{ echo mysqli_num_rows($TicketData6);} ?></h2>
                                            
                                          
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <!-- form search -->
                        <form class="form-horizontal" role="form" id="datos_cotizacion" onsubmit="return false;">
                            <div class="form-group row">
                                <label for="q" class="col-md-2 control-label">Busqueda</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Nombre o Correo Electrónico" onkeyup='load(1);'>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-warning" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                    <!-- <span id="loader"></span> -->
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

<script type="text/javascript" src="<?php if ($idroles==$grupo1) {?>js/users2.js<?php }else {?>js/users.js<?php } ?>"></script>

<script>
$( "#add_user" ).submit(function( event ) {
    $('#save_data').attr("disabled", true);
  
    var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_user.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_user").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_user").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

// success

$( "#upd_user" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/upd_user.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_user2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_user2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

    function obtener_datos(id){
            var username = $("#username"+id).val();    
            var name = $("#name"+id).val();
            var email = $("#email"+id).val();
            var status = $("#status"+id).val();
			var dni = $("#dni"+id).val();
			var celular = $("#celular"+id).val();
			var ruc = $("#ruc"+id).val();
			var razon = $("#razon"+id).val();
			var direccion = $("#direccion"+id).val();
            var idroles = $("#idroles"+id).val();
           
            $("#mod_id").val(id);
            $("#mod_username").val(username);
            $("#mod_name").val(name);
            $("#mod_email").val(email);
            $("#mod_status").val(status);
			$("#mod_dni").val(dni);
            $("#mod_celular").val(celular);
            $("#mod_ruc").val(ruc);
			$("#mod_razon").val(razon);
            $("#mod_direccion").val(direccion);
            $("#mod_idroles").val(idroles);
           
        }
</script>
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