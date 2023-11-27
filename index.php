<?php
    session_start();

    include "config/config.php";

    if (isset($_SESSION['user_id']) && $_SESSION!==null) {
        header("location: dashboardadmin.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <link  rel="icon"   href="images/favicon.png" type="image/png" />
		<title>Catedral de Lima - Iniciar Sesión </title>
		
        <!-- Bootstrap -->
        <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
       
        <link href="css/nprogress/nprogress.css" rel="stylesheet">
        
        <link href="css/animate.css/animate.min.css" rel="stylesheet">

        <link href="css/custom.min.css" rel="stylesheet">

     </head>
    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <?php 
                        $invalid=sha1(md5("contrasena y email invalido"));
                        if (isset($_GET['invalid']) && $_GET['invalid']==$invalid) {
                            echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                                <strong>Error!</strong> Contraseña o correo Electrónico invalido
                                </div>";
                        }
                    ?>
                    <section class="login_content">
						<div><img style="width: 100%; display: block;" src="images/profiles/logo4.png"></div>
                        <form action="action/login.php" method="post">
							
                            <h1>Iniciar Sesión</h1>
                            <div>
                                <input type="text" name="email" class="form-control" placeholder="Correo Electrónico" required />
                            </div>
                            <div>
                                <input type="password" name="password" class="form-control" placeholder="Contraseña" required/>
                            </div>
                            <div>
                                <button type="submit" name="token" value="Login" class="btn btn-default">Iniciar Sesion</button>
                                <a class="reset_pass" href="#" style="display:none" >Olvidaste Tu contraseña?</a>
                            </div>
							
                        
                    
                            <div class="clearfix"></div>
                            <div class="separator">
                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <h1><i class="fa fa-university"></i> MUSEO DE ARTE</h1>
									<div class="profile clearfix">
                                    
                                    <p>Este proyecto está creado para el <a style="text-decoration: underline;" target="_blank" href="https://www.arzobispadodelima.org/">Arzobispado de Lima</a><br> Para soporte de la web contactar al Correo: <a style="color: #0000ff; text-decoration: underline;" target="_blank" href="#">soporte@arzobispadodelma.org</a></p>
                                </div>
								
                                    
                        		</div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>



