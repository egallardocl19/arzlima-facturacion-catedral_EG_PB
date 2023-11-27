<?php
    session_start();
   
?>
<?php 

	$id2=$_SESSION['user_id'];
    $query2=mysqli_query($con,"SELECT * from user where id=$id2");
    while ($row=mysqli_fetch_array($query2)) {
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

?>