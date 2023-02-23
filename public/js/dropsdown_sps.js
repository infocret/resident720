/*!
 * dropdownsps.js
 * Version: 1.0.0
 *
 * Copyright 2018 InfoCret - Julio Buendia 
 * 
 */
 //$(document).ready(function(){ 	
 //};

 $( document ).ready(function() {
    //console.log( "ready!" );
    if (action=='create') {    	
	document.getElementById("lconceptservice_id").style.display = "none";// hide control	
    document.getElementById("conceptservice_id").style.display = "none";// hide control
    document.getElementById("lcatmovto_id").style.display = "none";// hide control
    document.getElementById("catmovto_id").style.display = "none";// hide control
    }
    else{
	document.getElementById("lconceptservice_id").style.display = "block";// show control	
	document.getElementById("conceptservice_id").style.display = "block";// show control 
	document.getElementById("lcatmovto_id").style.display = "block";// show control
	document.getElementById("catmovto_id").style.display = "block";// show control	   	
    }
    //alert(action);
});

//*****  Al seleccionar condominio ******
$("#inmueble_id").change(function(event){
$condomid = document.getElementById("inmueble_id").value;
document.getElementById("conceptservice_id").selectedIndex=0; //sin seleccion
if ($condomid !='') {
	document.getElementById("lconceptservice_id").style.display = "block";// show control	
	document.getElementById("conceptservice_id").style.display = "block";// show control				
}
else {
	document.getElementById("lconceptservice_id").style.display = "none";// hide control
	document.getElementById("conceptservice_id").style.display = "none";// hide control	
	document.getElementById("movto_cve").value = "";	
	document.getElementById("concept_cve").value ="";
}
$('#catmovto_id').empty();			// vaciar select 
document.getElementById("lcatmovto_id").style.display = "none";// hide control	
document.getElementById("catmovto_id").style.display = "none";// hide control	
});


//***** AL seleccionar concepto/servicio  *****
$("#conceptservice_id").change(function(event){
//alert(document.getElementById("inmueble_id").value);
$cveConcept = $('#conceptservice_id option:selected').html();
idx = $cveConcept.indexOf("-") ;
document.getElementById("concept_cve").value =$cveConcept.substring(0,idx);

$concept = document.getElementById("conceptservice_id").value;
document.getElementById("catmovto_id").selectedIndex=0; //sin seleccion

if ($concept !='') {
document.getElementById("lcatmovto_id").style.display = "block";// show control
document.getElementById("catmovto_id").style.display = "block";// show control

$.get(rutax+"/procedmovtos/getmovs/"+document.getElementById("inmueble_id").value
+"/"+document.getElementById("conceptservice_id").value+"",
 	function(movtos,response){
 	//alert (response);				
 	//alert (movtos);		
 	$('#catmovto_id').empty();			// vaciar select 
 	$('#catmovto_id').append("<option selected='selected' value=''>Seleccione Movimiento</option>"); //agrega place holder o primer opcion
	$.each(movtos, function( index, obj ) {
		//alert(obj.movtocve+"-"+obj.movtodesc+"|"+obj.fechaaplica);		 				
		$('#catmovto_id').append
		("<option value='"+obj.id+"'>"
		+obj.movtocve+"-"+obj.movtodesc+"|"+obj.fechaaplica+"</option>");
	});
 	});
}
else {	
	$('#catmovto_id').empty();			// vaciar select 
	document.getElementById("lcatmovto_id").style.display = "none";// hide control	
	document.getElementById("catmovto_id").style.display = "none";// hide control
	document.getElementById("movto_cve").value = "";	
}

});

// ***** Al seleccionar movimiento  ******
$("#catmovto_id").change(function(event){
$movto = $('#catmovto_id option:selected').html();
idx = $movto.indexOf("-") ;
document.getElementById("movto_cve").value =$movto.substring(0,idx);
});

