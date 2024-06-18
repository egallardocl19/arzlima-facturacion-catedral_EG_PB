
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
    $tamaniocampo="-lg";
    $fechahoy=date("Y-m-d"); 
    $Mes = date("m");  
    $tipo_recibo=mysqli_query($con, "SELECT rs.abrev,rs.serial as serial,
    (select nombre from recibos_tipos where id=rs.idrecibos_tipos) as nombre FROM recibos_serial rs where idsubmodulo='$key1' and activo=1");
    $clase=mysqli_query($con, "SELECT * FROM clase_ticket where idestado_dato=1");
    $tipo_venta=mysqli_query($con, "SELECT * FROM tipo_venta where idestado_dato=1");
    $moneda=mysqli_query($con, "SELECT * FROM tipo_moneda");
    $ticket_motivos=mysqli_query($con, "SELECT * from ticket_motivos where idestado_dato=1 and id<>1");
                               
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
                    
                            include("modal/delete_ticket2.php");
                            //include("modal/new_recibos_antiguos_impresion.php");?php echo mysqli_num_rows($info0) 

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
                                                    <div class="col-md-2 col-sm-3 col-xs-12">
                                                        <input type="text" class="form-control" id="q" name="q" placeholder="N° Ticket" ><!--//onkeyup='load(1);'-->
                                                    </div>

                                                    <label  for="q1" class="control-label col-md-1 col-sm-2 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Periodo:<span class="required"></span>
                                                    </label>
                                                    <div class="col-md-2 col-sm-3 col-xs-12">
                                                    <input type="date" id="q1" name="q1" class="form-control"  >
                                                    </div>
                                                   
                                                
                                                    <div class="col-md-2 col-sm-3 col-xs-12">                                                   
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

<script type="text/javascript" src="js/recibos_seguimiento.js"></script>

<script type="text/javascript" src="js/VentanaCentrada.js"></script>


<!-- CAMPO POR DEFAULT AL INICIAR BOTON AGREGAR -->
<script language="javascript">
   
   $( "#del2" ).submit(function( event ) {
    var parametros = $(this).serialize();
        $.ajax({
                type: "POST",
                url: "action/del_ticket2.php",
                data: parametros,
                beforeSend: function(objeto){
                    $("#result2").show();
                    $("#result2").html("Mensaje: Cargando...");
                },
                success: function(datos){
                $("#result2").html(datos);
                $('#save_data').attr("disabled", false);
                load(1);
               
             
            }
        });
    
    event.preventDefault();
    })


            document.getElementById('q').addEventListener('focus', function(){
                document.onkeydown = function(e){
                    var ev = document.all ? window.event : e;
                    if(ev.keyCode==13) {
                      load(1);

                    }
                }

            })
           
            function obtener_datos(id){

              var idticket = $("#idticket"+id).val();  //
              var serie = $("#serie"+id).val();  //
              var numero = $("#numero"+id).val();  //
              var idmotivo = $("#idmotivo"+id).val();  //
              var fecha = $("#fecha"+id).val();  //
              var hora = $("#hora"+id).val();  //
              var cajero = $("#cajero"+id).val();  //
              var fecha_add = $("#fecha_add"+id).val();  //
              var hora_add = $("#hora_add"+id).val();  //

              $("#codigo").val(id); 
              $("#mod_id").val(idticket); 
              $("#n_ticket").val(serie+'-'+numero); 
              $("#idmotivo").val(idmotivo); 
              $("#fecha").val(fecha); 
              $("#hora").val(hora); 
              $("#cajero").val(cajero); 
              $("#fecha_solicitud").val(fecha_add); 
              $("#hora_solicitud").val(hora_add); 
              $("#estado").val(0); 
              $("#result2").hide();
         }  
            
            
                   
</script> 


<?php 
    }else{

        include "informacion.php";
        
    }
  }else{

        include "informacion.php";
        
    }
       
    ?><?php 