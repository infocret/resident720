/*!
 * dropdown.js
 * Version: 1.0.0
 *
 * Copyright 2018 InfoCret - Julio Buendia 
 * 
 */
 //$(document).ready(function(){
 	//$('#municipio').hide();
 	// $("#continente").val('1')
 //};
 //
 //
 $( document ).ready(function() {
    //console.log( "ready!" );
    if (action=='create') {    	
	document.getElementById("continente").selectedIndex=2;		// selecciona América
	document.getElementById("pais").selectedIndex=23;			// selecciona 23-México
	document.getElementById("estado").selectedIndex=7;			// selecciona Ciudad de México
	document.getElementById("ciudad").selectedIndex=1;			// selecciona Ciudad de México
	document.getElementById("municipio").selectedIndex=0;		// selecciona Seleccione Municipio
	document.getElementById("asentamiento").selectedIndex=0;	// selecciona Seleccione Asentamiento	
    };
    //alert(action);
});

$("#continente").change(function(event){
	//alert("http://testc1.me/paises/"+$('#continente option:selected').html()+"");  
	//alert(rutax);
		// $.get("http://testc1.me/paises/"+$('#continente option:selected').html()+"",
		 $.get(rutax+"/paises/"+$('#continente option:selected').html()+"",
		 	function(paises,response){		 	
		 	$('#pais').empty();			// vaciar select 
		 	$('#pais').append("<option selected='selected' value=''>Seleccione País</option>"); //agrega place holder o primer opcion
		 			$.each(paises, function( index, value ) {
  						$('#pais').append
  						("<option value='"+value+"'>"+value+"</option>");
					});
				var contvalue = document.getElementById("continente").value;		
			  	//alert("-"+contvalue+"-");
			  	var contkey=$('#continente option:selected').html()+"";
			  	//alert("-"+contkey.trim()+"-");
			if (contvalue==1) {
 		 		//$("#pais").val(22); // Selecciona 22-México si el continente es América
 		 		//alert('america');
 		 		document.getElementById("pais").selectedIndex=23;
 		 		show_ctrls(); 
 		 		}
 		 	else{
 		 		hide_ctrls(); 
			};
			
		 	});
});

  $("#pais").change(function(event){
  	//alert("-"+$('#pais option:selected').html()+"-");
  	var paisvalue = document.getElementById("pais").value;		
  	//alert("-"+paisvalue+"-");
  	var paiskey=$('#pais option:selected').html()+"";
  	//alert("-"+paiskey+"-");

 	if (paisvalue!='México'){
 		//alert("No es mexico"); 
 		hide_ctrls();	
	}
	else{
		//alert("Si es mexico");
		show_ctrls(); 
	}
	
  });

//alert("http://testc1.me/municipios/"+event.target.value+""); 					//obtiene id
//alert("http://testc1.me/municipios/"+$('#estado option:selected').html()+"");  	// obtiene texto			
//$datos=["julio","cesar","noemi"]; 												// ejemplo array

$("#estado").change(function(event){
	//alert("http://testc1.me/ciudades/"+$('#estado option:selected').html()+""); 
	//$.get("/ciudades/"+$('#estado option:selected').html()+"",		
	$.get(rutax+"/ciudades/"+$('#estado option:selected').html()+"",				
 	function(ciudades,response){		 	
 	$('#ciudad').empty();			// vaciar select 
 	$('#ciudad').append("<option selected='selected' value=''>Seleccione Ciudad</option>"); //agrega place holder o primer opcion
 			$.each(ciudades, function( index, value ) {
					$('#ciudad').append
					("<option value='"+index+"'>"+value+"</option>");
			});
 	});		
 	$('#municipio').empty();			// vaciar select 
 	$('#asentamiento').empty();			// vaciar select 
});

$("#ciudad").change(function(event){
	//$.get("/municipios/"+$('#ciudad option:selected').html()+"",
	$.get(rutax+"/municipios/"+$('#ciudad option:selected').html()+"",
		 	function(municipios,response){		 
		 	$('#municipio').empty();			// vaciar select 
		 	$('#municipio').append("<option selected='selected' value=''>Seleccione Municipio</option>"); //agrega place holder o primer opcion
		 			$.each(municipios, function( index, value ) {
  						//alert( index + ": " + value );			// ver lo que trae 
  						//console.log(index + ": " + value);		// enviar al log de la consola
  						$('#municipio').append
  						("<option value='"+index+"'>"+value+"</option>");
  						//<option value="0">Aguascalientes</option>  						
					});
		 	});
	$('#asentamiento').empty();			// vaciar select 
});

