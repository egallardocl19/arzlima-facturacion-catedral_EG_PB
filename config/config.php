<?php

	//$con = mysqli_connect("arzovvm2020dbmysql.mysql.database.azure.com","uservmdbmysql@arzovvm2020dbmysql","01*V1NfJMSaV","confirmaciones");
    //$con = mysqli_connect("arzovvm2020dbmysql.mysql.database.azure.com","uservmdbmysql@arzovvm2020dbmysql","01*V1NfJMSaV","inmuebles");
    $con = mysqli_connect("arzovvm2020dbmysql.mysql.database.azure.com","uservmdbmysql@arzovvm2020dbmysql","01*V1NfJMSaV","syscatedral");
    //$con = mysqli_connect("localhost","root","@rzobisp@d0","syscatedral");
	
    if(!$con->set_charset("utf8")){
        @die("<h2 style='text-align:center'>Imposible conectarse a la base de datos! </h2>".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        @die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
