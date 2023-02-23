/*!
 * aplimovtos.js
 * Version: 1.0.0
 *
 * Copyright 2022 InfoCret - Julio Buendia 
 * 
 * Script que permite mostrar ventana emergente
 * y llenar un select para aplicar movimiento 
 */

// $("#brunpop").click(function(event){	
// });

// ************* Llamado desde el html en el Clic en boton de cancelacion ************
	 // Json movid contiene esto:
	   //    "movid" => 744
     //    "movtipo" => "A"
     //    "movdate" => "2019-04-30"
     //                  0123456789 
     //    "movcant" => "1.0000"
     //    "movpunit" => "3302.1100"
     //    "movumed" => "pago"
     //    "movcve" => 1111
     //    "movdesc" => "Abono Pago Cuota mantenimiento"
     //    "movfolio" => "1201904300003302111111007442"
     //    "movbalance" => "3302.1100"
//
function fillmovtos(movid,pagomovid) {
//alert(rutax+"/inmumovtos/gmovs/"+movid);

var content = JSON.parse(movid);	 // convierte el json a objeto	
var cvepay = content.movcve;		   // clave del movimiento a cancelar
var cvecancel = 0;					       // clave de cancelacion para seleccionar en index
switch(cvepay) {
  case 1111: 			      //Pago de mantenimiento     
    cvecancel = 1106;	  //Cancelacion de pago de mntto    
    break;
  case 1113: 			      //Abono por Nota de credito Cuota de Mantenimiento     
    cvecancel = 1107;	  //Cargo por Cancelación Nota Crédito Mtto
    break;
  case 1131:            //Abono por Pago Cuota Extraordinaria     
    cvecancel = 1123;   //Cargo por Devolucion de pago Cuota Extraordinaria
    break;
  case 1132:            //Abono por Nota de Credito Cuota Extraordinaria
    cvecancel = 1124;   //Cargo por Cancelación Nota Crédito CExtr
    break;
  case 1151:            //Abono por Pago de Consumo de Gas
    cvecancel = 1143;   //Cargo por Devolucion de pago Consumo Gas
    break;
  case 1152:            //Abono por Nota de Credito Consumo de Gas
    cvecancel = 1144;   //Cargo por Cancelación Nota Crédito Cgas
    break;


  default:
    cvecancel = -1;    
}
//alert('res:'+content.movid);
//console.log('movid:'+movid);
 $("#creamovpop").modal("show");								                    // muestra ventana modal
 //$montoc = Math.round(content.movbalance * 10) / 10;
 $montoc = parseFloat(content.movbalance).toFixed(2);			          //formatea monto
 document.getElementById("mmonto").value =  $montoc;			          // asigna monto a fromulario
	var sfechac =  content.movdate.substring(8,10)				            // toma el dia
	var sfechac =  sfechac+'/'+content.movdate.substring(5,7);	      // toma el mes
	var sfechac =  sfechac+'/'+content.movdate.substring(0,4);	      // toma el año
 document.getElementById('cfechapa').innerHTML    =  sfechac;		    // asigna fecha formateada
 document.getElementById('cconceptpa').innerHTML  =  content.movcve+" - "+content.movdesc; // asig cve/concep
 document.getElementById('cmontopa').innerHTML    =  $montoc;		    // asigna monto a tabla 
 document.getElementById('inmovto_id').value      =  pagomovid;     // asigna id de pago inmumovto_id
 // ---------------------------------------------		// llama a ruta
 $.get(rutax+"/inmumovtos/gmovs/"+content.movid,
 	function(movtos,response){
 	$('#smovto').empty();					// vaciar select 
 											//agrega place holder o primer opcion
 	$('#smovto').append("<option selected='selected' value=''>Seleccione concepto:</option>"); 
 			$.each(movtos, function( index, obj ) {		// barre resultado de consulta 
				$('#smovto').append						// agrega al select
				("<option value='"+obj.id+"'>"+obj.cve+" - "+obj.description+"</option>");
				//alert('-'+obj.cve+'-'+cvecancel+'-');
				if (obj.cve == cvecancel) {					
					document.getElementById('smovto').selectedIndex = index+1;
				}
			});			
 	});

}// fin de fillmovtos
// **********************************************************************************



