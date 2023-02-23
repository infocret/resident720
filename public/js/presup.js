/*!
 * indivisos.js
 * Version: 1.0.0
 *
 * Copyright 2018 InfoCret - Julio Buendia 
 * sample:
 */

//************************************************************
 $( document ).ready(function() {
    //console.log( "ready!" );
    //if (action=='create') {
    //};
    //alert(numunids);
    var codh = '';					//
	codh = validar();				//Suma cantidades actuales
	//alert(codh);
});


//***************************************************************************
// Suma las cantidades y genera presupuesto
// 
function validar(){
//Obtiene el formulario con id = "form1"	
var formulario = document.getElementById("form1");	
//Obtiene el texto con id = "total"	
var ttotal = document.getElementById("total");	
// Obtiene los elementos que tengan tagname = "input" 
//var CamposInputB = formulario.getElementsByTagName("input"); 

//Obtiene los elementos de un array de inputs que tenga nombre=monto
var CamposInput = formulario.querySelectorAll("input[name^='monto[']")

// sumatoria de valores
var vsuma = 0;
//contador de unidades
var cunid = 0;
// status de validacion 0 = OK 
var vstat = 0;
//var msje = document.getElementById('lnunid').innerHTML;
//alert(msje);
// cuantos campos input encontro
//alert (CamposInput.length);

// Barre los campos input encontrados
for(i=0; i<CamposInput.length; i++){
	// si el input es de tipo numerico osea los campos de monto	
	if(CamposInput[i].type == "number") { 
		vsuma += parseFloat(CamposInput[i].value,10); 			//sumatoria 
		cunid += 1;												//contador parseInt(cunid)
		//alert(CamposInput[i].value);	
	}	
}
//alert(cunid);
//alert(vsuma);
vsuma = parseFloat(vsuma,5); 

ttotal.value = toFixed(vsuma,2);

return vstat;
}

// Ajusta los decimales de un nuero float a el numero de decimales que se pida
function toFixed(value, precision) {
    var power = Math.pow(10, precision || 0);
    return String(Math.round(value * power) / power);
}
