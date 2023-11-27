$(document).ready(function(){
	load(1);
	

});

function load(page){
	var q= $("#q").val();
	
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/permisos.php?action=ajax&page='+page+'&q='+q,
		beforeSend: function(objeto){
			$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})

	

	

}


function load2(page,qq){
	
	var q= qq;
	
	
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/permisos_roles.php?action=ajax&page='+page+'&qq='+qq+'&q='+q,
		beforeSend: function(objeto){
			$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div_roles").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})

}




function eliminar (codigo_submodulo,id_codigoroles)
{
	var q= $("#q").val();
	
	if (confirm("Realmente deseas borrar el registro?")){	
		$.ajax({
			type: "GET",
			url: "./ajax/permisos_roles.php",
			data: "id_codigoroles="+id_codigoroles,"q":q,
			beforeSend: function(objeto){
				$("#result_rol").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#result_rol").html(datos);
				load2(1,codigo_submodulo);
			}
		});
	}

	
}


function editar (id)
{
	var q= $("#q").val();
	
	if (confirm("Realmente deseas editar el registro?")){	
		$.ajax({
			type: "GET",
			url: "./ajax/permisos.php",
			data: "id="+id,"q":q,
			beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#resultados").html(datos);
				load(1);
			}
		});
	}

	
}


function editar_roles (id,idsubmodulo)
{
	var q= $("#q").val();
	
	if (confirm("Realmente deseas editar el registro?")){	
		$.ajax({
			type: "GET",
			url: "./ajax/permisos_roles.php",
			data: "id="+id,"q":q,
			beforeSend: function(objeto){
				$("#result_rol").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#result_rol").html(datos);
				load2(1,idsubmodulo);
			}
		});
	}

	
}
