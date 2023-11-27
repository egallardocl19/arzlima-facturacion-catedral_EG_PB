<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['anio_rat'])){
			$errors[] = "Año vacío"; 
	
		} else if (empty($_POST['idmes_rat'])){
			$errors[] = "Mes vacío";
		
		} else if (
			
			!empty($_POST['anio_rat']) &&
			!empty($_POST['idmes_rat'])
		){


		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$anio = trim($_POST["anio_rat"]);
		$mes = $_POST["idmes_rat"];
		$dia_actual=date("d"); 
		$mes_actual = date("m"); 
		$anio_actual=date("Y");

	
		
		
		
		$iduser_add = $_SESSION['user_id'];
		$fecha_add = date("Y-m-d");

		if ($mes=='01'){
			$nombremes='ENERO';
		}elseif ($mes=='02'){
			$nombremes='EBRERO';
		}elseif ($mes=='03'){
			$nombremes='MARZO';
		}elseif ($mes=='04'){
			$nombremes='ABRIL';
		}elseif ($mes=='05'){
			$nombremes='MAYO';
		}elseif ($mes=='06'){
			$nombremes='JUNIO';
		}elseif ($mes=='07'){
			$nombremes='JULIO';
		}elseif ($mes=='08'){
			$nombremes='AGOSTO';
		}elseif ($mes=='09'){
			$nombremes='SETIEMBRE';
		}elseif ($mes=='10'){
			$nombremes='OCTUBRE';
		}elseif ($mes=='11'){
			$nombremes='NOVIEMBRE';
		}elseif ($mes=='12'){
			$nombremes='DICIEMBRE';
		}else {
			$nombremes='FALTA SELECCIONAR';
		}

		
			if (($anio-$anio_actual)==0){
				if (($mes-$mes_actual)==0){

					/////////////////////////////////
					$sql2 =mysqli_query($con, "select * from contabilidad_concar_registros  where mes='$mes' and anio='$anio'");
					if (!$sql2|| mysqli_num_rows($sql2)!=0){
						
						$delete=mysqli_query($con,"DELETE FROM contabilidad_concar_registros WHERE mes='$mes' and anio='$anio' and n_comprobante>0");
						$sql="insert into contabilidad_concar_registros(select '', LPAD((@i := @i +1)+(SELECT n_comprobante FROM contabilidad_concar_registros 
						where id=(select max(id) from contabilidad_concar_registros)),4,'0') as codigo,(select date_format(fecha_recibo, '%m') 
						from recibos where tipo_recibo=r.tipo_recibo and codigo_recibo=r.codigo_recibo) as mes,(select date_format(fecha_recibo, '%Y') 
						from recibos where tipo_recibo=r.tipo_recibo and codigo_recibo=r.codigo_recibo) as anio,concat('ALQUILER ', 
						case (select date_format(fecha_recibo, '%m') from recibos where tipo_recibo=r.tipo_recibo and codigo_recibo=r.codigo_recibo) 
						WHEN 01 THEN 'ENERO' WHEN 02 THEN 'FEBRERO' WHEN 03 THEN 'MARZO' WHEN 04 THEN 'ABRIL' WHEN 05 THEN 'MAYO' WHEN 06 THEN 'JUNIO'
						WHEN 07 THEN 'JULIO' WHEN 08 THEN 'AGOSTO' WHEN 09 THEN 'SEPTIEMBRE' WHEN 10 THEN 'OCTUBRE' WHEN 11 THEN 'NOVIEMBRE'
						WHEN 12 THEN 'DICIEMBRE' END,' ',(select date_format(fecha_recibo, '%Y') from recibos where tipo_recibo=r.tipo_recibo and 
						codigo_recibo=r.codigo_recibo)) as glosa,cc.id as idcontabilidad_concar,r.tipo_recibo,r.codigo_recibo,'$iduser_add','$fecha_add',null,null,null,null 
						from contabilidad_concar cc, recibos r cross join (select @i := 0) r where cc.idadministrado=
						(select idadministrado from contratos where codigo_contrato=r.codigo_contrato) and cc.idtipo_moneda=
						(select DISTINCT(idtipo_moneda) from recibos_detalle where tipo_recibo=r.tipo_recibo and codigo_recibo=r.codigo_recibo)and 
						cc.tipo_cuenta='D' and r.tipo_recibo='RAP' and date_format(r.fecha_recibo, '%m')='$mes' and date_format(r.fecha_recibo, '%Y')='$anio' order  by r.codigo_recibo)";


						$query_new_insert = mysqli_query($con,$sql);

						if ($query_new_insert){
							$messages[] = "Los registros del Mes ".$nombremes." fue generado satisfactoriamente.";
																	
						} else{
							$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
						}
					}else{
						
						
						
						$sql="insert into contabilidad_concar_registros(select '', LPAD((@i := @i +1)+(SELECT n_comprobante FROM contabilidad_concar_registros 
						where id=(select max(id) from contabilidad_concar_registros)),4,'0') as codigo,(select date_format(fecha_recibo, '%m') 
						from recibos where tipo_recibo=r.tipo_recibo and codigo_recibo=r.codigo_recibo) as mes,(select date_format(fecha_recibo, '%Y') 
						from recibos where tipo_recibo=r.tipo_recibo and codigo_recibo=r.codigo_recibo) as anio,concat('ALQUILER ', 
						case (select date_format(fecha_recibo, '%m') from recibos where tipo_recibo=r.tipo_recibo and codigo_recibo=r.codigo_recibo) 
						WHEN 01 THEN 'ENERO' WHEN 02 THEN 'FEBRERO' WHEN 03 THEN 'MARZO' WHEN 04 THEN 'ABRIL' WHEN 05 THEN 'MAYO' WHEN 06 THEN 'JUNIO'
						WHEN 07 THEN 'JULIO' WHEN 08 THEN 'AGOSTO' WHEN 09 THEN 'SEPTIEMBRE' WHEN 10 THEN 'OCTUBRE' WHEN 11 THEN 'NOVIEMBRE'
						WHEN 12 THEN 'DICIEMBRE' END,' ',(select date_format(fecha_recibo, '%Y') from recibos where tipo_recibo=r.tipo_recibo and 
						codigo_recibo=r.codigo_recibo)) as glosa,cc.id as idcontabilidad_concar,r.tipo_recibo,r.codigo_recibo,'$iduser_add','$fecha_add',null,null,null,null 
						from contabilidad_concar cc, recibos r cross join (select @i := 0) r where cc.idadministrado=
						(select idadministrado from contratos where codigo_contrato=r.codigo_contrato) and cc.idtipo_moneda=
						(select DISTINCT(idtipo_moneda) from recibos_detalle where tipo_recibo=r.tipo_recibo and codigo_recibo=r.codigo_recibo)and 
						cc.tipo_cuenta='D' and r.tipo_recibo='RAP' and date_format(r.fecha_recibo, '%m')='$mes' and date_format(r.fecha_recibo, '%Y')='$anio' order  by r.codigo_recibo)";


						$query_new_insert = mysqli_query($con,$sql);

						if ($query_new_insert){
							$messages[] = "Los registros del Mes ".$nombremes." fue generado satisfactoriamente.";
																	
						} else{
							$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
						}
					}
				}else{
					$errors []= "El Mes (.$nombremes.) no es aceptable para la generación de registro.";
					}	
			}else{
				$errors []= "El Periodo ($anio) no es aceptable para la generación de registro.";
			}			
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
		
?>