<!DOCTYPE html>
<html lang="en">
	<link  rel="icon"   href="images/favicon.png" type="image/png" />
<?php 
    $title ="Reportes - "; 
    include "head.php";
    include "sidebaradmin.php";
    //$dni =mysqli_query($con, "select distinct(dni),nombre from ticket order by dni");
    $estado_ticket =mysqli_query($con, "select * from estado_ticket");
    $user=$_SESSION['user_id'];
    $consulta_codigo_user =mysqli_query($con,"SELECT idroles FROM user where id=$user");
   
			if (!$consulta_codigo_user||mysqli_num_rows($consulta_codigo_user)!=0){
				if ($row = mysqli_fetch_array($consulta_codigo_user)){
					$consulta_rol=$row['idroles']; 
				}
			}
    if($consulta_rol>1){
        $cajero =mysqli_query($con, "select * from user where id=$user");
     
    }else{
        $cajero =mysqli_query($con, "select * from user");
    }
    //$cajero =mysqli_query($con, "select * from user where idroles>1");
    $tipo_ticket =mysqli_query($con, "select id,nombre from clase_ticket where idestado_dato=1 and id in(1,2,5)");
    //$ticket =mysqli_query($con, "select concat(serie,\"-\",numero) as codigo,serie,numero from ticket_control group by serie,numero");
    //$cobranza =mysqli_query($con, "select n_cobranza from cobranza");
    $tipo_pago =mysqli_query($con, "select id,nombre from formapago where id in(4,5,7) and idestado_dato=1");
    $fecha = date("Y-m-d"); 
    $colorheder="info"; //COLOR  CABECERA MODAL
        
   
    include("modal/new_reporte_ticket.php");
    include("modal/new_reporte_ticket2.php");
    include("modal/new_reporte_ticket_control.php");
    include("modal/new_reporte_cobranza.php");


  
  
    // $query_reporte =mysqli_query($con,"CALL dashboard('1','1','2','3');");
   
    //  if (!$query_reporte||mysqli_num_rows($query_reporte)!=0){
   
    //          while ($row_rep=$query_reporte->fetch_assoc()) 
	//  		{
	//  			$monto1= $row_rep['mes1'];	
    //              $monto2= $row_rep['mes2'];	
    //              $monto3=$row_rep['mes3']; 
    //              $monto4=$row_rep['mes4']; 
    //              $monto5=$row_rep['mes5']; 
    //              $monto6=$row_rep['mes6']; 
    //              $monto7=$row_rep['mes7']; 
    //              $monto8=$row_rep['mes8']; 
    //              $monto9=$row_rep['mes9']; 
    //              $monto10=$row_rep['mes10']; 
    //              $monto11=$row_rep['mes11']; 
    //              $monto12=$row_rep['mes12']; 
              
    //              $conteo1=$row_rep['mes1xx']; 
    //              $conteo2=$row_rep['mes2xx']; 
    //              $conteo3=$row_rep['mes3xx']; 
    //              $conteo4=$row_rep['mes4xx']; 
    //              $conteo5=$row_rep['mes5xx']; 
    //              $conteo6=$row_rep['mes6xx']; 
    //              $conteo7=$row_rep['mes7xx']; 
    //              $conteo8=$row_rep['mes8xx']; 
    //              $conteo9=$row_rep['mes9xx']; 
    //              $conteo10=$row_rep['mes10xx']; 
    //              $conteo11=$row_rep['mes11xx']; 
    //              $conteo12=$row_rep['mes12xx']; 
    //              $conteo1x=$row_rep['mes1xxx']; 
    //              $conteo2x=$row_rep['mes2xxx']; 
    //              $conteo3x=$row_rep['mes3xxx']; 
    //              $conteo4x=$row_rep['mes4xxx']; 
    //              $conteo5x=$row_rep['mes5xxx']; 
    //              $conteo6x=$row_rep['mes6xxx']; 
    //              $conteo7x=$row_rep['mes7xxx']; 
    //              $conteo8x=$row_rep['mes8xxx']; 
    //              $conteo9x=$row_rep['mes9xxx']; 
    //              $conteo10x=$row_rep['mes10xxx']; 
    //              $conteo11x=$row_rep['mes11xxx']; 
    //              $conteo12x=$row_rep['mes12xxx']; 
    //              $conteo1xx=$row_rep['mes1xxxx']; 
    //              $conteo2xx=$row_rep['mes2xxxx']; 
    //              $conteo3xx=$row_rep['mes3xxxx']; 
    //              $conteo4xx=$row_rep['mes4xxxx']; 
    //              $conteo5xx=$row_rep['mes5xxxx']; 
    //              $conteo6xx=$row_rep['mes6xxxx']; 
    //              $conteo7xx=$row_rep['mes7xxxx']; 
    //              $conteo8xx=$row_rep['mes8xxxx']; 
    //              $conteo9xx=$row_rep['mes9xxxx']; 
    //              $conteo10xx=$row_rep['mes10xxxx']; 
    //              $conteo11xx=$row_rep['mes11xxxx']; 
    //              $conteo12xx=$row_rep['mes12xxxx']; 
  
	//  		}
    //          $query_reporte->close();
    //          $con->next_result();
        
    //  }else{
    //              $monto1='0'; 
    //              $monto2='0'; 
    //              $monto3='0'; 
    //              $monto4='0'; 
    //              $monto5='0'; 
    //              $monto6='0'; 
    //              $monto7='0'; 
    //              $monto8='0'; 
    //              $monto9='0'; 
    //              $monto10='0'; 
    //              $monto11='0'; 
    //              $monto12='0'; 
                
    //              $conteo1='0'; 
    //              $conteo2='0'; 
    //              $conteo3='0'; 
    //              $conteo4='0'; 
    //              $conteo5='0'; 
    //              $conteo6='0'; 
    //              $conteo7='0'; 
    //              $conteo8='0'; 
    //              $conteo9='0'; 
    //              $conteo10='0'; 
    //              $conteo11='0'; 
    //              $conteo12='0'; 
    //              $conteo1x='0'; 
    //              $conteo2x='0'; 
    //              $conteo3x='0'; 
    //              $conteo4x='0'; 
    //              $conteo5x='0'; 
    //             $conteo6x='0'; 
    //              $conteo7x='0'; 
    //              $conteo8x='0'; 
    //              $conteo9x='0'; 
    //              $conteo10x='0'; 
    //              $conteo11x='0'; 
    //              $conteo12x='0'; 
    //              $conteo1xx='0'; 
    //              $conteo2xx='0'; 
    //              $conteo3xx='0'; 
    //              $conteo4xx='0'; 
    //              $conteo5xx='0'; 
    //              $conteo6xx='0'; 
    //              $conteo7xx='0'; 
    //              $conteo8xx='0'; 
    //              $conteo9xx='0'; 
    //              $conteo10xx='0'; 
    //              $conteo11xx='0'; 
    //              $conteo12xx='0';  
         
    //  }

   
            
           


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
        ?><?php 
     
            
