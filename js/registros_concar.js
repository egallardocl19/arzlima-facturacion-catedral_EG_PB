$(document).ready(function(){
	load(1);
});

function load(page){
	var q= $("#q").val();
	
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/registros_concar.php?action=ajax&page='+page+'&q='+q,
		beforeSend: function(objeto){
			$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})

	

	

}




function eliminar (codigo_recibo)
{
	var q= $("#q").val();
	
	if (confirm("Realmente deseas anular el recibo?")){	
		$.ajax({
			type: "GET",
			url: "./ajax/registros_concar.php",
			data: "codigo_recibo="+codigo_recibo,"q":q,
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

