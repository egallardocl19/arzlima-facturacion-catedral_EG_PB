
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
    $banco =mysqli_query($con, "SELECT * from banco where id>1 and idestado_dato=1");
    $banco_cuenta =mysqli_query($con, "SELECT * from banco_cuenta where id>1 and idestado_dato=1");
    $colorheder="info"; //COLOR  CABECERA MODAL
    $fechahoy=date("Y-m-d"); 
    $Mes = date("m");  
    $forma_pago=mysqli_query($con, "SELECT * FROM formapago where idestado_dato=1 and id=6");
    
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
                    
                            include("modal/mantenimiento_cobranza.php");
                            //include("modal/new_recibos_antiguos_impresion.php");?php echo mysqli_num_rows($info0) 

                            ?>

                            <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $titulo; ?> Efectivo : </h2>
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
                                                    <input type="date" id="q1" name="q1" class="form-control" value="<?php echo $fechahoy ?>" >
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

                            <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $titulo; ?> Deposito : </h2>
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

                                                    <label for="qq" class="control-label col-md-1 col-sm-1 col-xs-12">Busqueda </label>
                                                    <div class="col-md-2 col-sm-3 col-xs-12">
                                                        <input type="text" class="form-control" id="qq" name="qq" placeholder="N° Ticket" ><!--//onkeyup='load(1);'-->
                                                    </div>

                                                    <label  for="qq1" class="control-label col-md-1 col-sm-2 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Periodo:<span class="required"></span>
                                                    </label>
                                                    <div class="col-md-2 col-sm-3 col-xs-12">
                                                    <input type="date" id="qq1" name="qq1" class="form-control" value="<?php echo $fechahoy ?>" >
                                                    </div>
                                                  
                                                
                                                    <div class="col-md-2 col-sm-3 col-xs-12">                                                   
                                                            <button type="button" class="btn btn-warning" onclick='load2(1);'>
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
                                                <div id="resultados2"></div><!--Carga los datos ajax -->
                                                <div class='outer_div2'></div><!-- Carga los datos ajax -->
                                                <!-- /ajax -->
                                            </div>
                                        </div>                            
                                                               
                            </div>

                            <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $titulo; ?> Izipay : </h2>
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

                                                    <label for="qqq" class="control-label col-md-1 col-sm-1 col-xs-12">Busqueda </label>
                                                    <div class="col-md-2 col-sm-3 col-xs-12">
                                                        <input type="text" class="form-control" id="qqq" name="qqq" placeholder="N° Ticket" ><!--//onkeyup='load(1);'-->
                                                    </div>

                                                    <label  for="qqq1" class="control-label col-md-1 col-sm-2 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Periodo:<span class="required"></span>
                                                    </label>
                                                    <div class="col-md-2 col-sm-3 col-xs-12">
                                                    <input type="date" id="qqq1" name="qqq1" class="form-control" value="<?php echo $fechahoy ?>" >
                                                    </div>
                                                  
                                                
                                                    <div class="col-md-2 col-sm-3 col-xs-12">                                                   
                                                            <button type="button" class="btn btn-warning" onclick='load3(1);'>
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
                                                <div id="resultados3"></div><!--Carga los datos ajax -->
                                                <div class='outer_div3'></div><!-- Carga los datos ajax -->
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

<script type="text/javascript" src="js/recibos_cobranza.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>

