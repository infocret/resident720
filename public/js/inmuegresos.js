/*!
 * inmuegresos.js
 * Version: 1.0.0
 *
 * Copyright 2018 InfoCret - Julio Buendia 
 * sample: http://fivemedia.com.ar/dexter/test221.php
 */

//************************************************************
$( document ).ready(function() { 
	//document.getElementById('idoc').hidden = true; 
	if(action == 'create' ){
		AddItem() ;			
	} 
	else{
		if(contiene(fileexist,'.pdf')){		
		  canceldeletefile();
		}
		else{			
		  deletefile();
		  document.getElementById("icanceldel").style.display = "none";	
		}
	}

	setmodo(imodo);
   	
});
// ******************************* Establece el modo de trabajo **********************************
function setmodo(imod){

	if (imod!=2) {
		imodo = imod;
	}

	if (imodo==0) { 
		$("#nuevotot").hide();
		$("#pmode1").hide();
		$("#ilgtotal").show();		
		$("#pmode0").show();
	}
	if (imodo==1) { 
		$("#nuevotot").show();
		$("#pmode0").hide();
		$("#ilgtotal").hide();	
		$("#pmode1").show();
			
	}	
}

// ******************************* Clic en select de inmueble **********************************
$("#inmu_id").change(function(event){	
//console.log(rutax+"/egresos/getconcepts/"+document.getElementById("inmu_id").value);
//alert('Listo');

// Actualiza lista de conceptos que ese cond o unidad tienen en contrato
 $.get(rutax+"/egresos/getconcepts/"+document.getElementById("inmu_id").value+"",
 	function(concepts,response){	
 	//console.log(concepts); 	 	
 	$('#conceptserv_id').empty();	// vaciar select 
 	//agrega place holder o primer opcion
 	$('#conceptserv_id').append("<option  value=''>Seleccione Concepto</option>"); 
	$.each(concepts, function( index, obj ) {
		//console.log(obj.cve+"-"+obj.name);
		if (index == 0) {
 		 $('#conceptserv_id').append
		 ("<option selected='selected' value='"+obj.id+"'>"+obj.cve+"-"+obj.name+"</option>");
		 getmovs(obj.id);	
		}
		else{
		 $('#conceptserv_id').append
		 ("<option value='"+obj.id+"'>"+obj.cve+"-"+obj.name+"</option>");
		}		
	});
 	});  
 	
 	

});

// ******************************* Clic en select de concepto *********************************

$("#conceptserv_id").change(function(event){
//alert (this.value);	
	getmovs(this.value)	;
});  


//********************************************************************************************
function getmovs(val)
{
	//console.log (rutax+"/egresos/getmovtos/"+document.getElementById("inmu_id").value+
 	//"/"+document.getElementById("conceptserv_id").value);
 	var inmuid = document.getElementById("inmu_id").value;
 	var conceptid = val;//document.getElementById("conceptserv_id").value;
 $.get(rutax+"/egresos/getmovtos/"+inmuid+"/"+conceptid+"",
 	function(tmovtosb,response){	 	
 	
 	 $.each(tmovtosb, function( index, obj ) {
 	 console.log(obj.cve); 	 	
 	 });
 	tmovtos = tmovtosb;
 	ClearAll();
 	 	
	});

};

//********************************************************************************************

function contiene(texto, buscado) {
    return ~texto.indexOf(buscado)
};
//************************************************************
//  	Valida que solo se capturen numeros en el campo
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9-.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}



// *****************************************************************************
// 		Recalcula dependiendo de el modo activo
function recalc(){
	if (imodo==0) { totales(); }
	if (imodo==1) { 
		var etotv = document.getElementById('nuevotot');	
		var totv = etotv.value;
		total(totv); 
	}
}

