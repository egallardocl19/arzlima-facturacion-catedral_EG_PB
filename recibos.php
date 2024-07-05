
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
    $ticket_motivos=mysqli_query($con, "SELECT * from ticket_motivos where idestado_dato=1 and id<>1");
    $agencia=mysqli_query($con, "SELECT id,dni_ruc,nombre FROM agencia where idestado_dato=1");
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
    $forma_pago=mysqli_query($con, "SELECT * FROM formapago where idestado_dato=1 AND id in(4,5,7)"); 
    $estado_recibo =mysqli_query($con, "SELECT * from estado_ticket");
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
                            include("modal/delete_ticket.php");
                            

                            ?>
                        <?php 
                          if ( $key1==2){

                          ?>
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $titulo; ?> :  </h2>
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

                                                    <label for="q" class="control-label col-md-1 col-sm-2 col-xs-12">Busqueda </label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                                        <input type="text" class="form-control" id="q" name="q" placeholder="N° Recibo - N° Pago" ><!--//onkeyup='load(1);'-->
                                                    </div>

                                                    <label  for="q1" class="control-label col-md-1 col-sm-2 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Periodo:<span class="required"></span>
                                                    </label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                                    <input type="date" id="q1" name="q1" class="form-control" value="<?php echo $fechahoy ?>" >
                                                    </div>
                                                  
                                                    <label  for="q2" class="control-label col-md-1 col-sm-2 col-xs-12"><i class="fa fa-bars" aria-hidden="true"></i> Estado:</label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">

                                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"  id="q2" name="q2" data-size="5" style="max-width: 100%!important;" >
                                                        <option value="">Seleccionar Estado</option>  
                                                        <?php foreach($estado_recibo as $p):?>
                                                            <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>	
                                                        </select>
                                                    
                                                    </div>
                                                
                                                    <div class="col-md-2 col-sm-4 col-xs-12">                                                   
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
                        <?php 
                        }
                        ?>

                        <?php 
                          if ( $key1==70){

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

                                                    <label for="qq" class="control-label col-md-1 col-sm-2 col-xs-12">Busqueda </label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                                        <input type="text" class="form-control" id="qq" name="qq" placeholder="N° Recibo - N° Pago" ><!--//onkeyup='load(1);'-->
                                                    </div>

                                                    <label  for="qq1" class="control-label col-md-1 col-sm-2 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Periodo:<span class="required"></span>
                                                    </label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                                    <input type="date" id="qq1" name="qq1" class="form-control" value="<?php echo $fechahoy ?>" >
                                                    </div>
                                                  
                                                    <label  for="qq2" class="control-label col-md-1 col-sm-2 col-xs-12"><i class="fa fa-bars" aria-hidden="true"></i> Estado:</label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">

                                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"  id="qq2" name="qq2" data-size="5" style="max-width: 100%!important;" >
                                                        <option value="">Seleccionar Estado</option>  
                                                        <?php foreach($estado_recibo as $p):?>
                                                            <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>	
                                                        </select>
                                                    
                                                    </div>
                                                
                                                    <div class="col-md-2 col-sm-4 col-xs-12">                                                   
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
                        <?php 
                        }
                        ?>
                         <?php 
                          if ( $key1==71){

                          ?>
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $titulo; ?> :  </h2>
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

                                                    <label for="qqq" class="control-label col-md-1 col-sm-2 col-xs-12">Busqueda </label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                                        <input type="text" class="form-control" id="qqq" name="qqq" placeholder="N° Recibo - N° Pago" ><!--//onkeyup='load(1);'-->
                                                    </div>

                                                    <label  for="qqq1" class="control-label col-md-1 col-sm-2 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Periodo:<span class="required"></span>
                                                    </label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                                    <input type="date" id="qqq1" name="qqq1" class="form-control" value="<?php echo $fechahoy ?>" >
                                                    </div>
                                                  
                                                    <label  for="qqq2" class="control-label col-md-1 col-sm-2 col-xs-12"><i class="fa fa-bars" aria-hidden="true"></i> Estado:</label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">

                                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"  id="qqq2" name="qqq2" data-size="5" style="max-width: 100%!important;" >
                                                        <option value="">Seleccionar Estado</option>  
                                                        <?php foreach($estado_recibo as $p):?>
                                                            <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>	
                                                        </select>
                                                    
                                                    </div>
                                                
                                                    <div class="col-md-2 col-sm-4 col-xs-12">                                                   
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
                        <?php 
                        }
                        ?>
