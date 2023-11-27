<?php
	
	require ('../config/config.php');
	
	$idsubmodulo = $_POST['idsubmodulo']; 
	
	$dato =mysqli_query($con, "SELECT ss.idsubmodulo,ss.nombre as nombre_submodulo,sm.idmodulo,sm.nombre as nombre_modulo 
	FROM seguridad_submodulo ss, seguridad_modulo sm where ss.idmodulo=sm.idmodulo and ss.idsubmodulo='$idsubmodulo'");
	
		while($rowM = $dato->fetch_assoc())
		{
			$html.= "<option value='".$rowM['idsubmodulo']."'>".'MODULO: '.$rowM['nombre_modulo']." - SUBMODULO: ".$rowM['nombre_submodulo']."</option>";
		}

		echo $html;
			

?>		