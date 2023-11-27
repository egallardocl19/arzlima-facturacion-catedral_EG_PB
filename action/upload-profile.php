<?php

//upload file by abisoft https://github.com/amnersaucedososa 
include "../config/config.php";
include "../head2.php";


if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    $name = $file["name"];
    $type = $file["type"];
    $tmp_n = $file["tmp_name"];
    $size = $file["size"];
    $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
    $fecha = $timestamp->format('Y-m-d H:i:s');
	//$fecha= date('d-m-Y');
	//$fecha=new DateTime();
    $folder = "../images/profiles/";  //AQUI SE MODIFICA EN SERVIDOR LINUX: /var/www/ticket/images/profiles/
 	// dar privilegios de modificar sudo chown www-data upload
	
    if ($type != 'image/jpg' && $type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif')
    {
      echo "Error, el archivo no es una imagen"; 
    }
    else if ($size > 3000*4000)
    {
      echo "Error, el tamaño máximo permitido es un 1MB";
    }
    else
    {
      $src = $folder.$fecha.$name;
      // $src = $folder.$fecha->format('YmdHis').$name;
   $newname=$fecha.$name;
       @move_uploaded_file($tmp_n, $src);
		
       $query=mysqli_query($con, "UPDATE user set profile_pic=\"$newname\" where codigo=\"$id2\"");
       if($query){
        echo "<div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>¡Bien hecho!</strong> Perfil Actualizado Correctamente
        </div>";
       }
    }
}