///// Usar esta funcion si se recibe un objeto con propiedades obj.prop
$("#municipio").change(function(event){
	//alert("seleciono algo en municipio");
	//$.get("/asentamientos/"+$('#municipio option:selected').html()+"",
	$.get(rutax+"/asentamientos/"+$('#municipio option:selected').html()+"",
		 	function(asentamientos,response){
		 	//alert (response);				
		 	//alert (asentamientos);		
		 	$('#asentamiento').empty();			// vaciar select 
		 	$('#asentamiento').append("<option selected='selected' value=''>Seleccione Asentamiento</option>"); //agrega place holder o primer opcion
		 			$.each(asentamientos, function( index, obj ) {
		 				//alert(index+":"+obj.tipo+"-"+obj.asentamiento+"-"+obj.cp);		 				
  						$('#asentamiento').append
  						("<option value='"+obj.id+"'>"+obj.tipo+"-"+obj.asentamiento+"-CP:"+obj.cp+"</option>");
					});
		 	});
});

///// 
$("#asentamiento").change(function(event){	
	// obtiene el valor o id de una opcion seleccionada
	var cod = document.getElementById("asentamiento").value;		
	// obtiene el texto de una opcion seleccionada
	//var combo = document.getElementById("asentamiento");
 	//var selected = combo.options[combo.selectedIndex].text;
	document.getElementById("codpo_id").value = cod;
	//alert(cod);
	//alert(selected);
});
///// 
$("#slocation").change(function(event){	
	// obtiene el valor o id de una opcion seleccionada
	var cod = document.getElementById("slocation").value;		
	// obtiene el texto de una opcion seleccionada
	//var combo = document.getElementById("asentamiento");
 	//var selected = combo.options[combo.selectedIndex].text;
	document.getElementById("location_id").value = cod;
	//alert(cod);
	//alert(selected);
});

function show_ctrls(){
document.getElementById("estado").style.display = "block";		// selecciona Ciudad de México
document.getElementById("ciudad").style.display = "block";		// selecciona Ciudad de México
document.getElementById("municipio").style.display = "block";	// selecciona Seleccione Municipio
document.getElementById("asentamiento").style.display = "block";// selecciona Seleccione Asentamiento
document.getElementById("lestado").style.display = "block";		// selecciona Ciudad de México
document.getElementById("lciudad").style.display = "block";		// selecciona Ciudad de México
document.getElementById("lmunicipio").style.display = "block";	// selecciona Seleccione Municipio
document.getElementById("lasentamiento").style.display = "block";// selecciona Seleccione Asentamiento
};

function hide_ctrls(){
document.getElementById("estado").style.display = "none";		// selecciona Ciudad de México
document.getElementById("ciudad").style.display = "none";		// selecciona Ciudad de México
document.getElementById("municipio").style.display = "none";	// selecciona Seleccione Municipio
document.getElementById("asentamiento").style.display = "none";	// selecciona Seleccione Asentamiento
document.getElementById("lestado").style.display = "none";		// selecciona Ciudad de México
document.getElementById("lciudad").style.display = "none";		// selecciona Ciudad de México
document.getElementById("lmunicipio").style.display = "none";	// selecciona Seleccione Municipio
document.getElementById("lasentamiento").style.display = "none";	// selecciona Seleccione Asentamiento
};

// <script type="text/javascript">
// function ShowSelected()
// {
// /* Para obtener el valor */
// var cod = document.getElementById("producto").value;
// alert(cod);
 
//  Para obtener el texto 
// var combo = document.getElementById("producto");
// var selected = combo.options[combo.selectedIndex].text;
// alert(selected);
// }
// </script>



///// Usar esta funcion si se recibe un array simple
// $("#municipio").change(function(event){
// 	alert("seleciono algo en municipio");
// 		 $.get("http://testc1.dev/asentamientos/"+$('#municipio option:selected').html()+"",
// 		 	function(asentamientos,response){
// 		 	alert (response);				
// 		 	alert (asentamientos);			
// 		 	$('#asentamiento').empty();			// vaciar select 
// 		 	$('#asentamiento').append("<option selected='selected' value=''>Seleccione Asentamiento</option>"); //agrega place holder o primer opcion
// 		 			$.each(asentamientos, function( index, value ) {
//   						$('#asentamiento').append
//   						("<option value='"+index+"'>"+value+"</option>");
// 					});
// 		 	});
// });
