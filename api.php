<?php

if (isset($_SERVER['HTTP_ORIGIN'])){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Credentials: true');      
    }  
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
      if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))          
          header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
      if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
          header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
      exit(0);
    }

    require "config/config2.php";
    error_reporting(0);
    $conexion= new Conexion;
    if($conexion != null)
    {
    $Method=$_SERVER['REQUEST_METHOD'];

    if ($Method == "GET")
    {
        //if (!isset($_GET['tok']) && !isset($_GET['tipo_ingreso1']))
     if (!isset($_GET['tok']) && !isset($_GET['tok2'])&& !isset($_GET['serie'])&& !isset($_GET['submodulo'])
     && !isset($_GET['fecha_inicio'])&& !isset($_GET['fecha_uso'])&& !isset($_GET['hora_registro'])
     && !isset($_GET['hora_uso'])&& !isset($_GET['monto_totalxx'])&& !isset($_GET['cantidad_total'])
     && !isset($_GET['dni'])&& !isset($_GET['nombre'])&& !isset($_GET['direccion'])&& !isset($_GET['correo'])
     && !isset($_GET['idtipo1'])&& !isset($_GET['cantidad1'])&& !isset($_GET['monto_total1'])
     && !isset($_GET['idtipo2'])&& !isset($_GET['cantidad2'])&& !isset($_GET['monto_total2'])
     && !isset($_GET['idtipo3'])&& !isset($_GET['cantidad3'])&& !isset($_GET['monto_total3'])
     && !isset($_GET['idtipo4'])&& !isset($_GET['cantidad4'])&& !isset($_GET['monto_total4'])
     && !isset($_GET['idtipo5'])&& !isset($_GET['cantidad5'])&& !isset($_GET['monto_total5'])
     && !isset($_GET['idtipo6'])&& !isset($_GET['cantidad6'])&& !isset($_GET['monto_total6'])
     && !isset($_GET['idtipo7'])&& !isset($_GET['cantidad7'])&& !isset($_GET['monto_total7'])
     && !isset($_GET['idtipo8'])&& !isset($_GET['cantidad8'])&& !isset($_GET['monto_total8'])
     && !isset($_GET['tipopago'])&& !isset($_GET['n_pago'])&& !isset($_GET['user'])) //&&
        {
            $consulta="select 'No hay data' as Resultado";
            try {
           
            $pps=$conexion->getConexion()->prepare($consulta);
            $pps->execute();
            //echo json_encode(["usuario" => $pps -> fetchAll(PDO::FETCH_OBJ)]);
            echo json_encode($pps -> fetchAll(PDO::FETCH_OBJ));
            } catch (\Throwable $th)  {
                include "informacion.php";
            } finally{
                $conexion->closeDataBase();
            }
        }else{
             

            try {
                 $consulta="CALL mantenimiento_recibo_api (:v_tok,:v_tok2,1,:v_serie,:v_submodulo,
                 :v_fecha_inicio,:v_fecha_uso,:v_hora_registro,:v_hora_uso,:v_monto_totalxx,:v_cantidad_total,:v_dni,
                 :v_nombre,:v_direccion,:v_correo,:v_idtipo1,:v_cantidad1,:v_monto_total1,
                 :v_idtipo2,:v_cantidad2,:v_monto_total2,:v_idtipo3,:v_cantidad3,:v_monto_total3,
                 :v_idtipo4,:v_cantidad4,:v_monto_total4,:v_idtipo5,:v_cantidad5,:v_monto_total5,
                 :v_idtipo6,:v_cantidad6,:v_monto_total6,:v_idtipo7,:v_cantidad7,:v_monto_total7,:v_idtipo8,:v_cantidad8,:v_monto_total8,
                 :v_tipopago,:v_n_pago,:v_user);";
  
                
                 $pps=$conexion->getConexion()->prepare($consulta);
                 $pps-> bindParam(":v_tok",$_GET['tok']);
                 $pps-> bindParam(":v_tok2",$_GET['tok2']);
                 $pps-> bindParam(":v_serie",$_GET['serie']);
                 $pps-> bindParam(":v_submodulo",$_GET['submodulo']);
                 $pps-> bindParam(":v_fecha_inicio",$_GET['fecha_inicio']);
                 $pps-> bindParam(":v_fecha_uso",$_GET['fecha_uso']);
                 $pps-> bindParam(":v_hora_registro",$_GET['hora_registro']);
                 $pps-> bindParam(":v_hora_uso",$_GET['hora_uso']);
                 $pps-> bindParam(":v_monto_totalxx",$_GET['monto_totalxx']);
                 $pps-> bindParam(":v_cantidad_total",$_GET['cantidad_total']);
                 $pps-> bindParam(":v_dni",$_GET['dni']);
                 $pps-> bindParam(":v_nombre",$_GET['nombre']);
                 $pps-> bindParam(":v_direccion",$_GET['direccion']);
                 $pps-> bindParam(":v_correo",$_GET['correo']);
                 $pps-> bindParam(":v_idtipo1",$_GET['idtipo1']);
                 $pps-> bindParam(":v_cantidad1",$_GET['cantidad1']);
                 $pps-> bindParam(":v_monto_total1",$_GET['monto_total1']);
                 $pps-> bindParam(":v_idtipo2",$_GET['idtipo2']);
                 $pps-> bindParam(":v_cantidad2",$_GET['cantidad2']);
                 $pps-> bindParam(":v_monto_total2",$_GET['monto_total2']);
                 $pps-> bindParam(":v_idtipo3",$_GET['idtipo3']);
                 $pps-> bindParam(":v_cantidad3",$_GET['cantidad3']);
                 $pps-> bindParam(":v_monto_total3",$_GET['monto_total3']);
                 $pps-> bindParam(":v_idtipo4",$_GET['idtipo4']);
                 $pps-> bindParam(":v_cantidad4",$_GET['cantidad4']);
                 $pps-> bindParam(":v_monto_total4",$_GET['monto_total4']);
                 $pps-> bindParam(":v_idtipo5",$_GET['idtipo5']);
                 $pps-> bindParam(":v_cantidad5",$_GET['cantidad5']);
                 $pps-> bindParam(":v_monto_total5",$_GET['monto_total5']);
                 $pps-> bindParam(":v_idtipo6",$_GET['idtipo6']);
                 $pps-> bindParam(":v_cantidad6",$_GET['cantidad6']);
                 $pps-> bindParam(":v_monto_total6",$_GET['monto_total6']);
                 $pps-> bindParam(":v_idtipo7",$_GET['idtipo7']);
                 $pps-> bindParam(":v_cantidad7",$_GET['cantidad7']);
                 $pps-> bindParam(":v_monto_total7",$_GET['monto_total7']);
                 $pps-> bindParam(":v_idtipo8",$_GET['idtipo8']);
                 $pps-> bindParam(":v_cantidad8",$_GET['cantidad8']);
                 $pps-> bindParam(":v_monto_total8",$_GET['monto_total8']);
                 $pps-> bindParam(":v_tipopago",$_GET['tipopago']);
                 $pps-> bindParam(":v_n_pago",$_GET['n_pago']);
                 $pps-> bindParam(":v_user",$_GET['user']);
                 $pps->execute();


                $consulta2="CALL mantenimiento_recibo_api (:v_tok,:v_tok2,2,:v_serie,:v_submodulo,
                :v_fecha_inicio,:v_fecha_uso,:v_hora_registro,:v_hora_uso,:v_monto_totalxx,:v_cantidad_total,:v_dni,
                :v_nombre,:v_direccion,:v_correo,:v_idtipo1,:v_cantidad1,:v_monto_total1,
                :v_idtipo2,:v_cantidad2,:v_monto_total2,:v_idtipo3,:v_cantidad3,:v_monto_total3,
                :v_idtipo4,:v_cantidad4,:v_monto_total4,:v_idtipo5,:v_cantidad5,:v_monto_total5,
                :v_idtipo6,:v_cantidad6,:v_monto_total6,:v_idtipo7,:v_cantidad7,:v_monto_total7,:v_idtipo8,:v_cantidad8,:v_monto_total8,
                :v_tipopago,:v_n_pago,:v_user);";


              $pps2=$conexion->getConexion()->prepare($consulta2);
                $pps2-> bindParam(":v_tok",$_GET['tok']);
                $pps2-> bindParam(":v_tok2",$_GET['tok2']);
                $pps2-> bindParam(":v_serie",$_GET['serie']);
                $pps2-> bindParam(":v_submodulo",$_GET['submodulo']);
                 $pps2-> bindParam(":v_fecha_inicio",$_GET['fecha_inicio']);
                 $pps2-> bindParam(":v_fecha_uso",$_GET['fecha_uso']);
                 $pps2-> bindParam(":v_hora_registro",$_GET['hora_registro']);
                 $pps2-> bindParam(":v_hora_uso",$_GET['hora_uso']);
                 $pps2-> bindParam(":v_monto_totalxx",$_GET['monto_totalxx']);
                 $pps2-> bindParam(":v_cantidad_total",$_GET['cantidad_total']);
                 $pps2-> bindParam(":v_dni",$_GET['dni']);
                 $pps2-> bindParam(":v_nombre",$_GET['nombre']);
                 $pps2-> bindParam(":v_direccion",$_GET['direccion']);
                 $pps2-> bindParam(":v_correo",$_GET['correo']);
                 $pps2-> bindParam(":v_idtipo1",$_GET['idtipo1']);
                 $pps2-> bindParam(":v_cantidad1",$_GET['cantidad1']);
                 $pps2-> bindParam(":v_monto_total1",$_GET['monto_total1']);
                 $pps2-> bindParam(":v_idtipo2",$_GET['idtipo2']);
                 $pps2-> bindParam(":v_cantidad2",$_GET['cantidad2']);
                 $pps2-> bindParam(":v_monto_total2",$_GET['monto_total2']);
                 $pps2-> bindParam(":v_idtipo3",$_GET['idtipo3']);
                 $pps2-> bindParam(":v_cantidad3",$_GET['cantidad3']);
                 $pps2-> bindParam(":v_monto_total3",$_GET['monto_total3']);
                 $pps2-> bindParam(":v_idtipo4",$_GET['idtipo4']);
                 $pps2-> bindParam(":v_cantidad4",$_GET['cantidad4']);
                 $pps2-> bindParam(":v_monto_total4",$_GET['monto_total4']);
                 $pps2-> bindParam(":v_idtipo5",$_GET['idtipo5']);
                 $pps2-> bindParam(":v_cantidad5",$_GET['cantidad5']);
                 $pps2-> bindParam(":v_monto_total5",$_GET['monto_total5']);
                 $pps2-> bindParam(":v_idtipo6",$_GET['idtipo6']);
                 $pps2-> bindParam(":v_cantidad6",$_GET['cantidad6']);
                 $pps2-> bindParam(":v_monto_total6",$_GET['monto_total6']);
                 $pps2-> bindParam(":v_idtipo7",$_GET['idtipo7']);
                 $pps2-> bindParam(":v_cantidad7",$_GET['cantidad7']);
                 $pps2-> bindParam(":v_monto_total7",$_GET['monto_total7']);
                 $pps2-> bindParam(":v_idtipo8",$_GET['idtipo8']);
                 $pps2-> bindParam(":v_cantidad8",$_GET['cantidad8']);
                 $pps2-> bindParam(":v_monto_total8",$_GET['monto_total8']);
                 $pps2-> bindParam(":v_tipopago",$_GET['tipopago']);
                 $pps2-> bindParam(":v_n_pago",$_GET['n_pago']);
                 $pps2-> bindParam(":v_user",$_GET['user']);
                $pps2->execute();
            
            //echo json_encode(["usuario" => $pps -> fetchAll(PDO::FETCH_OBJ)]);
            echo json_encode(["TICKET" => $pps -> fetchAll(PDO::FETCH_OBJ),"TICKET_DETALLE" => $pps2 -> fetchAll(PDO::FETCH_OBJ)]);
            } catch (\Throwable $th)  {
                include "informacion.php";
            } finally{
                $conexion->closeDataBase();
            }
        }
    }
    }

    ?>