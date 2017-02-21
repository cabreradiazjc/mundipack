
window.onload = function(){
	mostrarDatos();	
}

function mostrarDatos(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listarSocios'},
		url: '../../../controller/controlusuario/usuario.php',
		success: function(respuesta){
			$('#socios').DataTable().destroy();
			$('#cuerpoTablaSocios').html(respuesta);
			$('#socios').DataTable();
		},
		error: function(respuesta){
			$('#cuerpoTablaSocios').html(respuesta);
		}
	});	
}



