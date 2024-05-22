
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
    $colortipo1="#F9E8C2";
    $colortipo2="#FAD7D7";
    $colortipo3="#ECFAD7";
    $colortipo4="#D7F9FA";
    $colortipo5="#D7E8FA";
    $colortipo6="#E4D7FA";
    $colortipo7="#FAD7F8";

    $tamaniocampo="-lg";
    $fechahoy=date("Y-m-d"); 
    $Mes = date("m");  
    $forma_pago=mysqli_query($con, "SELECT * FROM formapago where idestado_dato=1 AND id in(4,5)"); 

    $moneda=mysqli_query($con, "SELECT * FROM tipo_moneda");
             
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
                    
                            include("modal/mantenimiento_recibos_caja.php");
                            

                            ?>

                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $titulo; ?> : General </h2>
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
                                                        <input type="text" class="form-control" id="q" name="q" placeholder="Código Recibo - Fecha" ><!--//onkeyup='load(1);'-->
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

                        
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $titulo; ?> : Promocional</h2>
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
                                                        <input type="text" class="form-control" id="qq" name="qq" placeholder="Código Recibo - Fecha" ><!--//onkeyup='load(1);'-->
                                                    </div>
                                                  
                                                        <div class="col-mg-3 col-sm-3 col-xs-12">
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
                document.getElementById("nuevo").style.display = "block";
                load(1);
                load2(1);
            }
        });
    
    event.preventDefault();
    })

       
       function limpiarFormulario() {
        document.getElementById("add").reset();
     
        $('#tipo_pago').val(4).addClass("selectpicker").selectpicker('refresh');         
        $("#n_pago").prop("readonly",true);
        
        $("#result").hide(); 
        document.getElementById("nuevo").style.display = "none";
        }

       
       
                    
