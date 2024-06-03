$(document).ready(function(){
	load(1);
	load2(1);
	load3(1);
});

function load(page){
	var q= $("#q").val();
	var q1= $("#q1").val();
	var q2= $("#q2").val();
	
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/recibos.php?action=ajax&page='+page+'&q='+q+'&q1='+q1+'&q2='+q2,
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
	var qq= $("#qq").val();
	var qq1= $("#qq1").val();
	var qq2= $("#qq2").val();
	
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/recibos2.php?action=ajax&page='+page+'&qq='+qq+'&qq1='+qq1+'&qq2='+qq2,
		beforeSend: function(objeto){
			$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div2").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})

}

function load3(page){
	var qqq= $("#qqq").val();
	var qqq1= $("#qqq1").val();
	var qqq2= $("#qqq2").val();
	
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/recibos3.php?action=ajax&page='+page+'&qqq='+qqq+'&qqq1='+qqq1+'&qqq2='+qqq2,
		beforeSend: function(objeto){
			$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div3").html(data).fadeIn('slow');
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