// *****************************************************************************
// 		Calcula por fila :  Cantidad * Precio y lo coloca en Subtotal
function Calcular(ele) {
	var cant = 0, precio = 0, stotal = 0;
	var tr = ele.parentNode.parentNode;	// identifica la fila o row de la tabla
	cant = parseFloat(tr.getElementsByTagName('input')[0].value,10); //identifica input de cant	
	precio = parseFloat(tr.getElementsByTagName('input')[2].value,10); // identifica input de precio
	stotal = parseFloat((cant*precio),10); // realiza operacion
	tr.getElementsByTagName('input')[3].value =  stotal ; //asigna valor a campo
	// console.log(tr.getElementsByTagName('input')[0].value);
	// console.log(tr.getElementsByTagName('input')[1].value);
	// console.log(tr.getElementsByTagName('input')[2].value);
	// console.log(tr.getElementsByTagName('input')[3].value);
	recalc(); // llama a la funcion de calculo de total
}

//******************************************************************************
//			Barre la columna subtotal de la tabla y suma los montos, 
//			calcula IVA y calcula el gran total
function totales(){	
	var importe_total = 0;
	var iva = 0;
	var gtotal = 0;

	jQuery("input[name='subtotal[]']").each(function() {
		importe_total += parseFloat(this.value,10);	  
	});

	document.getElementById("idstotal").value=importe_total;

	var labstotal = document.getElementById('ilstotal');	
	labstotal.innerHTML = MASK(labstotal,importe_total,'-$###,###,##0.00',1);

	var checkBox = document.getElementById("ichiva");    
    if (checkBox.checked == true){ 
	iva =parseFloat((importe_total*variva),10); //usa la variable variva enviada desde vista create
    } else {  
   	iva = 0;    
    }		

	var labiva = document.getElementById('iliiva');	
	labiva.innerHTML = MASK(labiva,iva,'-$###,###,##0.00',1);

	//iva =parseFloat((importe_total*variva),10); //usa la variable variva enviada desde vista create
	document.getElementById("iiva").value=iva;
	gtotal =parseFloat((importe_total+iva),10);
	document.getElementById("igtotal").value=gtotal;

	var labgtot = document.getElementById('ilgtotal');	
	labgtot.innerHTML = MASK(labgtot,gtotal,'-$###,###,##0.00',1);	

	document.getElementById('balance').value = gtotal;
	document.getElementById('nuevotot').value = gtotal;

	setmodo(2); //establece modo a modo actual
	
}

// ******************************* Cambio en el total *********************************
$("#nuevotot").change(function(event){
	var imp_total=0;
	imp_total = this.value;
 	total(imp_total);
});

//******************************************************************************
//	Total inverso: Calcula a partir de un total los valores de iva subtotal etc
//			
function total(imptot){
	var iva = 0;
	var subtotal = 0;
	var sidatt = '';
	//iva = imptot; 
 	//alert(imptot);
 	// calcula subtotal = imptot/(variva+1)
	subtotal = parseFloat((imptot/(variva+1)),10);
	//alert(subtotal);
	// revisa si aplica y calcula iva = imptot-iva
	var checkBox = document.getElementById("ichiva");    
    if (checkBox.checked == true){ 
	iva = parseFloat((imptot-subtotal),10) ; //usa la variable variva enviada desde vista create
    } else {  
   	iva = 0;    
    }		
    //alert(iva);
    // asigna valor a etiqueta de iva
	var labiva = document.getElementById('iliiva');	
	labiva.innerHTML = MASK(labiva,iva,'-$###,###,##0.00',1);
	// asigna valor a etiqueta de subtotal
	var labstot = document.getElementById('ilstotal');	
	labstot.innerHTML = MASK(labstot,subtotal,'-$###,###,##0.00',1);

	//identifica que fila quedo activa, para cuando se borra y crean filas;
	jQuery("input[name='subtotal[]']").each(function() {			
		sidatt = this.getAttribute("id") ; 
	});

	var inum = sidatt.substring(9);

	// asigna valor de subtotal a campo de fila 1 [isubtotal1]
	var fstot = document.getElementById('isubtotal'+inum);	
	fstot.value = MASK(fstot,subtotal,'###,###,##0.00',1);
	// valida si cantidad en campo de fila 1 [icantidad1] es > 0
	var icant = document.getElementById('icantidad'+inum);	
	var icantv = icant.value;
	var iprecio = document.getElementById('iprecio'+inum);	
	var ipreciov = 0;
	 if (icantv > 0){ 
	 	// si es mayor a 0 calcula precio unit [iprecio1]	
	 	ipreciov = subtotal/icantv; 	
		iprecio.value = MASK(iprecio,ipreciov,'###,###,##0.00',1);
	 } else{
	 	// si no hay cantidad asigna 1 
	 	icant.value = 1;
	 	iprecio.value = MASK(iprecio,subtotal,'###,###,##0.00',1);
	 }
	//Asigna total etiqueta 
	var labgtot = document.getElementById('ilgtotal');	
	labgtot.innerHTML = MASK(labgtot,imptot,'-$###,###,##0.00',1);
	//Asigna total a campos ocultos
	document.getElementById('balance').value = imptot;
	document.getElementById("igtotal").value = imptot;

	$("#ilgtotal").hide();
	$("#nuevotot").show();
	

}