</script>
<!-- CAMPO POR DEFAULT AL INICIAR BOTON AGREGAR -->
<script language="javascript">
        var suma_monto=0;
        var suma_monto1=0;
        var suma_monto2=0;
        var suma_monto3=0;
        var suma_monto4=0;
        var suma_monto5=0;
        var suma_monto6=0;
        var suma_monto7=0;
        var suma_monto8=0;
        var importe1=0;
        var importe2=0;
        var importe3=0;
        var importe4=0;
        var importe5=0;
        var importe6=0;
        var importe7=0;
        var importe8=0;
         var clase1 = 1; //clas1
         var clase2 = 2; //clas2
         
  
            document.getElementById('q').addEventListener('focus', function(){
                document.onkeydown = function(e){
                    var ev = document.all ? window.event : e;
                    if(ev.keyCode==13) {
                      load(1);

                    }
                }

            })
           
            document.getElementById('agregar1').addEventListener('click', function(){
            document.getElementById("gp3").style.display = "block";
            document.getElementById("gp4").style.display = "block";
            document.getElementById("gp5").style.display = "block";
            document.getElementById("gp6").style.display = "block";
            document.getElementById("gp7").style.display = "block";
            document.getElementById("gp8").style.display = "block";
            document.getElementById("nuevo").style.display = "none";
            //document.getElementById("gp7").style.display = "block";
            // document.getElementById("ln3").style.display = "block";
            // document.getElementById("ln4").style.display = "block";
            document.getElementById("ln8").style.display = "block";
            document.getElementById('myModalLabel').innerHTML= '<strong><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Ticket General</strong>';
            var permiso_crear = '<?=$permiso_crear?>';
                if (permiso_crear == 1){
                document.getElementById("save_data").style.display = "block";
                document.getElementById('save_data').innerHTML= '<i class="glyphicon glyphicon-ok"> </i> Guardar'; 
                
                document.getElementById('nuevo').innerHTML= '<i class="glyphicon glyphicon-pencil"> </i> Nuevo'; 
                $("#codigo").val(0);   
                $("#valor_mantenimiento").val(1); 
                $("#clase").val(clase1);  
                }

                limpiarFormulario();
                $("#result").hide();
                $("#n_pago").prop("readonly",true);
                reset_montos();
                
               //LLENADO DE DATA
                $.post("includes/getRecibo_html.php", { caso: 5, condicion: clase1, tipo:1}, function(data){
                $("#serie").html(data).addClass("selectpicker").selectpicker('refresh');  
                });
              
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase1, tipo:1}, function(data){
                $("#idtipo1").html(data).addClass("selectpicker").selectpicker('refresh'); 
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo1").val()}, function(data){
                        importe1=data;
                    });          
                });

                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase1, tipo:2}, function(data){
                $("#idtipo2").html(data).addClass("selectpicker").selectpicker('refresh');              
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo2").val()}, function(data){
                        importe2=data;
                    }); 
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase1, tipo:3}, function(data){
                $("#idtipo3").html(data).addClass("selectpicker").selectpicker('refresh');            
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo3").val()}, function(data){
                        importe3=data;
                    });   
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase1, tipo:4}, function(data){
                $("#idtipo4").html(data).addClass("selectpicker").selectpicker('refresh');            
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo4").val()}, function(data){
                        importe4=data;
                    });   
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase1, tipo:9}, function(data){
                $("#idtipo5").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo5").val()}, function(data){
                        importe5=data;
                    });             
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase1, tipo:12}, function(data){
                $("#idtipo6").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo6").val()}, function(data){
                        importe6=data;
                    });             
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase1, tipo:5}, function(data){
                $("#idtipo7").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo7").val()}, function(data){
                        importe7=data;
                    });             
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase1, tipo:6}, function(data){
                $("#idtipo8").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo7").val()}, function(data){
                        importe8=data;
                    });             
                });
            }); 

            document.getElementById('agregar2').addEventListener('click', function(){
            document.getElementById("gp3").style.display = "none";
            document.getElementById("gp4").style.display = "none";
            document.getElementById("gp5").style.display = "none";
            document.getElementById("gp6").style.display = "none";
            document.getElementById("gp7").style.display = "none";
            document.getElementById("gp8").style.display = "none";
            document.getElementById("nuevo").style.display = "none";
            //document.getElementById("gp7").style.display = "none";
            // document.getElementById("ln3").style.display = "none";
            // document.getElementById("ln4").style.display = "none";
            //document.getElementById("ln7").style.display = "none";
            document.getElementById('myModalLabel').innerHTML= '<strong><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Ticket Promocional</strong>';
            var permiso_crear = '<?=$permiso_crear?>';
                if (permiso_crear == 1){
                document.getElementById("save_data").style.display = "block";
                document.getElementById('save_data').innerHTML= '<i class="glyphicon glyphicon-ok"> </i> Guardar'; 
                
                document.getElementById('nuevo').innerHTML= '<i class="glyphicon glyphicon-pencil"> </i> Nuevo'; 
                $("#codigo").val(0);   
                $("#valor_mantenimiento").val(1);  
                $("#clase").val(clase2);  
                }
                limpiarFormulario();
                $("#result").hide();
                $("#n_pago").prop("readonly",true);
                reset_montos();
               
                //LLENADO DE DATA
                $.post("includes/getRecibo_html.php", { caso: 5, condicion: clase2, tipo:1}, function(data){
                $("#serie").html(data).addClass("selectpicker").selectpicker('refresh');     
                });

                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase2, tipo:10}, function(data){
                $("#idtipo1").html(data).addClass("selectpicker").selectpicker('refresh');     
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo1").val()}, function(data){
                        importe1=data;
                    });              
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase2, tipo:11}, function(data){
                $("#idtipo2").html(data).addClass("selectpicker").selectpicker('refresh');    
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo2").val()}, function(data){
                        importe2=data;
                    });           
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase2, tipo:0}, function(data){
                $("#idtipo3").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo3").val()}, function(data){
                        importe3=0;
                    });               
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase2, tipo:0}, function(data){
                $("#idtipo4").html(data).addClass("selectpicker").selectpicker('refresh');   
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo4").val()}, function(data){
                        importe4=0;
                    });            
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase2, tipo:0}, function(data){
                $("#idtipo5").html(data).addClass("selectpicker").selectpicker('refresh'); 
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo5").val()}, function(data){
                        importe5=0;
                    });                
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase2, tipo:0}, function(data){
                $("#idtipo6").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo6").val()}, function(data){
                        importe6=0;
                    });             
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase2, tipo:0}, function(data){
                $("#idtipo7").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo7").val()}, function(data){
                        importe7=data;
                    });             
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase2, tipo:0}, function(data){
                $("#idtipo8").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo8").val()}, function(data){
                        importe8=data;
                    });             
                });

            }); 

           
           
    </script> 
    <script language="javascript">
    function reset_montos() {
            suma_monto=0;
            suma_monto1=0;
            suma_monto2=0;
            suma_monto3=0;
            suma_monto4=0;
            suma_monto5=0;
            suma_monto6=0;
            suma_monto7=0;
            suma_monto8=0;
            importe1=0;
            importe2=0;
            importe3=0;
            importe4=0;
            importe5=0;
            importe6=0;
            importe7=0;
            importe8=0;
    }
    </script> 
    <script language="javascript">
    function cal1() {
           $importe1=importe1;
           $cantidad1=$("#cantidad1").val();
                       
                       if ($cantidad1==''){
                          $cantidad1=0;
                       
                       }else{
                          $cantidad1=parseFloat($cantidad1);
                       }
                       if ($importe1==''){
                          $importe1=0;
                       }else{
                          $importe1=parseFloat($importe1);
                       }
                       $valor_total1=($importe1*$cantidad1);
                       suma_monto1= $valor_total1;                 
                       $("#monto_total1").val($valor_total1.toFixed(2));
                      suma_monto=suma_monto1+suma_monto2+suma_monto3+suma_monto4+suma_monto5+suma_monto6+suma_monto7+suma_monto8;
                      $("#monto_totalx").val(suma_monto.toFixed(2));
          
    }
    function cal2() {
        $importe2=importe2;
         $cantidad2=$("#cantidad2").val();
                         
                          if ($cantidad2==''){
                             $cantidad2=0;
                            
                          }else{
                             $cantidad2=parseFloat($cantidad2);
                          }
                          if ($importe2==''){
                             $importe2=0;
                          }else{
                             $importe2=parseFloat($importe2);
                          }
                          $valor_total2=($importe2*$cantidad2);
                          suma_monto2= $valor_total2;      
                          $("#monto_total2").val($valor_total2.toFixed(2));
                         suma_monto=suma_monto1+suma_monto2+suma_monto3+suma_monto4+suma_monto5+suma_monto6+suma_monto7+suma_monto8;
                         $("#monto_totalx").val(suma_monto.toFixed(2));
    }
    function cal3() {
        $importe3=importe3;
        $cantidad3=$("#cantidad3").val();
                        
                          if ($cantidad3==''){
                             $cantidad3=0;
                          }else{
                             $cantidad3=parseFloat($cantidad3);
                          }
                          if ($importe3==''){
                             $importe3=0;
                          }else{
                             $importe3=parseFloat($importe3);
                          }
                          $valor_total3=($importe3*$cantidad3);
                          suma_monto3= $valor_total3; 
                          $("#monto_total3").val($valor_total3.toFixed(2));
                         suma_monto=suma_monto1+suma_monto2+suma_monto3+suma_monto4+suma_monto5+suma_monto6+suma_monto7+suma_monto8;
                         $("#monto_totalx").val(suma_monto.toFixed(2));
    }
    function cal4() {
        $importe4=importe4;
         $cantidad4=$("#cantidad4").val();
                        
                          if ($cantidad4==''){
                             $cantidad4=0;
                          }else{
                             $cantidad4=parseFloat($cantidad4);
                          }
                          if ($importe4==''){
                             $importe4=0;
                          }else{
                             $importe4=parseFloat($importe4);
                          }
                          $valor_total4=($importe4*$cantidad4);
                          suma_monto4= $valor_total4; 
                          $("#monto_total4").val($valor_total4.toFixed(2));
                         suma_monto=suma_monto1+suma_monto2+suma_monto3+suma_monto4+suma_monto5+suma_monto6+suma_monto7+suma_monto8;
                         $("#monto_totalx").val(suma_monto.toFixed(2));
    }
    function cal5() {
        $importe5=importe5;
        $cantidad5=$("#cantidad5").val();
                      
                          if ($cantidad5==''){
                             $cantidad5=0;
                          }else{
                             $cantidad5=parseFloat($cantidad5);
                          }
                          if ($importe5==''){
                             $importe5=0;
                          }else{
                             $importe5=parseFloat($importe5);
                          }
                          $valor_total5=($importe5*$cantidad5);
                          suma_monto5= $valor_total5; 
                          $("#monto_total5").val($valor_total5.toFixed(2));
                         suma_monto=suma_monto1+suma_monto2+suma_monto3+suma_monto4+suma_monto5+suma_monto6+suma_monto7+suma_monto8;
                         $("#monto_totalx").val(suma_monto.toFixed(2));
    }
    function cal6() {
        $importe6=importe6;
         $cantidad6=$("#cantidad6").val();
                      
                          if ($cantidad6==''){
                             $cantidad6=0;
                          }else{
                             $cantidad6=parseFloat($cantidad6);
                          }
                          if ($importe6==''){
                             $importe6=0;
                          }else{
                             $importe6=parseFloat($importe6);
                          }
                          $valor_total6=($importe6*$cantidad6);
                          suma_monto6= $valor_total6; 
                          $("#monto_total6").val($valor_total6.toFixed(2));
                         suma_monto=suma_monto1+suma_monto2+suma_monto3+suma_monto4+suma_monto5+suma_monto6+suma_monto7+suma_monto8;
                         $("#monto_totalx").val(suma_monto.toFixed(2));
    }
    function cal7() {
       $importe7=importe7;
         $cantidad7=$("#cantidad7").val();
                      
                          if ($cantidad7==''){
                             $cantidad7=0;
                          }else{
                             $cantidad7=parseFloat($cantidad7);
                          }
                          if ($importe7==''){
                             $importe7=0;
                          }else{
                             $importe7=parseFloat($importe7);
                          }
                          $valor_total7=($importe7*$cantidad7);
                          suma_monto7= $valor_total7; 
                          $("#monto_total7").val($valor_total7.toFixed(2));
                         suma_monto=suma_monto1+suma_monto2+suma_monto3+suma_monto4+suma_monto5+suma_monto6+suma_monto7+suma_monto8;
                         $("#monto_totalx").val(suma_monto.toFixed(2));
    }
    function cal8() {
       $importe8=importe8;
         $cantidad8=$("#cantidad8").val();
                      
                          if ($cantidad8==''){
                             $cantidad8=0;
                          }else{
                             $cantidad8=parseFloat($cantidad8);
                          }
                          if ($importe8==''){
                             $importe8=0;
                          }else{
                             $importe8=parseFloat($importe8);
                          }
                          $valor_total8=($importe8*$cantidad8);
                          suma_monto8= $valor_total8; 
                          $("#monto_total8").val($valor_total8.toFixed(2));
                         suma_monto=suma_monto1+suma_monto2+suma_monto3+suma_monto4+suma_monto5+suma_monto6+suma_monto7+suma_monto8;
                         $("#monto_totalx").val(suma_monto.toFixed(2));
    }
    </script> 

    <script language="javascript">
    function incrementar1() {
        var inputCantidad = document.getElementById("cantidad1");
        inputCantidad.value = parseInt(inputCantidad.value) + 1;
       cal1();
    }
    function incrementar2() {
        var inputCantidad = document.getElementById("cantidad2");
        inputCantidad.value = parseInt(inputCantidad.value) + 1;
        cal2();     
    }
    function incrementar3() {
        var inputCantidad = document.getElementById("cantidad3");
        inputCantidad.value = parseInt(inputCantidad.value) + 1;
        cal3();             
    }
    function incrementar4() {
        var inputCantidad = document.getElementById("cantidad4");
        inputCantidad.value = parseInt(inputCantidad.value) + 1;
        cal4();            
    }
    function incrementar5() {
        var inputCantidad = document.getElementById("cantidad5");
        inputCantidad.value = parseInt(inputCantidad.value) + 1;
        cal5(); 
    }
    function incrementar6() {
        var inputCantidad = document.getElementById("cantidad6");
        inputCantidad.value = parseInt(inputCantidad.value) + 1;
        cal6(); 
    }
    function incrementar7() {
        var inputCantidad = document.getElementById("cantidad7");
        inputCantidad.value = parseInt(inputCantidad.value) + 1;
        cal7(); 
    }
    function incrementar8() {
        var inputCantidad = document.getElementById("cantidad8");
        inputCantidad.value = parseInt(inputCantidad.value) + 1;
        cal8(); 
    }

    function decrementar1() {
        var inputCantidad = document.getElementById("cantidad1");
         if ((parseInt(inputCantidad.value) - 1)<0){
             inputCantidad.value==0;
         }else{
             inputCantidad.value = parseInt(inputCantidad.value) - 1;
         }
        cal1();
    }
    function decrementar2() {
        var inputCantidad = document.getElementById("cantidad2");
        if ((parseInt(inputCantidad.value) - 1)<0){
             inputCantidad.value==0;
         }else{
             inputCantidad.value = parseInt(inputCantidad.value) - 1;
         }
       cal2();
    }
    function decrementar3() {
        var inputCantidad = document.getElementById("cantidad3");
        if ((parseInt(inputCantidad.value) - 1)<0){
             inputCantidad.value==0;
         }else{
             inputCantidad.value = parseInt(inputCantidad.value) - 1;
         }
        cal3();
    }
    function decrementar4() {
        var inputCantidad = document.getElementById("cantidad4");
        if ((parseInt(inputCantidad.value) - 1)<0){
             inputCantidad.value==0;
         }else{
             inputCantidad.value = parseInt(inputCantidad.value) - 1;
         }
        cal4();
    }
    function decrementar5() {
        var inputCantidad = document.getElementById("cantidad5");
        if ((parseInt(inputCantidad.value) - 1)<0){
             inputCantidad.value==0;
         }else{
             inputCantidad.value = parseInt(inputCantidad.value) - 1;
         }
         cal5();
    }
    function decrementar6() {
        var inputCantidad = document.getElementById("cantidad6");
        if ((parseInt(inputCantidad.value) - 1)<0){
             inputCantidad.value==0;
         }else{
             inputCantidad.value = parseInt(inputCantidad.value) - 1;
         }
         cal6();
    }
    function decrementar7() {
        var inputCantidad = document.getElementById("cantidad7");
        if ((parseInt(inputCantidad.value) - 1)<0){
             inputCantidad.value==0;
         }else{
             inputCantidad.value = parseInt(inputCantidad.value) - 1;
         }
         cal7();
    }
    function decrementar8() {
        var inputCantidad = document.getElementById("cantidad8");
        if ((parseInt(inputCantidad.value) - 1)<0){
             inputCantidad.value==0;
         }else{
             inputCantidad.value = parseInt(inputCantidad.value) - 1;
         }
         cal8();
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