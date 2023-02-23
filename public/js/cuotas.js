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
    //var codh = '';					//inicializa cadena para fila
    //codh = generar();
	//codh = validar();				//llama funcion que crea html de fila	
	//alert(codh);
});


//***************************************************************************
// Realiza sumatoria de cuotas para comparar con total de presupuesto
// 
function validar(){
//Obtiene el formulario con id = "form1"	
var formulario = document.getElementById("form1");	
// Obtiene los elementos que tengan tagname = "input" 
//var CamposInput = formulario.getElementsByTagName("input"); 

//Obtiene los elementos de un array de inputs que tenga nombre=monto
var CamposInput = formulario.querySelectorAll("input[name^='cuota[']")
// obtiene el boton
var botonsave = document.getElementById("bsave");	
// sumatoria de valores
var vsuma = 0;
//contador de unidades
var cunid = 0;
//Diferencia entre sumatoria y presupuesto
var dif = 0;
// status de validacion 0 = OK 
var vstat = 0;
//var msje = document.getElementById('lnunid').innerHTML;
//alert(msje);
// cuantos campos input encontro
//alert (CamposInput.length);

// Barre los campos input encontrados
for(i=0; i<CamposInput.length; i++){
	// si el input es de tipo numerico osea los campos de indivisos	
	if(CamposInput[i].type == "number") { 
		vsuma += parseFloat(CamposInput[i].value,2); 			//sumatoria 
		cunid += 1;												//contador parseInt(cunid)
		//alert(CamposInput[i].value);	
	}
	//if(elem[i].value=="" || elem[i].value==" "){
	//++errors;
}
//alert(cunid);
//alert(vsuma);
vsuma = parseFloat(vsuma,2); 

vsuma = toFixed(vsuma,2);

document.getElementById('lsuma').innerHTML = "Sumatoria: $ " + vsuma;

document.getElementById('totcuotas').value = vsuma;

dif = tpresup - vsuma;

if (dif > 100 || dif < -100){
vstat = 1;
}

// dependiendo del status oculta o muestra boton de guardar
if (vstat == 1){
	botonsave.style.visibility = 'hidden';
	botonsave.disabled = true;
}
else
{
	botonsave.style.visibility = 'visible';
	botonsave.disabled = false;
}

return vstat;
}

// Ajusta los decimales de un nuero float a el numero de decimales que se pida
function toFixed(value, precision) {
    var power = Math.pow(10, precision || 0);
    return String(Math.round(value * power) / power);
}


//********************* Genera las coutas una a una con la formula *******************
// a) Cuota = (indiviso1 * TotPresupuesto) / 100
// b) Cuota = (indiviso1/100) * TotPresupuesto

function generar() {

var tpres = tpresup;
var cuota = 0;

//Obtiene el formulario con id = "form1"	
var formulario = document.getElementById("form1");	
//Obtiene los elementos de arrays de inputs 
var Indivs = formulario.querySelectorAll("input[name^='idiv1[']")	
var Cuotas = formulario.querySelectorAll("input[name^='cuota[']")

// Barre los campos indivisos encontrados
for(i=0; i<Indivs.length; i++){		
	cuota = (Indivs[i].value/100)*tpres; 			//Calcula Cuota
	cuota = toFixed(cuota,2);						//Ajusta decimales 
	Cuotas[i].value=cuota;							//Asigna Cuota
}
validar();	
alert("Cuotas generadas!");
}



// function barretabla() {
// var tabla2 = document.getElementById("propertyvalues-table");
// var tdsTabla2 = tabla2.getElementsByTagName("td");
// var i =0;
// for (i=0; i<tdsTabla2.length; i++){
// //alert(tdsTabla2[i].innerHTML);
// } 
// }