?>

        <div class="right_col" role="main"> <!-- page content -->
            <div class="">
                <div class="page-title">
                    <div class="row top_tiles">

                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Reportes: </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    
                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="tile-stats" style="background-image: url('images/profiles/fonbo4.png'); width:100%;">
                                        <div class="icon"><a data-toggle="modal" data-target=".bs-example-modal-lg-reporteticket" ><i class="fa fa-file-text"></i></a></div>
                                        <a data-toggle="modal" data-target=".bs-example-modal-lg-reporteticket" >
                                            <img src="images/bon2.png" style="width:40%"></a></br>
                                        <a data-toggle="modal" data-target=".bs-example-modal-lg-reporteticket" style="font-size:21px;" ><i class="fa fa-bookmark"></i>Ticket Emitidos</a>
                                        </div>
                                    </div>

                                     <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" id="1">
                                     <div class="tile-stats" style="background-image: url('images/profiles/fonbo5.png'); width:100%;">
                                        <div class="icon"><a data-toggle="modal" data-target=".bs-example-modal-lg-reporteticket2" ><i class="fa fa-file-text"></i></a></div>
                                        <a data-toggle="modal" data-target=".bs-example-modal-lg-reporteticket2" >
                                            <img src="images/bon2.png" style="width:40%"></a></br>
                                        <a data-toggle="modal" data-target=".bs-example-modal-lg-reporteticket2" style="font-size:21px;" ><i class="fa fa-bookmark"></i>Resumen</a>
                                        </div>
                                    </div>

                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" id="2">
                                        <div class="tile-stats" style="background-image: url('images/profiles/fonbo6.png'); width:100%;">
                                        <div class="icon"><a data-toggle="modal" data-target=".bs-example-modal-lg-reporteticket2" ><i class="fa fa-file-text"></i></a></div>
                                        <a data-toggle="modal" data-target=".bs-example-modal-lg-reporteticket2" >
                                            <img src="images/bon2.png" style="width:40%"></a></br>
                                        <a data-toggle="modal" data-target=".bs-example-modal-lg-reporteticket2" style="font-size:21px;" ><i class="fa fa-bookmark"></i>Ticket Control</a>
                                        </div>
                                    </div> 

                                   
                                    
                                    
                                </div>
                            </div>
                        </div>
              

                   
                     
                    
                        <!-- <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Gráficos</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                     <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Cobranza Mensual</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <br />
                                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="action/upd_profile.php" method="post">
                                                
                                                <div class="form-group">
                                                
                                                <canvas id="myChart" width="200" height="50"></canvas>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Tickets Mensuales</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <br />
                                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="action/upd_profile.php" method="post">
                                                
                                                <div class="form-group">
                                                    
                                                    <canvas id="myChart2" width="200" height="50"></canvas>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                               

                                    
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- content -->
            </div>
        </div><!-- /page content -->

