<?php
	
	require ('../config/config.php');
	
	$idsubmodulo = $_POST['idsubmodulo']; 
	
	$dato =mysqli_query($con, "SELECT sp.idpermisos as idpermisos,sp.nombre as nombre_permiso,ss.idsubmodulo as idsubmodulo,ss.nombre
	as nombre_submodulo 
	FROM seguridad_permisos sp,seguridad_submodulo ss where sp.idsubmodulo=ss.idsubmodulo 
	and sp.idestado_dato=1 and ss.idsubmodulo='$idsubmodulo' order by sp.idpermisos;");


	$html= "<option value='0'>----Seleccionar Permisos----</option>  ";
	$html.= "<option value='1'>TODOS LOS PERMISOS</option>  ";
	
		while($rowM = $dato->fetch_assoc())
		{
			$html.= "<option value='".$rowM['idpermisos']."'>".$rowM['nombre_permiso']." - Registros: ".$rowM['nombre_submodulo']."</option>";
		}

		echo $html;
			

?>		