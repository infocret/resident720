/*!
 *persona.js
 * Version: 1.0.0
 *
 * Copyright 2018 InfoCret - Julio Buendia 
 * 
 */
 //
 $( document ).ready(function() {
    //hide_ctrls();
    //console.log( "ready!" );
    //if (action=='create') {    	
	//document.getElementById("continente").selectedIndex=2;		// selecciona América	
    //};
    //alert(action);
    //calculaRFCURP()    
});

  $("#lugaresnac").change(function(event){
  	//alert("-"+$('#pais option:selected').html()+"-");
  	var lugarnac = document.getElementById("lugaresnac").value;		
  	//alert("-"+lugarnac+"-");
  	var lugarnackey=$('#lugaresnac option:selected').html()+"";
  	//alert("-"+lugarnackey+"-");
  	document.getElementById("lugarnac").value = lugarnackey;
  });

  
  $("#genero2").change(function(event){
  	//alert("-"+$('#pais option:selected').html()+"-");
  	var genero = document.getElementById("genero2").value;		
  	//alert("-"+genero+"-");
  	var generokey=$('#genero2 option:selected').html()+"";
  	//alert("-"+generokey+"-");
  	document.getElementById("genero").value = genero;
  	//calculaRFCURP();
  });

 $("#genrfccurp").click(function(event){
    //alert('click');
    calculaRFCURP();
  });

