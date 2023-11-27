<?php

    //define('DB_HOST', 'localhost');//DB_HOST:  generalmente suele ser "127.0.0.1"
    //define('DB_USER', 'root');//Usuario de tu base de datos
    //define('DB_PASS', '@rzobisp@d0');//Contrase帽a del usuario de la base de datos
    //define('DB_NAME', 'ticketcat');//Nombre de la base de datos

	/*Datos de conexion a la base de datos*/
	define('DB_HOST', 'arzovvm2020dbmysql.mysql.database.azure.com');//DB_HOST:  generalmente suele ser "127.0.0.1"
	define('DB_USER', 'uservmdbmysql@arzovvm2020dbmysql');//Usuario de tu base de datos
	define('DB_PASS', '01*V1NfJMSaV');//Contraseña del usuario de la base de datos
	define('DB_NAME', 'syscatedral');//Nombre de la base de datos
    //define('DB_NAME', 'arzlim-inmuebles');//Nombre de la base de datos

	$con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        @die("<h2 style='text-align:center'>Imposible conectarse a la base de datos! </h2>".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        @die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
?>