<?php include "footer.php" ?>

<script>
    $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "action/upload-profile.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
    });


// success

</script>
	
<script>
    $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario2")[0]);
            var ruta = "action/upload-profiletwo.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
    });


// success

</script>

<!-- jQuery graficos 27/02/2022-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.esm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/helpers.esm.min.js"></script>

<?php 
    
    //  $mes1 = date('Y-m', strtotime("first day of -0 month"));
    //  $mes2 = date('Y-m', strtotime("first day of -1 month"));
    //  $mes3 = date('Y-m', strtotime("first day of -2 month"));
    //  $mes4 = date('Y-m', strtotime("first day of -3 month"));
    //  $mes5 = date('Y-m', strtotime("first day of -4 month"));
    //  $mes6 = date('Y-m', strtotime("first day of -5 month"));
    //  $mes7 = date('Y-m', strtotime("first day of -6 month"));
    //  $mes8 = date('Y-m', strtotime("first day of -7 month"));
    //  $mes9 = date('Y-m', strtotime("first day of -8 month"));
    //  $mes10 = date('Y-m', strtotime("first day of -9 month"));
    //  $mes11 = date('Y-m', strtotime("first day of -10 month"));
    //  $mes12 = date('Y-m', strtotime("first day of -11 month"));
   
     
?>


<script>
//     var mes1 = '<?=$mes1?>';
//     var mes2 = '<?=$mes2?>';
//     var mes3 = '<?=$mes3?>';
//     var mes4 = '<?=$mes4?>';
//     var mes5 = '<?=$mes5?>';
//     var mes6 = '<?=$mes6?>';
//     var mes7 = '<?=$mes7?>';
//     var mes8 = '<?=$mes8?>';
//     var mes9 = '<?=$mes9?>';
//     var mes10 = '<?=$mes10?>';
//     var mes11 = '<?=$mes11?>';
//     var mes12 = '<?=$mes12?>';
//     var monto1 = '<?=$monto1?>';
//     var monto2 = '<?=$monto2?>';
//     var monto3 = '<?=$monto3?>';
//     var monto4 = '<?=$monto4?>';
//     var monto5 = '<?=$monto5?>';
//     var monto6 = '<?=$monto6?>';
//     var monto7 = '<?=$monto7?>';
//     var monto8 = '<?=$monto8?>';
//     var monto9 = '<?=$monto9?>';
//     var monto10 = '<?=$monto10?>';
//     var monto11 = '<?=$monto11?>';
//     var monto12 = '<?=$monto12?>';
 
//     var conteo1 = '<?=$conteo1?>';
//     var conteo2 = '<?=$conteo2?>';
//     var conteo3 = '<?=$conteo3?>';
//     var conteo4 = '<?=$conteo4?>';
//     var conteo5 = '<?=$conteo5?>';
//     var conteo6 = '<?=$conteo6?>';
//     var conteo7 = '<?=$conteo7?>';
//     var conteo8 = '<?=$conteo8?>';
//     var conteo9 = '<?=$conteo9?>';
//     var conteo10 = '<?=$conteo10?>';
//     var conteo11 = '<?=$conteo11?>';
//     var conteo12 = '<?=$conteo12?>';
//     var conteo1x = '<?=$conteo1x?>';
//     var conteo2x = '<?=$conteo2x?>';
//     var conteo3x = '<?=$conteo3x?>';
//     var conteo4x = '<?=$conteo4x?>';
//     var conteo5x = '<?=$conteo5x?>';
//     var conteo6x = '<?=$conteo6x?>';
//     var conteo7x = '<?=$conteo7x?>';
//     var conteo8x = '<?=$conteo8x?>';
//     var conteo9x = '<?=$conteo9x?>';
//     var conteo10x = '<?=$conteo10x?>';
//     var conteo11x = '<?=$conteo11x?>';
//     var conteo12x = '<?=$conteo12x?>';
//     var conteo1xx = '<?=$conteo1xx?>';
//     var conteo2xx = '<?=$conteo2xx?>';
//     var conteo3xx = '<?=$conteo3xx?>';
//     var conteo4xx = '<?=$conteo4xx?>';
//     var conteo5xx = '<?=$conteo5xx?>';
//     var conteo6xx = '<?=$conteo6xx?>';
//     var conteo7xx = '<?=$conteo7xx?>';
//     var conteo8xx = '<?=$conteo8xx?>';
//     var conteo9xx = '<?=$conteo9xx?>';
//     var conteo10xx = '<?=$conteo10xx?>';
//     var conteo11xx = '<?=$conteo11xx?>';
//     var conteo12xx = '<?=$conteo12xx?>';

  
//     const ctx = document.getElementById('myChart');
// const myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
        