function rollbackc(cancelmov) {
//alert(rutax+"/inmumovtos/gmovs/"+movid);
 // "movid" => 55
  // "movtipo" => "A"
  // "movdate" => "2019-10-23"
  // "movcant" => "1.0000"
  // "movumed" => "pago"
  // "movcve" => 1111
  // "movdesc" => "Abono Pago Cuota mantenimiento"
  // "movfolio" => "0711910230000300001111000552"
  // "movbalance" => "300.0000"
var content = JSON.parse(cancelmov);    // convierte el json a objeto  

var can_id = content.movid;             // id del movimiento
var candat = content.movdate;           // fecha del movimiento 
var cancve = content.movcve;            // clave del movimiento 
var candes = content.movdesc;           // desc del movimiento
var canfol = content.movfolio;          // folio del movimiento
var canmto = content.movbalance;        // monto del movimiento

$("#rollbackpop").modal("show");                             // muestra ventana modal

  var sfechac =  candat.substring(8,10)                     // toma el dia
  var sfechac =  sfechac+'/'+candat.substring(5,7);         // toma el mes
  var sfechac =  sfechac+'/'+candat.substring(0,4);         // toma el año

  $montoc = parseFloat(canmto).toFixed(2);                  //formatea monto
// asigna datos a row de movimiento de cancelación
 document.getElementById('cafecha').innerHTML    =  sfechac;     // asigna fecha formateada
 document.getElementById('caconcept').innerHTML  =  cancve+" - "+candes; // asig cve/concep
 document.getElementById('cafolio').innerHTML    =  canfol;     // asigna folio 
 document.getElementById('camonto').innerHTML    =  $montoc;    // asigna monto a tabla
 //asigna a campos ocultos
 document.getElementById('rmovcancel_id').value =  can_id;   // asigna id de movto de cancelacion
alert(can_id);
$.get(rutax+"/inmumovtos/rbackc/"+can_id,
  function(movto,response){    
    
    //alert(movto.catmovto_cve);
    var sfechap =  movto.date.substring(8,10)                     // toma el dia
    var sfechap =  sfechap+'/'+movto.date.substring(5,7);         // toma el mes
    var sfechap =  sfechap+'/'+movto.date.substring(0,4);         // toma el año
    $montop = parseFloat(movto.balance).toFixed(2);               //formatea monto

    // asigna datos a row de movimiento de abonnp / pago
   document.getElementById('pafecha').innerHTML    =  sfechap;        // asigna fecha formateada
   document.getElementById('paconcept').innerHTML  =  movto.catmovto_cve+" - "+movto.description; // asig cve/concep
   document.getElementById('pafolio').innerHTML    =  movto.folio;      // asigna folio 
   document.getElementById('pamonto').innerHTML    =  $montop;        // asigna monto a tabla
   //asigna a campos ocultos
   document.getElementById('rmovto_id').value =  movto.id;          // asigna id de movto de cancelacion
   
  }); //  fin get


}// rollbackc
// **


function fillmovtosed(movid) {
var content = JSON.parse(movid);   // convierte el json a objeto  
var cveedit = content.movcve;       // clave del movimiento a editar
//var cvecancel = 0;                 // clave de cancelacion para seleccionar en index

//console.log('movid:'+movid);
 $("#editmovpop").modal("show");                                  // muestra ventana modal 
  $montoc = parseFloat(content.movbalance).toFixed(2);            //formatea monto  
 document.getElementById('modmovto_id').value =  content.movid;   // asigna id de pago inmumovto_id
 document.getElementById('moddate').value     =  content.movdate; // asigna fecha 
 document.getElementById("modmonto").value    =  $montoc;         // asigna monto a fromulario
 document.getElementById("origmonto").value   =  $montoc;         // asigna monto para campo oculto
 // ---------------------------------------------                 // llama a ruta
 $.get(rutax+"/inmumovtos/gmovsed/"+content.movid,
  function(movtos,response){
  $('#modconcep').empty();         // vaciar select 
                      //agrega place holder o primer opcion
  $('#modconcep').append("<option selected='selected' value=''>Seleccione concepto:</option>"); 
      $.each(movtos, function( index, obj ) {   // barre resultado de consulta 
        $('#modconcep').append           // agrega al select
        ("<option value='"+obj.id+"'>"+obj.cve+" - "+obj.description+"</option>");
        //alert('-'+obj.cve+'-'+cvecancel+'-');
        if (obj.cve == cveedit) {         
          document.getElementById('modconcep').selectedIndex = index+1;
        }
      });     
  });

}// fin de fillmovtos de edicion
// **********************************************************************************