//  ***************************************************************************
//  				Agraga una fila de detalle
function AddItem() {		
	var divbody = null;
	var divbody = document.getElementById("body"); //identifica div body de tabla	
	var codh = '';					//inicializa cadena para fila
	var ielems = 0; // para contar las filas que quedan

	codh = crea_tr();				//llama funcion que crea html de fila	

	if (divbody != null) {			//si no es nulo el nodo divbody
	 var divrow = document.createElement('div'); //crea elemento div row	
	 divrow.className = 'divTableRow';  		 //asigna atributo de clase
	 divrow.innerHTML = codh;					 //inserta codigo a nuevo div row
	 //agrega el elemento hijo divrow a elemento padre divbody
	 divbody.appendChild(divrow); 
	 putdescrip(idetrow);						//pone descripción
	}

	//cuenta las filas que quedan para decidir el modo a activar alert(ielems);
	jQuery("input[name='subtotal[]']").each(function() {
		ielems += 1;	  
	});

	 if (ielems>1){	 	
	 	setmodo(0);
	 }
	 else{
	 	setmodo(1);
	 }
}


//  ***************************************************************************
//						Elimina la fila seleccionada
function borraritem(ele){
var ielems = 0; // para contar las filas que quedan
//obtiene elemento padre del elemento padre del boton:
//  buton->divTableCell->divTableRow
var tr = ele.parentNode.parentNode;	
// alert(tr.getAttribute("id"));
// alert(tr.getAttribute("name"));
// alert(tr.getAttribute("class"));
tr.remove();						//elimina elemento

//cuenta las filas que quedan para decidir el modo a activar alert(ielems);
jQuery("input[name='subtotal[]']").each(function() {
	ielems += 1;	  
});

 if (ielems>1){
	 	setmodo(0);
	 }
if (ielems==1){
	 	setmodo(1);
	 }
if (ielems==0){
		var labgtot = document.getElementById('ilgtotal');	
		labgtot.innerHTML = 0.00;
		document.getElementById('nuevotot').value = 0.00;
		AddItem();
	 	setmodo(1);
	 }

recalc();							//llama a calcular el total 
}

