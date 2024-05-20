$(document).ready(function(){
	load(1);
	load2(1);
});

function load(page){
	var q= $("#q").val();
	
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/recibos.php?action=ajax&page='+page+'&q='+q,
		beforeSend: function(objeto){
			$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})

}

function load2(page){
	var q= $("#qq").val();
	
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/recibos2.php?action=ajax&page='+page+'&qq='+q,
		beforeSend: function(objeto){
			$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div2").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})

}

function carga_recibo_contable(qq){
	
	var q= qq;
	
	
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/recibos_contables_listado.php?action=ajax&qq='+qq+'&q='+q,
		beforeSend: function(objeto){
			$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_divdetalle").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})

}



function eliminar (id)
{
	var q= $("#q").val();
	
	if (confirm("Realmente deseas anular el recibo?")){	
		$.ajax({
			type: "GET",
			url: "./ajax/recibos.php",
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

function eliminar2 (id)
{
	var q= $("#q").val();
	
	if (confirm("Realmente deseas anular el recibo?")){	
		$.ajax({
			type: "GET",
			url: "./ajax/recibos2.php",
			data: "id="+id,"q":q,
			beforeSend: function(objeto){
				$("#resultados2").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#resultados2").html(datos);
				load2(1);
			}
		});
	}

	
}
