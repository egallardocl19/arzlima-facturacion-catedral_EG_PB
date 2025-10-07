<?php
// Initialize the session
session_start();

include "config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token']) && $_POST['token'] !== '') {
        $email = mysqli_real_escape_string($con, (strip_tags($_POST["email"], ENT_QUOTES)));
        $password = sha1(md5(mysqli_real_escape_string($con, (strip_tags($_POST["password"], ENT_QUOTES)))));

        $query = mysqli_query($con, "CALL session_login('$email','$password');");

        if ($query && mysqli_num_rows($query) > 0) {
                if ($row = mysqli_fetch_array($query)) {
                        $_SESSION['user_id'] = $row['id'];
                        mysqli_free_result($query);
                        while (mysqli_more_results($con) && mysqli_next_result($con)) {
                                // Clear any additional results from the stored procedure call.
                        }
                        header('Location: dashboardadmin.php');
                        exit();
                }
        }

        if ($query) {
                mysqli_free_result($query);
                while (mysqli_more_results($con) && mysqli_next_result($con)) {
                        // Clear any additional results before reusing the connection.
                }
        }

        $invalid = sha1(md5("contrasena y email invalido"));
        header("Location: index.php?invalid=$invalid");
        exit();
}

if (isset($_SESSION['user_id']) && $_SESSION !== null) {
        header("location: dashboardadmin.php");
        exit();
}

?>
<!--  position login -->
<html lang="en" dir="rtl">
 

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <link  rel="icon"   href="images/favicon.png" type="image/png" />
		<title>SIGAC - Iniciar Sesión </title>
       	
    
          <!-- Font Awesome -->
          <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		 <!-- NProgress -->
         <link href="css/nprogress/nprogress.css" rel="stylesheet">
          <!-- Animate.css -->
          <link href="css/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="css/custom.min.css" rel="stylesheet">
        
    <!-- diseño -->
        <?php include 'css/head-style.php'; ?>

</head>

<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
      
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-50">
                        <div class="mb-4 mb-md-5 text-center">
                                <a href="index.php" class="d-block auth-logo">
                                    <img src="images/profiles/ico.png" alt="" height="28"> <span class="logo-txt">SIGAC</span>
                                </a>
                            </div>
                        
                        <br/><br/><br/>
                        
                        <?php 
                                        $invalid=sha1(md5("contrasena y email invalido"));
                                        if (isset($_GET['invalid']) && $_GET['invalid']==$invalid) {
                                            echo "
                                            <div class='mb-4 mb-md-0 text-nowrap'>
                                                <div class='alert alert-danger alert-dismissible' >
                                                <strong>Error!</strong> Contraseña o correo Electrónico invalido
                                                </div>
                                                </div>
                                                ";
                                        }
                                        ?>
                      
                            
                            <div class="mb-4 mb-md-0 text-center">  <!--4-5  -->
                            
                                <a href="index.php" class="d-block auth-logo">
                                    <img src="images/profiles/logo4.png" alt="" height="130"> 
                                </a>
                            </div>
                             <br/><br/><br/> 
                            
                                       
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Bienvenido!</h5>
                                    <p class="text-muted mt-2">Inicia sesión para continuar al Sistema SIGAC</p>
                                </div>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <div class="form-floating form-floating-custom mb-4">
                                        <input type="text" class="form-control" name="email" placeholder="Enter User Name">
                                        <label for="input-username">Username</label>
                                      
                                        <div class="form-floating-icon">
                                            <i data-feather="users"></i>
                                        </div>
                                    </div>

                                    <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                        <input type="password" class="form-control pe-5" name="password"  placeholder="Enter Password">
                                       
                                        <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0">
                                            <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                        </button>
                                        <label for="input-password">Password</label>
                                        <div class="form-floating-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>

                                    
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit" name="token" value="Login">Iniciar Sesión</button>
                                    </div>
                                    
                                </form>

                               
                            </div>
                          
                            
                            <div class="mt-4 mt-md-5 text-center">
               
                                    <p>Este proyecto está creado para el <a style="text-decoration: underline;" 
                                    target="_blank" href="https://www.arzobispadodelima.org/">Arzobispado de Lima</a>
                                    <br> Para soporte de la web contactar al Correo: <a style="color: #0000ff; text-decoration: underline;" 
                                    target="_blank" href="#">soporte@arzobispadodelima.org</a></p>
                            </div>
                            <div class="mb-4 mb-md-0 text-center">  <!--4-5  -->
                                <a href="index.php" class="d-block auth-logo">
                                    <img src="images/profiles/Escudo-Cardenal.png" alt="" height="100"> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-end">
                        <div class="col-xl-7">
                            <div class="p-0 p-sm-4 px-xl-0">
                                <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators auth-carousel carousel-indicators-rounded justify-content-center mb-0">
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                                            <img src="assets/images/users/log.png" class="avatar-md img-fluid rounded-circle d-block" alt="...">
                                        </button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2">
                                            <img src="assets/images/users/log.png" class="avatar-md img-fluid rounded-circle d-block" alt="...">
                                        </button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3">
                                            <img src="assets/images/users/log.png" class="avatar-md img-fluid rounded-circle d-block" alt="...">
                                        </button>
                                    </div>
                                    <!-- end carouselIndicators -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="testi-contain text-center text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                                <h4 class="mt-4 fw-medium lh-base text-white">
                                                    Sistema administrativo para garantizar que se mantenga la integridad de los datos
                                                    
                                                </h4>
                                                <div class="mt-4 pt-1 pb-5 mb-5">
                                                    <h5 class="font-size-16 text-white">Sistemas
                                                    </h5>
                                                    <p class="mb-0 text-white-50">Web Designer</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="testi-contain text-center text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                                <h4 class="mt-4 fw-medium lh-base text-white">
                                                    Sistema que recopila, procesa, muestra y presenta 
                                                    información para ayudar a los usuarios a optimizar procesos
                                                    </h4>
                                                <div class="mt-4 pt-1 pb-5 mb-5">
                                                    <h5 class="font-size-16 text-white">Sistemas
                                                    </h5>
                                                    <p class="mb-0 text-white-50">Web Developer</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="testi-contain text-center text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                                <h4 class="mt-4 fw-medium lh-base text-white">Un sistema generalizado que cubre el servicio de administración 
                                                    de bases de datos y la ejecución de transacciones
                                                    </h4>
                                                <div class="mt-4 pt-1 pb-5 mb-5">
                                                    <h5 class="font-size-16 text-white">Sistemas</h5>
                                                    <p class="mb-0 text-white-50">Manager
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end carousel-inner -->
                                </div>
                                <!-- end review carousel -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>
<!-- movimientos -->
<?php include 'css/vendor-scripts.php'; ?>


</body>


</html>
