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
    var codh = '';					//inicializa cadena para fila
	codh = validar();				//llama funcion que crea html de fila	
	//alert(codh);
});


//***************************************************************************
// Valida que se tenga el numero correcto de unidades y que la suma de indivisos sea entre 99.9 y 100.9
// 
function validar(){
//Obtiene el formulario con id = "form1"	
var formulario = document.getElementById("form1");	
// Obtiene los elementos que tengan tagname = "input" 
//var CamposInput = formulario.getElementsByTagName("input"); 

//Obtiene los elementos de un array de inputs que tenga nombre=monto
var CamposInput = formulario.querySelectorAll("input[name^='indiv[']")
// obtiene el boton
var botonsave = document.getElementById("bsave");	
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
	// si el input es de tipo numerico osea los campos de indivisos	
	if(CamposInput[i].type == "number") { 
		vsuma += parseFloat(CamposInput[i].value,8); 			//sumatoria 
		cunid += 1;												//contador parseInt(cunid)
		//alert(CamposInput[i].value);	
	}
	//if(elem[i].value=="" || elem[i].value==" "){
	//++errors;
}
//alert(cunid);
//alert(vsuma);
vsuma = parseFloat(vsuma,8); 

vsuma = toFixed(vsuma,8);


// Si se cuentan mas unidades de las declaradas
if (cunid > numunids || cunid < numunids){
document.getElementById('lnunid').innerHTML = "[X] Unidades: " + cunid + " de " + numunids + " Declaradas";
vstat = 1;
}
// Si se cuentan menos unidades de las declaradas
// if (cunid < numunids){
// document.getElementById('lnunid').innerHTML = "[X] Unidades: " + cunid + " de " + numunids + " Declaradas";
// vstat = 1;	
// }
// Si se cuentan unidades igual a las declaradas
if (cunid == numunids){
document.getElementById('lnunid').innerHTML = "Unidades: " + cunid + " de " + numunids + " Declaradas";
}

if (vsuma < 99.1 || vsuma > 100.9  ){
document.getElementById('lindiv').innerHTML = "[X] Suma de Indivisos: " + vsuma;
vstat = 1;
}

// if (vsuma > 100.9 ){
// document.getElementById('lindiv').innerHTML = "[X] Suma de Indivisos: " + vsuma;
// vstat = 1;
// }

if (vsuma > 99.1 && vsuma < 100.9 ){
document.getElementById('lindiv').innerHTML = "Suma de Indivisos: " + vsuma;
}

document.getElementById('totindiv').value = vsuma;

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
