/*!
 * inmumovtos.js
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
   	
});

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
// 		Calcula por fila :  Cantidad * Precio y lo coloca en Subtotal
function Calcular(ele) {
	var cant = 0, precio = 0, stotal = 0;
	var tr = ele.parentNode.parentNode;	// identifica la fila o row de la tabla
	cant = parseFloat(tr.getElementsByTagName('input')[0].value,10); //identifica input de cant	
	precio = parseFloat(tr.getElementsByTagName('input')[2].value,10); // identifica input de precio
	stotal = parseFloat((cant*precio),10); // realiza operacion
	tr.getElementsByTagName('input')[3].value = stotal; // asigna valor a campo
	// console.log(tr.getElementsByTagName('input')[0].value);
	// console.log(tr.getElementsByTagName('input')[1].value);
	// console.log(tr.getElementsByTagName('input')[2].value);
	// console.log(tr.getElementsByTagName('input')[3].value);
	total(); // llama a la funcion de calculo de total
}

//******************************************************************************
//			Barre la columna subtotal de la tabla y suma los montos, 
//			calcula IVA y calcula el gran total
function total(){	
	var importe_total = 0;
	var iva = 0;
	var gtotal = 0;
	jQuery("input[name='subtotal[]']").each(function() {
		importe_total += parseFloat(this.value,10);	  
	});
	document.getElementById("idstotal").value=importe_total;

	var labstotal = document.getElementById('ilstotal');	
	labstotal.innerHTML = MASK(labstotal,importe_total,'-$##,###,##0.00',1);

	var checkBox = document.getElementById("ichiva");    
    if (checkBox.checked == true){ 
	iva =parseFloat((importe_total*variva),10); //usa la variable variva enviada desde vista create
    } else {  
   	iva = 0;    
    }		

	var labiva = document.getElementById('iliiva');	
	labiva.innerHTML = MASK(labiva,iva,'-$##,###,##0.00',1);

	//iva =parseFloat((importe_total*variva),10); //usa la variable variva enviada desde vista create
	document.getElementById("iiva").value=iva;
	gtotal =parseFloat((importe_total+iva),10);
	document.getElementById("igtotal").value=gtotal;

	var labgtot = document.getElementById('ilgtotal');	
	labgtot.innerHTML = MASK(labgtot,gtotal,'-$##,###,##0.00',1);
}

//  ***************************************************************************
//  				Agraga una fila de detalle
function AddItem() {		
	var tbody = null;
	var tabla = document.getElementById("detailmovs-table"); 	//identifica tabla
	var nodes = tabla.childNodes;								//obtiene los elementos hijos
	for (var x = 0; x<nodes.length;x++) {						//ciclo barre bscando el body
		if (nodes[x].nodeName == 'TBODY') {						//si el nodo hijo es el body
			tbody = nodes[x];									//obtiene el elemento body				
			break;												//sale del ciclo
		}
	}
	var codh = '';												//inicializa cadena para fila
	codh = crea_tr();										//llama funcion que crea html de fila	

	if (tbody != null) {										//si no es nulo el nodo body
		var tr = document.createElement('tr');					//crea un elemento tr (row)
		tr.innerHTML = codh;									//asigna codigo html
		tbody.appendChild(tr);									//agrega el elemento
	}
}
//  ***************************************************************************
//						Elimina la fila seleccionada
function borraritem(ele){
var tr = ele.parentNode.parentNode;	//obtiene elemento desde el que se llamo
tr.remove();						//elimina elemento
total();							//llama a calcular el total 
}

//  ***************************************************************************
// 			Genera el codigo html dela fila que se agrega 
function crea_tr(){
idetrow+=1; // consecutivo para los ids 
var codh = '';

codh += '<tr >    ';

codh += '<td style="text-align:center;" width="30" nowrap > ';	// Select Tipo de Movmiento
codh += '<select ';
codh += 'class="selectpicker" style="font-size:8pt" ';
codh += 'id="itmovto'+idetrow+'" name="tmovto[]" ';
codh += 'required>';
$.each(tmovtos, function( index, obj ) {
	//console.log(obj.id);
	codh += '<option  title="'+ obj.nombre +'" value='+obj.id+'>'+obj.cve+'</option> ';
})
codh += '</select>     ';
codh += '</td>         ';

codh += '<td style="text-align:center;" width="20" nowrap > ';	// Cantidad
codh += '<input ';
codh += 'style="font-size:9pt;width:70px;height:18px;text-align:right" type="number" ';
codh += 'id="icantidad'+idetrow+'" name="cantidad[]" ';
codh += 'class="form-control input-sm" value="0" step="any" ';
codh += 'min="0.1" max="999999" required="required" ';
codh += 'onkeypress="return valida(event)" onChange="Calcular(this)" > ';
codh += '</td>          ';

codh += '<td style="text-align:center;" width="30" nowrap > ';	// Select Unidad
codh += '<select class="selectpicker" style="font-size:8pt" ';
codh += 'id="iunidad'+idetrow+'" name="unidad[]" required>';
$.each(tunidades, function( index, value ) {
	codh += '<option  title="'+ value +'" value='+index+'>'+index+'</option> ';
})
codh += '</select>     ';
codh += '</td>   ';

codh += '<td style="text-align:center;" width="200" nowrap >';	// Descripcion
codh += '<input style="font-size:9pt;width:200px;height:18px;text-align:left" type="text" ';
codh += 'class="form-control input-sm" placeholder="Describa el servicio / producto" ';
codh += 'id="idescripcion'+idetrow+'" name="descripcion[]" ';
codh += 'minlength="1" maxlength="150" required="required" > ';
codh += '</td>  ';

codh += '<td style="text-align:center;" width="30" nowrap >';	// Precio
codh += '<input style="font-size:9pt;width:70px;height:18px;text-align:right" type="number" ';
codh += 'class="form-control input-sm" step="any" value="0" id="iprecio'+idetrow+'" ';
codh += 'name="precio[]" onkeypress="return valida(event)" onChange="Calcular(this)" ';
codh += 'min="0.1" max="99999999" required="required" > ';
codh += '</td> ';

codh += '<td style="text-align:center;" width="40" nowrap >	';  // Subtotal  
codh += '<input style="font-size:9pt;width:80px;height:18px;text-align:right" type="number" ';
codh += 'class="form-control input-sm" step="any" value="0" id="isubtotal'+idetrow+'" ';
codh += 'name="subtotal[]" onkeypress="return valida(event)" ';
codh += 'min="0.1" max="999999999" required="required" > ';
codh += '</td>        ';

codh += '<td style="text-align:left;" width="20" nowrap > ';  // Boton Eliminar  
codh += '<button type="button" class="btn btn-danger btn-xs" onclick="borraritem(this);" >';
codh += '<span  title="Eliminar detalle" ';
codh += 'class="glyphicon glyphicon-trash fa-1g"></span>              ';
codh += '</button>           ';
codh += '</td>';
codh += '</tr>   ';

return codh
}
//*****************************************************************************
function ClearAll(){
	//Remueve las filas de una tabla a partir de
	//el id de la tabla y especificando el elemento tbody
	//identifando tambien que lo que deseamos eliminar son los tr
	//y asignando un indice si es 0 elimina todo si desea dejar la primer fila
	//el indice deberia ser 1
	//.slice (inicio [, fin])
	//por si desea obtener el tamaño de la seleccion es decir el numero de tr's
	//$('#tabla tbody tr').length(); // Tamaño de la selección.
	$('#detailmovs-table tbody tr').slice(0).remove();
	idetrow=0; // consecutivo para los ids 
	AddItem();
	total();							//llama a calcular el total 	
}
//*****************************************************************************
function alteriva(){
	total();
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
$("#inmueble").change(function(event){
//console.log("http://testc1.me/propareas/"+document.getElementById("inmueble").value+"");  
//console.log(rutax);
// $.get("http://testc1.me/paises/"+$('#continente option:selected').html()+"",
 $.get(rutax+"/propareas/"+document.getElementById("inmueble").value+"",
 	function(areas,response){		 	
 	$('#proparea').empty();	// vaciar select 
 	//agrega place holder o primer opcion
 	$('#proparea').append("<option selected='selected' value=''>Seleccione Area</option>"); 
	$.each(areas, function( index, value ) {
		//console.log("<option value='"+value+"'>"+value+"</option>");
		$('#proparea').append
		("<option value='"+index+"'>"+value+"</option>");
	});
 	});
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

// $("#inmueble").change(function(event){	
// alert("change");
// });

//function listar(){
	//var cod = document.getElementById("slocation").value;		
//var descvalue = document.getElementsByName("descripcion").value;		
//var descvalue = document.getElementById("descripcion").value;	
//var descvalue = $("[name='descripcion']").value;	
// jQuery("input[name='descripcion[]']").each(function() {
//     console.log( this.value  );
// });
// alert("hola");
// }
