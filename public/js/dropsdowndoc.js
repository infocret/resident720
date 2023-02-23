/*!
 * dropdowndoc.js
 * Version: 1.0.0
 *
 * Copyright 2018 InfoCret - Julio Buendia 
 * 
 */

$("#reltipo_id").change(function(event){
	//alert("http://testc1.me/listadoc/"+$('#reltipo_id option:selected').html()+"");  
	var trel = document.getElementById("reltipo_id").value;
	//alert("http://testc1.me/listadoc/"+trel+"");  
	//alert("-"+trel+"-");
		 $.get(rutax+"/listadoc/"+trel+"",
		 	function(ldocs,response){		 	
		 	$('#doctype_id').empty();			// vaciar select 
		 	$('#doctype_id').append("<option selected='selected' value=''>Seleccione tipo de Docomento</option>"); //agrega place holder o primer opcion
		 			$.each(ldocs, function( index, obj ) {
  						$('#doctype_id').append
  						//alert(index+"-"+value);
  						("<option value='"+obj.id+"'>"+obj.nombre+"</option>");
					});
				//alert("tiene"+$("#doctype_id").find("option").length);
				var N = $("#doctype_id").find("option").length;	// Cuantas opciones tiene
				if (N==1) {    									// Si solo tiene uno es el place holder
					$('#doctype_id').empty();					// vaciar select 
		 			$('#doctype_id').append("<option selected='selected' value=''>No hay Documentos para esta relacion</option>"); //agrega place holder o primer opcion
				};

		 	});
});