<script>

    $( "#add" ).submit(function( event ) {
    var parametros = $(this).serialize();
        $.ajax({
                type: "POST",
                url: "action/mantenimiento_cobranza.php",
                data: parametros,
                beforeSend: function(objeto){
                    $("#result").show();
                    $("#result").html("Mensaje: Cargando...");
                },
                success: function(datos){
                $("#result").html(datos);
                $('#save_data').attr("disabled", false);
                load(1);
                load2(1);
                load3(1);
            }
        });
    
    event.preventDefault();
    })

       function limpiarFormulario() {
        document.getElementById("add").reset();
        $('#idticket').val(0).addClass("selectpicker").selectpicker('refresh'); 
        $('#tipo_pago').val(4).addClass("selectpicker").selectpicker('refresh');                 
        $("#result").hide(); 
        condicion = 1;
                            caso = "3";
                            $.post("includes/getRecibo_html.php", { caso: caso, condicion: condicion}, function(data){
                                $("#idticket").html(data).addClass("selectpicker").selectpicker('refresh');      

                           
                                                                       
                            });   
        }

        function buscarcobranza() {
        //document.getElementById("add").reset();
        //$('#idticket').val(0).addClass("selectpicker").selectpicker('refresh'); 
        //$('#tipo_pago').val(4).addClass("selectpicker").selectpicker('refresh');                 
        condicion=$("#fecha").val(); 
        //condicion = 1;
                            caso = "4";
                            $.post("includes/getRecibo_val.php", { caso: caso, condicion: condicion}, function(data){
                                $("#monto_total_ticket").val(data);      
                                    
                            });   
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
            document.getElementById("cobra").style.display = "block";
            document.getElementById("cobra2").style.display = "none";
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
           
            $("#dni").prop("readonly",true);
             $("#razon_social").prop("readonly",true);
             $("#fecha_inicio").prop("readonly",true);
             $("#direccion").prop("readonly",true);
             $("#cantidad").prop("readonly",true);
             $("#result").hide();
             //$("#n_pago").prop("readonly",true);
             document.getElementById("recibo_contable").style.display = "none";
             document.getElementById("detalle_notas").style.display = "none";
            }); 
           
            
            
        //OBTENER DATOS PARA IMPRIMIR RECIBO
         function obtener_datos(id){
            document.getElementById("cobra").style.display = "none";
            document.getElementById("save_data").style.display = "none";
            document.getElementById("nuevo").style.display = "none";
            document.getElementById("cobra2").style.display = "block";
            var titulo = '<?=$titulo?>';
            document.getElementById('myModalLabel').innerHTML= '<strong><i class="fa fa-search" aria-hidden="true"></i> '+titulo+'</strong>';
              var ticket = $("#ticket"+id).val();  //
              var importe = $("#importe"+id).val();  //
              var fecha = $("#fecha"+id).val();  //
              var n_deposito = $("#n_deposito"+id).val();  //
              var observaciones = $("#observaciones"+id).val();  //
               
            //  var total = $("#total"+id_cod).val();    //
            //  var anio = $("#anio"+id_cod).val();//
            //  var mes = $("#mes"+id_cod).val();//
            //  var fecha_recibo = $("#fecha_recibo"+id_cod).val();//
            //  var fecha_vencimiento = $("#fecha_vencimiento"+id_cod).val();//
            //  var inquilino = $("#inquilino"+id_cod).val();//
            //  var inmueble = $("#inmueble"+id_cod).val();   //
            //  var tipo_moneda = $("#tipo_moneda"+id_cod).val();    //
            //  var observacion = $("#observacion"+id_cod).val();//

              $("#ticket_pagado").val(ticket); 
              $("#monto_total_ticket").val(importe); 
              $("#fecha2").val(fecha); 
              $("#n_operacion").val(n_deposito); 
              $("#observaciones").val(observaciones); 
            //  $('#tipo_recibo').val(tipo_recibo).addClass("selectpicker").selectpicker('refresh');
            //  $("#codigo_recibo").val(codigo_recibo); 
            //  $("#anio").val(anio);
            //  $('#mes').val(mes).addClass("selectpicker").selectpicker('refresh');
             
            //  $("#fecha_inicio").val(fecha_recibo);
            //  $("#fecha_vencimiento").val(fecha_vencimiento);
           
           
            //  $("#arbitrios").val(arbitrios);   
            //  document.getElementById('monto_total').innerHTML= total;                                                  
            //  $("#observaciones").val(observacion);
            //  $("#observaciones").prop("readonly",true);
            //  $("#importe").prop("readonly",true);
            //  $("#arbitrios").prop("readonly",true);
            //  $("#anio").prop("readonly",true);
            //  $("#valor_mantenimiento").val(0);  
            //  $("#result").hide();
           
        
            
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