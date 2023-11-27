
<link  rel="icon"   href="images/favicon.png" type="image/png" />
<?php
    $title ="Permisos User | ";
    include "head.php";
    include "sidebaradmin.php";
    $modulo =mysqli_query($con, "SELECT * from seguridad_modulo");
    $usuario =mysqli_query($con, "SELECT id,nombre,email FROM user where idestado=1 order by nombre");
    $submodulo =mysqli_query($con, "SELECT ss.idsubmodulo as id,sm.nombre as modulo,ss.nombre as submodulo 
    FROM seguridad_submodulo ss,seguridad_modulo sm where ss.idmodulo=sm.idmodulo and ss.idestado_dato=1
    ORDER BY sm.nombre,ss.nombre"); 

     $colorheder="info"; //COLOR  CABECERA MODAL

     
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
                            include("modal/new_permisos.php");
                        }
                        $permiso_token->close();
                        $con->next_result();
                            include("modal/new_permisos_roles.php");

                            
                           
                            ?>

                            <div class="x_panel">
                            <div class="x_title">
                                <h2>SubModulos Permisos: </h2>
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
                                                        <input type="text" class="form-control" id="q" name="q" placeholder="Modulo - SubModulo" ><!--//onkeyup='load(1);'-->
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

<script type="text/javascript" src="js/permisos.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>
$( "#add" ).submit(function( event ) {
   
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/addpermisos.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").show();
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
            //$("#save_data").hide();
          }
    });
  event.preventDefault();
})


// success
$( "#add_rol" ).submit(function( event ) {
   
   $('#save_rol').attr("disabled", true);
   
  var parametros = $(this).serialize();
      $.ajax({
             type: "POST",
             url: "action/addpermisos_roles.php",
             data: parametros,
              beforeSend: function(objeto){
                 $("#result_rol").show();
                 $("#result_rol").html("Mensaje: Cargando...");
               },
             success: function(datos){
             $("#result_rol").html(datos);
             $('#save_rol').attr("disabled", false);
             load2(1,$("#idsubmodulo").val());
             //$("#save_data").hide();
           }
     });
   event.preventDefault();
 })



    function obtener_datos(id){
           
            $.post("includes/getPermisos_permisos.php", { idsubmodulo: id}, function(data){
			$("#idpermisos").html(data).addClass("selectpicker").selectpicker('refresh'); 
			});
              
            $.post("includes/getPermisos_submodulo.php", { idsubmodulo: id}, function(data){
			$("#idsubmodulo").html(data).addClass("selectpicker").selectpicker('refresh'); 
			});
          
        }

</script>

<script language="javascript">//VALIDAR TIPO DE DOCUMENTO IDENTIDAD Y EXTRAER DATOS DEL API
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