//         labels: [mes1,mes2, mes3, mes4,mes5, mes6,mes7,mes8, mes9, mes10,mes11, mes12],
//         datasets: [{
//             label: 'S/. SOLES',
//             data: [monto1,monto2,monto3,monto4,monto5,monto6,monto7,monto8,monto9,monto10,monto11,monto12],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)'
//             ],
//             borderWidth: 2
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });
//     function CargarDatosGraficoBar(){


//     }
</script>
<script>
//     var mes1 = '<?=$mes1?>';
//     var mes2 = '<?=$mes2?>';
//     var mes3 = '<?=$mes3?>';
//     var mes4 = '<?=$mes4?>';
//     var mes5 = '<?=$mes5?>';
//     var mes6 = '<?=$mes6?>';
//     const ctx2 = document.getElementById('myChart2');
// const myChart2 = new Chart(ctx2, {
//     type: 'bar',
//     data: {
//         labels: [mes1,mes2, mes3, mes4,mes5, mes6,mes7,mes8, mes9, mes10,mes11, mes12],
//         datasets: [{
//             label: 'PENDIENTE',
//             data: [conteo1,conteo2,conteo3,conteo4,conteo5,conteo6,conteo7,conteo8,conteo9,conteo10,conteo11,conteo12],
//             backgroundColor: [
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(54, 162, 235, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(54, 162, 235, 1)'
//             ],
//             borderWidth: 2
//         },
//         {
//             label: 'PAGADO',
//             data: [conteo1x,conteo2x,conteo3x,conteo4x,conteo5x,conteo6x,conteo7x,conteo8x,conteo9x,conteo10x,conteo11x,conteo12x],
//             backgroundColor: [
//                 'rgba(170, 226, 165, 0.8)',
//                 'rgba(170, 226, 165, 0.8)',
//                 'rgba(170, 226, 165, 0.8)',
//                 'rgba(170, 226, 165, 0.8)',
//                 'rgba(170, 226, 165, 0.8)',
//                 'rgba(170, 226, 165, 0.8)',
//                 'rgba(170, 226, 165, 0.8)',
//                 'rgba(170, 226, 165, 0.8)',
//                 'rgba(170, 226, 165, 0.8)',
//                 'rgba(170, 226, 165, 0.8)',
//                 'rgba(170, 226, 165, 0.8)',
//                 'rgba(170, 226, 165, 0.8)'
//             ],
//             borderColor: [
//                 'rgba(22, 129, 12, 0.8)',
//                 'rgba(22, 129, 12, 0.8)',
//                 'rgba(22, 129, 12, 0.8)',
//                 'rgba(22, 129, 12, 0.8)',
//                 'rgba(22, 129, 12, 0.8)',
//                 'rgba(22, 129, 12, 0.8)',
//                 'rgba(22, 129, 12, 0.8)',
//                 'rgba(22, 129, 12, 0.8)',
//                 'rgba(22, 129, 12, 0.8)',
//                 'rgba(22, 129, 12, 0.8)',
//                 'rgba(22, 129, 12, 0.8)',
//                 'rgba(22, 129, 12, 0.8)'
//             ],
//             borderWidth: 2
//         },
//         {
//             label: 'ANULADO',
//             data: [conteo1xx,conteo2xx,conteo3xx,conteo4xx,conteo5xx,conteo6xx,conteo7xx,conteo8xx,conteo9xx,conteo10xx,conteo11xx,conteo12xx],
//             backgroundColor: [
                
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 99, 132, 0.2)'
//             ],
//             borderColor: [
                
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(255, 99, 132, 1)'
//             ],
//             borderWidth: 2
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });
    
</script>

<?php 
     }else{

         include "informacion.php";
      
     }
  }else{

         include "informacion.php";
      
     }  
    ?> 

    
    <script language="javascript">
    document.getElementById('1').addEventListener('click', function(){
    document.getElementById('myModalLabelReporte').innerHTML= '<strong><i class="fa fa-book" aria-hidden="true"></i> Reporte Resumen Ventas</strong>';
    document.getElementById("btn1").style.display = "block";
    document.getElementById("btn2").style.display = "none";
    document.getElementById("con1").style.display = "block";
    });  

    document.getElementById('2').addEventListener('click', function(){
    document.getElementById('myModalLabelReporte').innerHTML= '<strong><i class="fa fa-book" aria-hidden="true"></i> Reporte Control Ticket</strong>';
    document.getElementById("btn1").style.display = "none";
    document.getElementById("btn2").style.display = "block";
    document.getElementById("con1").style.display = "none";
  
    
    });  
    </script>