function calculaRFCURP() {
    var nombre = document.getElementById('name').value.toUpperCase();
    //var nombre = 'Julio Cesar';
    //alert(nombre);
    if(nombre === ''){
        alert("Escriba el nombre");
        return;
    }
    var paterno1st = document.getElementById('appat').value.toUpperCase();; 
	//var paterno1st = 'Buendia';
	//alert(paterno1st);
   if(paterno1st === ''){
        alert("Escriba el apellido paterno");
        return;
    }
	var materno1st = document.getElementById('apmat').value.toUpperCase();;
    //var materno1st = 'Gonzalez';
    //alert(materno1st);
    if(materno1st === ''){
        alert("Escriba el apellido materno");
        return;
    }
    var fecha = document.getElementById("datebirth").value;
    //var fecha = '1971-01-13';
    //alert(fecha);
    if(fecha === ''){
        alert("Elije fecha de nacimiento");
        return;
    }
    //var edo = document.getElementById("lugarnac").value;
    var edo =document.getElementById("lugaresnac").value
    //var edo = document.getElementById("select_estado").options[document.getElementById("txt_estado").selectedIndex].text.toUpperCase();
    //var edo ='DISTRITO FEDERAL';   
    //alert(edo);
   if(edo === ''){
        alert("Selecciona lugar de Nacimiento");
        return;
    }
    var sexo = document.getElementById("genero").value.toUpperCase();;
    //var sexo = 'Hombre';
    //alert(sexo);
    if(sexo === ''){
        alert("Selecciona Genero");
        return;
    }
    
	
	// **************** Apellido Paterno  ********************************************************
        paterno1st = paterno1st.replace("LAS","");
        paterno1st = paterno1st.replace("DEL","");
    var paterno  = paterno1st.replace("LA","");
        paterno = paterno.replace("DE","");
        paterno = paterno.replace("Y","");
    while(paterno[0] == " "){
        paterno = paterno.substr(1, paterno.length - 1);
    }       
    // **************** Apellido Materno  ********************************************************
    var materno1st = materno1st.replace("LAS","");
        materno1st = materno1st.replace("DEL","");
        materno1st = materno1st.replace("DE","");
       
    var materno  = materno1st.replace("LA","");
        materno = materno.replace("Y","");
               
    while(materno[0] == " "){
        materno = materno.substr(1, materno.length - 1);
    }
       
    // **************** Nombre  ********************************************************
    var op_paterno = paterno.length;
    var vocales = /^[aeiou]/i;
    var consonantes = /^[bcdfghjklmnñpqrstvwxyz]/i;
   
    var s1 = '';
    var s2 = '';
    var s8 = '';

    var i = 0;
    var x= true;
    var z = true;

    while(i < op_paterno){
        if((consonantes.test(paterno[i]) == true) & (x != false)){
            s1 = s1 + paterno[i];
            paterno = paterno.replace(paterno[i],"");
            x=false;
        }
       
        if((vocales.test(paterno[i]) == true) & (z != false)){
            s2 = s2 + paterno[i];
            paterno = paterno.replace(paterno[i],"");
            z=false;
        }
        i++;
    }

    var ix=0;
    var y = true;
    var nparteno = paterno.length;
   
    while(ix < nparteno){
        if((consonantes.test(paterno[ix]) == true) & (y != false)){
            s8 = s8 + paterno[ix];
            y=false;
        }
        ix++;
    }

    //calculos apellido materno
    var maternosize = materno.length;
    var j = 1;
    var s9 = '';
    var xm = true;
    var ym = true;
   
    while(j < maternosize){
        if((consonantes.test(materno[j]) == true) && (xm != false)){
            s9 = s9.replace(materno[j],"");
            xm = false;
        }
       
        if((consonantes.test(materno[j]) == true) && (ym != false)){
            s9 = s9 + materno[j];
            ym = false;
        }
       
        j++;
    }
   
    var nombresize = nombre.length;
    var im = 1;
    var s10= '';
    var wx = true;
    var wz = true;
   
    while(im < nombresize){
       
        if((consonantes.test(nombre[im]) == true)&& (wz != false)){
            s10 = s10 + nombre[im];
            nombre = nombre.replace(nombre[im],"");
            wz = false;
        }
        im++;
    }
   
   // **************** Genero / SEXO  ********************************************************
        if( sexo == 'HOMBRE'){ sexo = 'H';}else{ sexo ='M';}
       

 // **************** Estado / lugar de nacimiento  ********************************************************
    // switch(edo){
    //     case "AGUASCALIENTES": edo="AS"; break;
    //     case "BAJA CALIFORNIA":edo="BC"; break;
    //     case "BAJA CALIFORNIA SUR": edo="BS"; break;
    //     case "CAMPECHE": edo="CC"; break;
    //     case "COAHUILA DE ZARAGOZA": edo="CL"; break;
    //     case "COLIMA": edo="CM"; break;
    //     case "CHIAPAS": edo="CS"; break;
    //     case "CHIHUAHUA": edo="CH"; break;
    //     case "DISTRITO FEDERAL": edo="DF"; break;
    //     case "DURANGO": edo="DG"; break;
    //     case "GUANAJUATO": edo="GT"; break;
    //     case "GUERRERO": edo="GR"; break;
    //     case "HIDALGO": edo="HG"; break;
    //     case "JALISCO": edo="JC"; break;
    //     case "MÉXICO": edo="MC"; break;
    //     case "MICHOACÁN DE OCAMPO": edo="MN"; break;
    //     case "MORELOS": edo="MS"; break;
    //     case "NAYARIT": edo="NT"; break;
    //     case "NUEVO LEÓN": edo="NL"; break;
    //     case "OAXACA": edo="OC"; break;
    //     case "PUEBLA": edo="PL"; break;
    //     case "QUERÉTARO": edo="QT"; break;
    //     case "QUINTANA ROO": edo="QR"; break;
    //     case "SAN LUIS POTOSÍ": edo="SP"; break;
    //     case "SINALOA": edo="SL"; break;
    //     case "SONORA": edo="SR"; break;
    //     case "TABASCO": edo="TC"; break;
    //     case "TAMAULIPAS": edo="TS"; break;
    //     case "TLAXCALA": edo="TL"; break;
    //     case "VERACRUZ DE IGNACIO DE LA LLAVE": edo="VZ"; break;
    //     case "YUCATÁN": edo="YN"; break;
    //     case "ZACATECAS": edo="ZS"; break;
    // }
   
    var s3 = materno[0];
    var s4 = nombre[0];
   

    // **************** Fecha de nacimiento  ********************************************************
    var fechaSplit = fecha.split("-");
    //alert(fechaSplit);
    var s5 = fechaSplit[0][2]+fechaSplit[0][3];     // año
    var s6 = fechaSplit[1];                         // mes
    var s7 = fechaSplit[2];                         // dia

    //  ************** preArmado  de  RFC  y CURP ***************************************************
    pstCURP = s1+s2+s3+s4+s5+s6+s7+sexo+edo+s8+s9+s10;      // Arma CURP sin digito verificador
    pstRFC  = s1+s2+s3+s4+s5+s6+s7;                         // Arma RFC sin Homoclabe


    // ****************  Se obtiene el digito verificador  *******************************************

var contador = 18;
var contador1 = 0;
var valor = 0;
var sumatoria = 0;


while (contador1 <= 15)
    {

        //pstCom = SUBSTRING(@pstCURP,@contador1,1)
    var pstCom = pstCURP.substr(parseInt(contador1),1);
     
        if (pstCom == '0') 
            {
             valor = 0 * contador ;
            }
        if (pstCom == '1') 
            {
             valor = 1 * contador;
            }
        if (pstCom == '2') 
            {
             valor = 2 * contador;
            }
        if (pstCom == '3') 
            {
             valor = 3 * contador;
            }
        if (pstCom == '4') 
            {
             valor = 4 * contador;
            }
        if (pstCom == '5') 
            {
             valor = 5 * contador;
            }
        if (pstCom == '6') 
            {
             valor = 6 * contador;
            }
        if (pstCom == '7') 
            {
             valor = 7 * contador;
            }
        if (pstCom == '8') 
            {
             valor = 8 * contador;
            }
        if (pstCom == '9') 
            {
             valor = 9 * contador;
            }
        if (pstCom == 'A') 
            {
             valor = 10 * contador;
            }
        if (pstCom == 'B') 
            {
             valor = 11 * contador;
            }
        if (pstCom == 'C') 
            {
             valor = 12 * contador;
            }
        if (pstCom == 'D') 
            {
             valor = 13 * contador;
            }
        if (pstCom == 'E') 
            {
             valor = 14 * contador;
            }
        if (pstCom == 'F') 
            {
             valor = 15 * contador;
            }
        if (pstCom == 'G') 
            {
             valor = 16 * contador;
            }
        if (pstCom == 'H') 
            {
             valor = 17 * contador;
            }
        if (pstCom == 'I') 
            {
             valor = 18 * contador;
            }
        if (pstCom == 'J') 
            {
             valor = 19 * contador;
            }
        if (pstCom == 'K') 
            {
             valor = 20 * contador;
            }
        if (pstCom == 'L') 
            {
             valor = 21 * contador;
            }
        if (pstCom == 'M') 
            {
             valor = 22 * contador;
            }
        if (pstCom == 'N') 
            {
             valor = 23 * contador;
            }
        if (pstCom == 'Ñ') 
            {
             valor = 24 * contador;
            }
        if (pstCom == 'O') 
            {
             valor = 25 * contador;
            }
        if (pstCom == 'P') 
            {
             valor = 26 * contador;
            }
        if (pstCom == 'Q') 
            {
             valor = 27 * contador;
            }
        if (pstCom == 'R') 
            {
             valor = 28 * contador;
            }
        if (pstCom == 'S') 
            {
             valor = 29 * contador;
            }
        if (pstCom == 'T') 
            {
             valor = 30 * contador;
            }
        if (pstCom == 'U') 
            {
             valor = 31 * contador;
            }
        if (pstCom == 'V') 
            {
             valor = 32 * contador;
            }
        if (pstCom == 'W') 
            {
             valor = 33 * contador;
            }
        if (pstCom == 'X') 
            {
             valor = 34 * contador;
            }
        if (pstCom == 'Y') 
            {
             valor = 35 * contador;
            }

        if (pstCom == 'Z') 
            {
             valor = 36 * contador;
            }

        contador  = contador - 1;
        contador1 = contador1 + 1;
        sumatoria = sumatoria + valor;

    }

numVer  = sumatoria % 10;
numVer  = Math.abs(10 - numVer);
anio = s5       // splitFecha[0]; // Toma el año de nacimiento


if (numVer == 10)
    {
     numVer = 0;
    }


if (anio < 2000)
    {
     pstDigVer = '0' + '' + numVer;
    }
if (anio >= 2000)
    {
     pstDigVer = 'A' + '' + numVer;
    }


pstCURP = pstCURP + pstDigVer;      // Asigna el digito verificador generado a CURP

   
//************************  Asigna valor a controles html *******************************************
    document.getElementById('rfc').value = pstRFC; //s1+s2+s3+s4+s5+s6+s7;
    //alert('RFC: '+s1+s2+s3+s4+s5+s6+s7);
    document.getElementById('curp').value = pstCURP; // s1+s2+s3+s4+s5+s6+s7+sexo+edo+s8+s9+s10;
     //alert('CURP: '+s1+s2+s3+s4+s5+s6+s7+sexo+edo+s8+s9+s10);
     alert('Valide el RFC y CURP generados, modifiquelos si es necesario');
     //show_ctrls();
}


function hide_ctrls(){
document.getElementById("rfc").style.display = "none";      
document.getElementById("curp").style.display = "none";   
document.getElementById("lrfc").style.display = "none";      
document.getElementById("lcurp").style.display = "none";    
};

function show_ctrls(){
document.getElementById("rfc").style.display = "block";     
document.getElementById("curp").style.display = "block";  
document.getElementById("lrfc").style.display = "block";     
document.getElementById("lcurp").style.display = "block";    
};