<?php 
                          if ( $key1==74){

                          ?>
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $titulo; ?> :  </h2>
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

                                                    <label for="qqqq" class="control-label col-md-1 col-sm-2 col-xs-12">Busqueda </label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                                        <input type="text" class="form-control" id="qqqq" name="qqqq" placeholder="N° Recibo - N° Pago" ><!--//onkeyup='load(1);'-->
                                                    </div>

                                                    <label  for="qqqq1" class="control-label col-md-1 col-sm-2 col-xs-12"><i class="fa fa-calendar" aria-hidden="true"></i> Periodo:<span class="required"></span>
                                                    </label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                                    <input type="date" id="qqqq1" name="qqqq1" class="form-control" value="<?php echo $fechahoy ?>" >
                                                    </div>
                                                  
                                                    <label  for="qqqq2" class="control-label col-md-1 col-sm-2 col-xs-12"><i class="fa fa-bars" aria-hidden="true"></i> Estado:</label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12">

                                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"  id="qqqq2" name="qqqq2" data-size="5" style="max-width: 100%!important;" >
                                                        <option value="">Seleccionar Estado</option>  
                                                        <?php foreach($estado_recibo as $p):?>
                                                            <option value="<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>	
                                                        </select>
                                                    
                                                    </div>
                                                
                                                    <div class="col-md-2 col-sm-4 col-xs-12">                                                   
                                                            <button type="button" class="btn btn-warning" onclick='load4(1);'>
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
                                                <div id="resultados4"></div><!--Carga los datos ajax -->
                                                <div class='outer_div4'></div><!-- Carga los datos ajax -->
                                                <!-- /ajax -->
                                            </div>
                                        </div>                            
                                                               
                            </div> 
                        </div>
                        <?php 
                        }
                        ?>
                        
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
                load3(1);
                load4(1);
                reset_montos();
             
            }
        });
    
    event.preventDefault();
    })

    $( "#del" ).submit(function( event ) {
    var parametros = $(this).serialize();
        $.ajax({
                type: "POST",
                url: "action/del_ticket.php",
                data: parametros,
                beforeSend: function(objeto){
                    $("#result2").show();
                    $("#result2").html("Mensaje: Cargando...");
                },
                success: function(datos){
                $("#result2").html(datos);
                $('#save_data').attr("disabled", false);
                load(1);
                load2(1);
                load3(1);
                load4(1);
             
            }
        });
    
    event.preventDefault();
    })

       
       function limpiarFormulario() {
        document.getElementById("add").reset();
        document.getElementById("n_pago").style.background  = "";
        $('#tipo_pago2').val(4);         
        $("#n_pago").prop("readonly",true);
        
        $("#result").hide(); 
        document.getElementById("nuevo").style.display = "none";
        $('#agencia').addClass("selectpicker").selectpicker('refresh');   
        caso = "6";
        $.post("includes/getRecibo_html.php", { caso: caso, condicion: 0}, function(data){
        $("#guia").html(data).addClass("selectpicker").selectpicker('refresh');                                                                                                                                                                        
         }); 
        $('#idtipo1').addClass("selectpicker").selectpicker('refresh');   
        $('#idtipo2').addClass("selectpicker").selectpicker('refresh');   
        $('#idtipo3').addClass("selectpicker").selectpicker('refresh');   
        $('#idtipo4').addClass("selectpicker").selectpicker('refresh');   
        $('#idtipo5').addClass("selectpicker").selectpicker('refresh');   
        $('#idtipo6').addClass("selectpicker").selectpicker('refresh');   
        $('#idtipo7').addClass("selectpicker").selectpicker('refresh');   
        $('#idtipo8').addClass("selectpicker").selectpicker('refresh');   
        reset_montos();
        }

       
        function obtener_datos(id){
            var serie = $("#serie"+id).val();    
            var numero = $("#numero"+id).val();
            $("#mod_id").val(id);   
            $("#n_ticket").val(serie+'-'+numero);   
            $("#result2").hide();
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
         var clase3 = 3; //clas3
         var clase4 = 4; //clas4
         var clase5 = 5; //clas5
         var filt = '<?=$key1?>';
         
   

         if (filt == 2){
            document.getElementById('agregar1').addEventListener('click', function(){
            document.getElementById("gp3").style.display = "block";
            document.getElementById("gp4").style.display = "block";
            document.getElementById("gp5").style.display = "block";
            document.getElementById("gp6").style.display = "block";
            document.getElementById("gp7").style.display = "block";
            document.getElementById("gp8").style.display = "block";
            document.getElementById("gp9").style.display = "block";
            document.getElementById("gp10").style.display = "none";
            document.getElementById("nuevo").style.display = "none";
            reset_montos();
            //document.getElementById("gp7").style.display = "block";
            // document.getElementById("ln3").style.display = "block";
            // document.getElementById("ln4").style.display = "block";
            document.getElementById("ln8").style.display = "block";
            document.getElementById('myModalLabel').innerHTML= '<strong><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Ticket General</strong>';
            $("#fecha_inicio").prop("readonly",true);
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
                document.getElementById('cantidad1').style = "font-weight: bold; font-size:20px;";
             });  
    
                
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
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo8").val()}, function(data){
                        importe8=data;
                    });             
                });
           
        }
        if (filt == 70){
            document.getElementById('agregar2').addEventListener('click', function(){
            document.getElementById("gp3").style.display = "none";
            document.getElementById("gp4").style.display = "none";
            document.getElementById("gp5").style.display = "none";
            document.getElementById("gp6").style.display = "none";
            document.getElementById("gp7").style.display = "none";
            document.getElementById("gp8").style.display = "none";
            document.getElementById("gp9").style.display = "block";
            document.getElementById("gp10").style.display = "none";
            document.getElementById("nuevo").style.display = "none";
            reset_montos();
            //document.getElementById("gp7").style.display = "none";
            // document.getElementById("ln3").style.display = "none";
            // document.getElementById("ln4").style.display = "none";
            //document.getElementById("ln7").style.display = "none";
            document.getElementById('myModalLabel').innerHTML= '<strong><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Ticket Promocional</strong>';
            $("#fecha_inicio").prop("readonly",true);
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
                document.getElementById('cantidad1').style = "font-weight: bold; font-size:20px;";
            }); 
               
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
                        importe7=0;
                    });             
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase2, tipo:0}, function(data){
                $("#idtipo8").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo8").val()}, function(data){
                        importe8=0;
                    });             
                });

            
        }

        if (filt == 71){
            document.getElementById('agregar3').addEventListener('click', function(){
            document.getElementById("gp2").style.display = "none";
            document.getElementById("gp3").style.display = "none";
            document.getElementById("gp4").style.display = "none";
            document.getElementById("gp5").style.display = "none";
            document.getElementById("gp6").style.display = "none";
            document.getElementById("gp7").style.display = "none";
            document.getElementById("gp8").style.display = "none";
            document.getElementById("gp9").style.display = "none";
            document.getElementById("gp10").style.display = "block";
            document.getElementById("nuevo").style.display = "none";
            reset_montos();
            //document.getElementById("gp7").style.display = "none";
            // document.getElementById("ln3").style.display = "none";
            // document.getElementById("ln4").style.display = "none";
            //document.getElementById("ln7").style.display = "none";
            document.getElementById('myModalLabel').innerHTML= '<strong><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Ticket Crédito</strong>';
            $("#fecha_inicio").prop("readonly",false);
            var permiso_crear = '<?=$permiso_crear?>';
                if (permiso_crear == 1){
                document.getElementById("save_data").style.display = "none";
                document.getElementById('save_data').innerHTML= '<i class="glyphicon glyphicon-ok"> </i> Guardar'; 
                
                document.getElementById('nuevo').innerHTML= '<i class="glyphicon glyphicon-pencil"> </i> Nuevo'; 
                $("#codigo").val(0);   
                $("#valor_mantenimiento").val(1);  
                $("#clase").val(clase3);  
                }
                limpiarFormulario();
                $("#result").hide();
                $("#n_pago").prop("readonly",true);
                $("#cantidad1").prop("readonly",false);
                
                document.getElementById('cantidad1').style = "font-weight: bold; font-size:16px;";
                document.getElementById('cantidad1').style.boxShadow = "inset 0 0 5px black";  
               
            }); 

               
                //LLENADO DE DATA
                $.post("includes/getRecibo_html.php", { caso: 5, condicion: clase3, tipo:1}, function(data){
                $("#serie").html(data).addClass("selectpicker").selectpicker('refresh');     
                });

                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase3, tipo:7}, function(data){
                $("#idtipo1").html(data).addClass("selectpicker").selectpicker('refresh');     
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo1").val()}, function(data){
                        importe1=data;
                    });              
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase3, tipo:0}, function(data){
                $("#idtipo2").html(data).addClass("selectpicker").selectpicker('refresh');    
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo2").val()}, function(data){
                        importe2=0;
                    });           
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase3, tipo:0}, function(data){
                $("#idtipo3").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo3").val()}, function(data){
                        importe3=0;
                    });               
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase3, tipo:0}, function(data){
                $("#idtipo4").html(data).addClass("selectpicker").selectpicker('refresh');   
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo4").val()}, function(data){
                        importe4=0;
                    });            
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase3, tipo:0}, function(data){
                $("#idtipo5").html(data).addClass("selectpicker").selectpicker('refresh'); 
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo5").val()}, function(data){
                        importe5=0;
                    });                
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase3, tipo:0}, function(data){
                $("#idtipo6").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo6").val()}, function(data){
                        importe6=0;
                    });             
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase3, tipo:0}, function(data){
                $("#idtipo7").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo7").val()}, function(data){
                        importe7=0;
                    });             
                });
                $.post("includes/getRecibo_html.php", { caso: 4, condicion: clase3, tipo:0}, function(data){
                $("#idtipo8").html(data).addClass("selectpicker").selectpicker('refresh');  
                $.post("includes/getRecibo_val.php", { caso: 3, condicion: $("#idtipo8").val()}, function(data){
                        importe8=0;
                    });             
                });

            
        }

        if (filt == 74){
            document.getElementById('agregar4').addEventListener('click', function(){
            document.getElementById("gp3").style.display = "block";
            document.getElementById("gp4").style.display = "none";
            document.getElementById("gp5").style.display = "none";
            document.getElementById("gp6").style.display = "none";
            document.getElementById("gp7").style.display = "block";
            document.getElementById("gp8").style.display = "block";
            document.getElementById("gp9").style.display = "block";
            document.getElementById("gp10").style.display = "none";
            document.getElementById("nuevo").style.display = "none";
            reset_montos();
            //document.getElementById("gp7").style.display = "block";
            // document.getElementById("ln3").style.display = "block";
            // document.getElementById("ln4").style.display = "block";
            document.getElementById("ln8").style.display = "block";
            document.getElementById('myModalLabel').innerHTML= '<strong><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Ticket Producto</strong>';
            $("#fecha_inicio").prop("readonly",true);
            var permiso_crear = '<?=$permiso_crear?>';
                if (permiso_crear == 1){
                document.getElementById("save_data").style.display = "block";
                document.getElementById('save_data').innerHTML= '<i class="glyphicon glyphicon-ok"> </i> Guardar'; 
                
                document.getElementById('nuevo').innerHTML= '<i class="glyphicon glyphicon-pencil"> </i> Nuevo'; 
                $("#codigo").val(0);   
                $("#valor_mantenimiento").val(1); 
                $("#clase").val(clase5);  
                }

                limpiarFormulario();
                $("#result").hide();
                $("#n_pago").prop("readonly",true);
                document.getElementById('cantidad1').style = "font-weight: bold; font-size:20px;";
             });  
    
                
               //LLENADO DE DATA
                $.post("includes/getRecibo_html.php", { caso: 5, condicion: clase5, tipo:1}, function(data){
                $("#serie").html(data).addClass("selectpicker").selectpicker('refresh');  
                });
              
                $.post("includes/getRecibo_html.php", { caso: 7, condicion: clase5, tipo:1}, function(data){
                $("#idtipo1").html(data).addClass("selectpicker").selectpicker('refresh');        
                });

                $(document).ready(function(){
                    $("#idtipo1").change(function () {
                        $("#idtipo1 option:selected").each(function () {
                            condicion1 = $(this).val();
                            
                            if(condicion1==0){
                                importe1=0; 
                                $("#cantidad1").val(0);   
                                $("#monto_total1").val(0); 
                                global_cal();
                            }else{
                            $.post("includes/getRecibo_val.php", { caso: 3, condicion: condicion1}, function(data){
                                    importe1=data;                   
                            });  
                            }                        
                        });
                    })
                });      

                $.post("includes/getRecibo_html.php", { caso: 7, condicion: clase5, tipo:2}, function(data){
                $("#idtipo2").html(data).addClass("selectpicker").selectpicker('refresh');              
                });
                $(document).ready(function(){
                    $("#idtipo2").change(function () {
                        $("#idtipo2 option:selected").each(function () {
                            condicion2 = $(this).val();
                            
                            if(condicion2==0){
                                importe2=0; 
                                $("#cantidad2").val(0);   
                                $("#monto_total2").val(0);
                                global_cal();  
                            }else{
                            $.post("includes/getRecibo_val.php", { caso: 3, condicion: condicion2}, function(data){
                                    importe2=data;                   
                            });  
                            }                        
                        });
                    })
                });      

                $.post("includes/getRecibo_html.php", { caso: 7, condicion: clase5, tipo:3}, function(data){
                $("#idtipo3").html(data).addClass("selectpicker").selectpicker('refresh');             
                });
                $(document).ready(function(){
                    $("#idtipo3").change(function () {
                        $("#idtipo3 option:selected").each(function () {
                            condicion3 = $(this).val();
                            
                            if(condicion3==0){
                                importe3=0; 
                                $("#cantidad3").val(0);   
                                $("#monto_total3").val(0);  
                                global_cal();
                            }else{
                            $.post("includes/getRecibo_val.php", { caso: 3, condicion: condicion3}, function(data){
                                    importe3=data;                   
                            });  
                            }                        
                        });
                    })
                });      

                $.post("includes/getRecibo_html.php", { caso: 7, condicion: clase5, tipo:4}, function(data){
                $("#idtipo4").html(data).addClass("selectpicker").selectpicker('refresh');            
                });
                $(document).ready(function(){
                    $("#idtipo4").change(function () {
                        $("#idtipo4 option:selected").each(function () {
                            condicion4 = $(this).val();
                            
                            if(condicion4==0){
                                importe4=0; 
                                $("#cantidad4").val(0);   
                                $("#monto_total4").val(0);   
                                global_cal();
                            }else{
                            $.post("includes/getRecibo_val.php", { caso: 3, condicion: condicion4}, function(data){
                                    importe4=data;                   
                            });  
                            }                        
                        });
                    })
                });   

                $.post("includes/getRecibo_html.php", { caso: 7, condicion: clase5, tipo:9}, function(data){
                $("#idtipo5").html(data).addClass("selectpicker").selectpicker('refresh');             
                });
                $(document).ready(function(){
                    $("#idtipo5").change(function () {
                        $("#idtipo5 option:selected").each(function () {
                            condicion5 = $(this).val();
                            
                            if(condicion5==0){
                                importe5=0; 
                                $("#cantidad5").val(0);   
                                $("#monto_total5").val(0);  
                                global_cal();
                            }else{
                            $.post("includes/getRecibo_val.php", { caso: 3, condicion: condicion5}, function(data){
                                    importe5=data;                   
                            });  
                            }                        
                        });
                    })
                });   

                $.post("includes/getRecibo_html.php", { caso: 7, condicion: clase5, tipo:12}, function(data){
                $("#idtipo6").html(data).addClass("selectpicker").selectpicker('refresh');           
                });
                $(document).ready(function(){
                    $("#idtipo6").change(function () {
                        $("#idtipo6 option:selected").each(function () {
                            condicion6 = $(this).val();
                            
                            if(condicion6==0){
                                importe6=0; 
                                $("#cantidad6").val(0);   
                                $("#monto_total6").val(0);  
                                global_cal();
                            }else{
                            $.post("includes/getRecibo_val.php", { caso: 3, condicion: condicion6}, function(data){
                                    importe6=data;                   
                            });  
                            }                        
                        });
                    })
                });   

                $.post("includes/getRecibo_html.php", { caso: 7, condicion: clase5, tipo:5}, function(data){
                $("#idtipo7").html(data).addClass("selectpicker").selectpicker('refresh');            
                });
                $(document).ready(function(){
                    $("#idtipo7").change(function () {
                        $("#idtipo7 option:selected").each(function () {
                            condicion7 = $(this).val();
                            
                            if(condicion7==0){
                                importe7=0; 
                                $("#cantidad7").val(0);   
                                $("#monto_total7").val(0); 
                                global_cal(); 
                            }else{
                            $.post("includes/getRecibo_val.php", { caso: 3, condicion: condicion7}, function(data){
                                    importe7=data;                   
                            });  
                            }                        
                        });
                    })
                });   


                $.post("includes/getRecibo_html.php", { caso: 7, condicion: clase5, tipo:6}, function(data){
                $("#idtipo8").html(data).addClass("selectpicker").selectpicker('refresh');          
                });
                $(document).ready(function(){
                    $("#idtipo8").change(function () {
                        $("#idtipo8 option:selected").each(function () {
                            condicion8 = $(this).val();
                            
                            if(condicion8==0){
                                importe8=0; 
                                $("#cantidad8").val(0);   
                                $("#monto_total8").val(0);  
                                global_cal();
                            }else{
                            $.post("includes/getRecibo_val.php", { caso: 3, condicion: condicion8}, function(data){
                                    importe8=data;                   
                            });  
                            }                        
                        });
                    })
                });   
           
        }

        document.getElementById('save_data').addEventListener('click', function(){
            document.getElementById("save_data").style.display = "none";
        }); 
        
        document.getElementById('nuevo').addEventListener('click', function(){
            document.getElementById("save_data").style.display = "block";
        }); 


            $(document).ready(function(){
            let input = document.getElementById('cantidad1');
            input.addEventListener('focus', function(){
               document.onkeyup    = function(e){
                var ev = document.all ? window.event : e;
                    if(ev.keyCode==13) {
                        cal1();

                    }
                        

                }

            })
        })      


    </script> 
     <script> //VALIDAR CARACTERES PARA INGRESAR AL CAMPO TEXTO
            document.getElementById("cantidad1").addEventListener("keypress",verificar);
           
            
            function verificar(e) {
                if(e.key.match(/[0-9]/i)===null) {
                    e.preventDefault();
                }
                
            }
            function verificar_textos(e) {
               if(e.key.match(/[0-9.a-zA-ZÑñ()-]/i)===null) {
                   e.preventDefault();
                   
               }
               
           }

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
             if (filt == 74){
             importe1=0;
             importe2=0;
             importe3=0;
             importe4=0;
             importe5=0;
             importe6=0;
             importe7=0;
             importe8=0;
             }
            
    }
    function global_cal() {
             cal1();
             cal2();
             cal3();
             cal4();
             cal5();
             cal6();
             cal7();
             cal8();

            
            
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