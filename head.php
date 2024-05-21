
<?php
    session_start();
    include "config/config.php";
    if (!isset($_SESSION['user_id'])&& $_SESSION['user_id']==null) {
        header("location: index.php");
    }
?>
<?php
    $tok0=0; //V
    $tok1=1; //C
    $tok2=2; //A
    $tok3=3; //E
    
    $id=$_SESSION['user_id'];
	$id2=$_SESSION['user_id'];
    $query=mysqli_query($con,"SELECT * from user where id=$id");
    while ($row=mysqli_fetch_array($query)) {
        $codigo = $row['id'];
        $codigotemp = $row['id'];
        $username = $row['username'];
        $name = $row['nombre'];
        $email = $row['email'];
        $profile_pic = $row['profile_pic'];
        $created_at = $row['created_at'];
  		$dni= $row['dni'];
        $celular=$row['celular'];
		$ruc = $row['ruc'];
		$razonsocial=$row['razonsocial'];
		$direccion=$row['direccion'];
		$profile_pictwo=$row['profile_pictwo'];
        $idroles=$row['idroles'];
        $grupo0='0';//GRUPOSERVICE
        $grupo1='1';//GRUPOSERVICE

 
    }
	$query->close(); 
    $con->next_result();

?>
<!DOCTYPE html>
<html lang="en">
	
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title." ".$name; ?> </title>
	
        <!-- Bootstrap -->
        <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="css/nprogress/nprogress.css" rel="stylesheet">
          <!-- iCheck -->
       <link href="css/iCheck/skins/flat/green.css" rel="stylesheet">
       <!-- Datatables -->
        <link href="css/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="css/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="css/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="css/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="css/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <!-- jQuery custom content scroller -->
        <link href="css/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

        <!-- bootstrap-daterangepicker -->
        <link href="css/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="css/custom.min.css" rel="stylesheet">

        <!-- MICSS button[type="file"] -->
        <link rel="stylesheet" href="css/micss.css">
        
		 <!-- bootstrap-select combo -11/03/2021-->
		<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
		<link href="css/bootstrap-select/bootstrap-select.css" rel="stylesheet">
        <!-- camara qr -16/11/2023-->
        <link rel="stylesheet" type="text/css" href="assets/css/estilo_camara.css" />
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                    <div class="mb-4 mb-md-5 text-center">
                        <div class="navbar nav_title" style="border: 0;">
                          <a href="#" class="site_title">
                          <span>SIGAC</span><img src="images/profiles/ico.png" alt="" height="28"></a>
							
                        </div>
						</div>
                        <div class="clearfix"></div>

                            <!-- menu profile quick info -->
                                <div class="profile clearfix">
                                    <div class="profile_pic">
                                        <img src="images/profiles/<?php echo $profile_pic;?>" alt="<?php echo $name;?>" class="img-circle profile_img">
                                    </div>
                                    <div class="profile_info">
                                        <span>Bienvenido,</span>
                                        <h2><?php echo $name;?></h2>
                                    </div>
                                </div>
                            <!-- /menu profile quick info -->

                        <br />