//******************************************************************************
// Se ejecuta al cambiar opcion de select de inmumovto
function putdescrip( idetrow )
{
	//alert(idetrow);
	var elem = document.getElementById('itmovto'+idetrow);
	var indice = elem.selectedIndex;
	//console.log("idetrow:"+idetrow)
	//console.log("indice:"+indice)
	//alert (elem.options[indice].value);  	
	//alert (elem.options[indice].text);  	
	//alert (elem.options[indice].title); 	 	
	
	scvedesc  = elem.options[indice].title;
	scve  = elem.options[indice].text;
	sdesc = elem.options[indice].text + "-" + elem.options[indice].title ;  
	//alert(sdesc);
	
	var textdesc = document.getElementById('idescripcion'+idetrow);
	textdesc.value = sdesc;
	
	var tcve = document.getElementById('icve'+idetrow);
	tcve.value = scve;

	var tcvedesc = document.getElementById('icvedesc'+idetrow);
	tcvedesc.value = scvedesc;

}
//  ***************************************************************************
// 			Genera el codigo html dela fila que se agrega 
function crea_tr(){
idetrow+=1; // consecutivo para los ids 
var codh = '';

//codh += '<div class="divTableRow">';

codh += '<div class="divTableCell"> ';	// Select Tipo de Movmiento
codh += '<select ';    
codh += 'class="selpick"  '; //style="font-size:8pt"
codh += 'id="itmovto'+idetrow+'" name="tmovto[]" ';
codh += 'onchange = "putdescrip('+idetrow+')"';
codh += 'required>';
$.each(tmovtos, function( index, obj ) {
	//console.log('t'+obj.cve);
	codh += '<option  title="'+ obj.description +'" value='+obj.id+'>'+obj.cve+'</option> ';
})
codh += '</select> ';
codh += '</div> ';
   
codh += '<div class="divTableCell">';	// Cantidad
codh += '<input ';
//codh += 'style="font-size:8pt;width:70px;height:20px;text-align:right"  ';
codh += 'id="icantidad'+idetrow+'" name="cantidad[]" ';
codh += 'class="num" value="0" min="0.1"';//' step="any" min="0.1" ';
codh += 'max="999999" maxlength="9" required="required" ';
codh += 'onkeypress="return valida(event)" onChange="Calcular(this)" > ';
codh += '</div> ';

codh += '<div class="divTableCell">';  // Select Unidad
codh += '<select class="selpick" '; //;style="font-size:8pt" ';
codh += 'id="iunidad'+idetrow+'" name="unidad[]" required>';
$.each(tunidades, function( index, obj ) {
	codh += '<option  title="'+ obj.nombre +'" value='+obj.id+'>'+obj.cve+'</option> ';
})
codh += '</select>     ';
codh += '</div> ';

codh += '<div class="divTableCell">';  	// Descripcion

codh += '<input type="text" class="desc"';
//style="font-size:8pt;width:200px;height:20px;text-align:left"  class="form-control input-sm" ';
codh += 'placeholder="Describa el servicio / producto" ';
codh += 'id="idescripcion'+idetrow+'" name="descripcion[]" ';
codh += 'minlength="1" maxlength="150" required="required" > ';

codh += '</div> ';

codh += '<div class="divTableCell">';	// Precio
codh += '<input '; //style="font-size:8pt;width:70px;height:20px;text-align:right" ';
codh += 'class="num"  value="0.00" id="iprecio'+idetrow+'" ';
codh += 'name="precio[]" onkeypress="return valida(event)" onChange="Calcular(this)" ';
codh += 'max="99999999" maxlength="9" required="required" > '; //min="0.1" step="any"
codh += '</div> ';

codh += '<div class="divTableCell">';  // Subtotal  
codh += '<input '; //style="font-size:8pt;width:80px;height:20px;text-align:right"  ';
codh += 'class="num"  value="0.00" id="isubtotal'+idetrow+'" ';
codh += 'name="subtotal[]" onkeypress="return valida(event)" ';
codh += 'max="999999999" required="required" readonly> '; //step="any" min="0.1"

codh += '<input type="hidden" id="icve'+idetrow+'" name="icve[]" > ';
codh += '<input type="hidden" id="icvedesc'+idetrow+'" name="icvedesc[]" > ';

codh += '</div> ';

codh += '<div class="divTableCell">';  // Subtotal    // Boton Eliminar  
codh += '<button type="button" class="btn btn-danger btn-xs" onclick="borraritem(this);" >';
codh += '<span  title="Eliminar detalle" ';
codh += 'class="glyphicon glyphicon-trash fa-1g"></span>              ';
codh += '</button>           ';
codh += '</div> ';
//codh += '</div> ';  // row

return codh
}

//*****************************************************************************
function ClearAll(){
	// Slice toma elementos de un array pero aqui
	// Slice toma elementos contenidos en un elemento padre
	// por medio del id busca el elemento padre con id = "body" 
	// y toma todos los elementos tipo div a partir del indice 0
	// es decir toma todos los divs dentro del div Body
	// y a todos esos div les aplica el remove, es decir los elimina
	//$('#body div').slice(0).remove();
	
	// se puede usar tambien 
	document.getElementById("body").innerHTML="";
	idetrow=0; 	// Reinicia consecutivo para los ids 
	AddItem();  // agrega primer elemento
	imodo=1;	// inicia en modo un solo concepto
	var etotv = document.getElementById('nuevotot');	
	etotv.value = 0 ;
	setmodo(1);
	recalc();	//llama a calcular el total 	
}

