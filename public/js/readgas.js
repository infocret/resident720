/*!
 * readgas.js
 * Version: 1.0.0
 *
 * Copyright 2018 InfoCret - Julio Buendia 
 * 
 * Calculo de consumo en lectura de gas
 */

//************************************************************
 $( document ).ready(function() {
    //console.log( "ready!" );
    //if (action=='create') {
    //};
    //alert(numunids);
    //alert(lectant);
    //alert(gasprice);
    //var codh = '';					//inicializa cadena para fila
    //alert($("current_reading").val);
    //codh = generar();
	//codh = validar();				//llama funcion que crea html de fila	
	//alert(codh);
});

	
 $("#lactual").on("change keyup paste click", function(){
	//alert($(this).val());
	$('#quantity').val($('#lactual').val() - lectant ) ;
	$("#amount").val($('#quantity').val() * gasprice);	
 });		
	


