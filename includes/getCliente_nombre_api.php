<?php
	
	require ('../config/config.php');
	
	$id_numero_identidad = $_POST['id_numero_identidad'];
   	
    $validar_numero_identidad = strlen($id_numero_identidad);
   
    if ($validar_numero_identidad==8){
    //API DNI
    // Datos
    $token = 'apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N';
    $dni = $id_numero_identidad;

    // Iniciar llamada a API
    $curl = curl_init();

    // Buscar dni
    curl_setopt_array($curl, array(
    // para user api versión 2
    //CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
    // para user api versión 1
     CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 2,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Referer: https://apis.net.pe/consulta-dni-api',
        'Authorization: Bearer ' . $token
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // Datos listos para usar
    $persona = json_decode($response,true);
    
    //var_dump($apellidomaterno_sunat);
    //$val=$persona;
        if(!empty($persona["nombres"]) && !empty($persona["apellidoPaterno"]) && !empty($persona["apellidoMaterno"])){
            $nombre_sunat= $persona["nombres"];
            $apellidopaterno_sunat= $persona["apellidoPaterno"];
            $apellidomaterno_sunat= $persona["apellidoMaterno"];
            $val= $nombre_sunat.' '.$apellidopaterno_sunat.' '.$apellidomaterno_sunat;
            //var_dump($nombre_sunat,$apellidopaterno_sunat,$apellidomaterno_sunat); 
            $val2= ""; 
        }else{
            $val= ""; 
            $val2= ""; 
        }

       
    }elseif ($validar_numero_identidad==11){

    //API RUC
    // Datos
    $token = 'apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N';
    $ruc = $id_numero_identidad;

    // Iniciar llamada a API
    $curl = curl_init();

    // Buscar ruc sunat
    curl_setopt_array($curl, array(
    // para usar la versión 2
    //CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc?numero=' . $ruc,
    // para usar la versión 1
     CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Referer: http://apis.net.pe/api-ruc',
        'Authorization: Bearer ' . $token
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // Datos de empresas según padron reducido
    $empresa = json_decode($response,true);
    //$nombre_sunat= $empresa["nombre"];
    //$direccion= $empresa["direccion"];
 
    if (empty($empresa["nombre"])){
        $nombre_sunat='';
    }else{
        $nombre_sunat=$empresa["nombre"];
    }
    if (empty($empresa["direccion"])){
        $direccion='';
    }else{
        $direccion=$empresa["direccion"];
    }

    $val= $nombre_sunat;
    $val2= $direccion;

	}
   
	if (empty($val)){
        $val='';
    }else{
        $val=$val;
    }
    if (empty($val2)){
        $val2='';
    }else{
        $val2=$val2;
    }
        
        
	
		
	echo $val,'-',$val2;
?>		