//*****************************************************************************
function alteriva(){
	recalc();
}
//*****************************************************************************
function deletefile(){
//document.getElementById("ilinkfile").getAttribute("href"); //obtiene valor de atributo href

///identtificar si es una ruta  si no es ruta asignar 'ninguno'
if(contiene(fileexist,'.pdf')){		
document.getElementById('ideldoc').value =fileexist;
}
else{
document.getElementById('ideldoc').value ='ninguno';	
}
document.getElementById("iimgpdf").style.display = "none";	
document.getElementById("idellink").style.display = "none";	
document.getElementById("ilinkfile").style.display = "none";

//document.getElementById("ilfileup").style.display = "block";

document.getElementById("idivfile").style.display = "block";
document.getElementById("idivcancel").style.display = "block";
document.getElementById("icanceldel").style.display = "block";			
};

function canceldeletefile(){	
document.getElementById('ideldoc').value = "ninguno";
document.getElementById("iimgpdf").style.display = "block";	
document.getElementById("idellink").style.display = "block";	
document.getElementById("ilinkfile").style.display = "block";
// var input = $("#ilfileup");
// input.replaceWith(input.val(null).clone(true));
//document.getElementById("ilfileup").value = null;
//document.getElementById("ilfileup").style.display = "none";
document.getElementById("idivfile").style.display = "none";
document.getElementById("idivcancel").style.display = "none";
document.getElementById("icanceldel").style.display = "none";	

};

//*****************************************************************************
$("#iiva").change(function(event){
document.getElementById('ilgtotal').value = MASK(this,this.value,'-$##,###,##0.00',1);
});

//*****************************************************************************
// formatea un numero según una mascara dada ej: "-$###,###,##0.00"
//<input onchange="MASK(this,this.value,'-$##,###,##0.00',1)">
// elm   = elemento html <input> donde colocar el resultado
// n     = numero a formatear
// mask  = mascara ej: "-$###,###,##0.00"
// force = formatea el numero aun si n es igual a 0
//
// La función devuelve el numero formateado

function MASK(form, n, mask, format) {
  if (format == "undefined") format = false;
  if (format || NUM(n)) {
    dec = 0, point = 0;
    x = mask.indexOf(".")+1;
    if (x) { dec = mask.length - x; }

    if (dec) {
      n = NUM(n, dec)+"";
      x = n.indexOf(".")+1;
      if (x) { point = n.length - x; } else { n += "."; }
    } else {
      n = NUM(n, 0)+"";
    } 
    for (var x = point; x < dec ; x++) {
      n += "0";
    }
    x = n.length, y = mask.length, XMASK = "";
    while ( x || y ) {
      if ( x ) {
        while ( y && "#0.".indexOf(mask.charAt(y-1)) == -1 ) {
          if ( n.charAt(x-1) != "-")
            XMASK = mask.charAt(y-1) + XMASK;
          y--;
        }
        XMASK = n.charAt(x-1) + XMASK, x--;
      } else if ( y && "$0".indexOf(mask.charAt(y-1))+1 ) {
        XMASK = mask.charAt(y-1) + XMASK;
      }
      if ( y ) { y-- }
    }
  } else {
     XMASK="";
  }
  if (form) { 
    form.value = XMASK;
    if (NUM(n)<0) {
      form.style.color="#FF0000";
    } else {
      form.style.color="#000000";
    }
  }
  return XMASK;
}

// Convierte una cadena alfanumérica a numérica (incluyendo formulas aritméticas)
//
// s   = cadena a ser convertida a numérica
// dec = numero de decimales a redondear
//
// La función devuelve el numero redondeado

function NUM(s, dec) {
  for (var s = s+"", num = "", x = 0 ; x < s.length ; x++) {
    c = s.charAt(x);
    if (".-+/*".indexOf(c)+1 || c != " " && !isNaN(c)) { num+=c; }
  }
  if (isNaN(num)) { num = eval(num); }
  if (num == "")  { num=0; } else { num = parseFloat(num); }
  if (dec != undefined) {
    r=.5; if (num<0) r=-r;
    e=Math.pow(10, (dec>0) ? dec : 0 );
    return parseInt(num*e+r) / e;
  } else {
    return num;
  }
}
//*****************************************************************************
