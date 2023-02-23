
//al finalizar carga del documento
$( document ).ready(function() { 
var cantidad = document.getElementById('amounttext').value    
var letr = numeroALetras(cantidad);    
var fech = hoyFecha();
document.getElementById('amountletertext').value = letr;    
document.getElementById('fdatetext').value  = fech;

if (action == 'edit'){
    svalch = document.getElementById('checkbook').value;
    var array_ids = svalch.split('-');   
    document.getElementById('propaccount_id').value = array_ids[0];
    document.getElementById('checkbook_id').value = array_ids[1];    
}

});

// al cambiar valor del monto
$("#amounttext").change(function(event){
var letr = numeroALetras(this.value);    
document.getElementById('amountletertext').value = letr;
});


$("#checkbook").change(function(event){
    //alert(this.value);
    valor = this.value;
    var array_ids = valor.split('-');
    document.getElementById('propaccount_id').value = array_ids[0];
    document.getElementById('checkbook_id').value = array_ids[1];    
});

$("#chleyenda").change(function(event){
    //document.getElementById('ilgtotal').value = MASK(this,this.value,'-$##,###,##0.00',1);
    var sley = 'n/a';
    var ival = 0;
    //alert(this.checked);
    if (this.checked ){
       sley = 'Para abono en cuenta del beneficiario';
       ival = 1;
    }
    document.getElementById('textleyenda').value = sley;
    document.getElementById('incluirleyenda').value = ival;
});


$("#liststat").change(function(event){
    //alert(this.value);
    valor = this.value;    
    document.getElementById('status').value = valor;   
});


function hoyFecha(){
    var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        
        dd = addZero(dd);
        mm = addZero(mm);

        return yyyy+'-'+mm+'-'+dd;
}
   
function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}



//https://gist.github.com/alfchee/e563340276f89b22042a
// function test(){
// var letr = numeroALetras(1934852.50);
// alert (letr);
// }


//Ejecuta todo
var numeroALetras = (function() {
// Código basado en https://gist.github.com/alfchee/e563340276f89b22042a
    function Unidades(num){

        switch(num)
        {
            case 1: return 'UN';
            case 2: return 'DOS';
            case 3: return 'TRES';
            case 4: return 'CUATRO';
            case 5: return 'CINCO';
            case 6: return 'SEIS';
            case 7: return 'SIETE';
            case 8: return 'OCHO';
            case 9: return 'NUEVE';
        }

        return '';
    }//Unidades()

    function Decenas(num){

        let decena = Math.floor(num/10);
        let unidad = num - (decena * 10);

        switch(decena)
        {
            case 1:
                switch(unidad)
                {
                    case 0: return 'DIEZ';
                    case 1: return 'ONCE';
                    case 2: return 'DOCE';
                    case 3: return 'TRECE';
                    case 4: return 'CATORCE';
                    case 5: return 'QUINCE';
                    default: return 'DIECI' + Unidades(unidad);
                }
            case 2:
                switch(unidad)
                {
                    case 0: return 'VEINTE';
                    default: return 'VEINTI' + Unidades(unidad);
                }
            case 3: return DecenasY('TREINTA', unidad);
            case 4: return DecenasY('CUARENTA', unidad);
            case 5: return DecenasY('CINCUENTA', unidad);
            case 6: return DecenasY('SESENTA', unidad);
            case 7: return DecenasY('SETENTA', unidad);
            case 8: return DecenasY('OCHENTA', unidad);
            case 9: return DecenasY('NOVENTA', unidad);
            case 0: return Unidades(unidad);
        }
    }//Unidades()

    function DecenasY(strSin, numUnidades) {
        if (numUnidades > 0)
            return strSin + ' Y ' + Unidades(numUnidades)

        return strSin;
    }//DecenasY()

    function Centenas(num) {
        let centenas = Math.floor(num / 100);
        let decenas = num - (centenas * 100);

        switch(centenas)
        {
            case 1:
                if (decenas > 0)
                    return 'CIENTO ' + Decenas(decenas);
                return 'CIEN';
            case 2: return 'DOSCIENTOS ' + Decenas(decenas);
            case 3: return 'TRESCIENTOS ' + Decenas(decenas);
            case 4: return 'CUATROCIENTOS ' + Decenas(decenas);
            case 5: return 'QUINIENTOS ' + Decenas(decenas);
            case 6: return 'SEISCIENTOS ' + Decenas(decenas);
            case 7: return 'SETECIENTOS ' + Decenas(decenas);
            case 8: return 'OCHOCIENTOS ' + Decenas(decenas);
            case 9: return 'NOVECIENTOS ' + Decenas(decenas);
        }

        return Decenas(decenas);
    }//Centenas()

    function Seccion(num, divisor, strSingular, strPlural) {
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

        let letras = '';

        if (cientos > 0)
            if (cientos > 1)
                letras = Centenas(cientos) + ' ' + strPlural;
            else
                letras = strSingular;

        if (resto > 0)
            letras += '';

        return letras;
    }//Seccion()

    function Miles(num) {
        let divisor = 1000;
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

        let strMiles = Seccion(num, divisor, 'UN MIL', 'MIL');
        let strCentenas = Centenas(resto);

        if(strMiles == '')
            return strCentenas;

        return strMiles + ' ' + strCentenas;
    }//Miles()

    function Millones(num) {
        let divisor = 1000000;
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

      //  let strMillones = Seccion(num, divisor, 'UN MILLON DE', 'MILLONES DE');

      let strMillones = Seccion(num, divisor, millon(num, true), millon(num, false));
      
        let strMiles = Miles(resto);

        if(strMillones == '')
            return strMiles;

        return strMillones + ' ' + strMiles;
    }//Millones()

  function millon(num, singular) {
        var letraMillon = '';
        if (singular == true)
            letraMillon = 'UN MILLON';
        else
            letraMillon = 'MILLONES'
        if (num % 1000000 == 0)
            letraMillon = letraMillon + ' DE'
        return letraMillon;
    }
  
  
    return function NumeroALetras(num, currency) {
        currency = currency || {};
        let data = {
            numero: num,
            enteros: Math.floor(num),
            centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
            letrasCentavos: '',
            letrasMonedaPlural: currency.plural || 'PESOS',//'PESOS', 'Dólares', 'Bolívares', 'etcs'
            letrasMonedaSingular: currency.singular || 'PESO', //'PESO', 'Dólar', 'Bolivar', 'etc'
            letrasMonedaCentavoPlural: currency.centPlural || 'CENTAVOS',
            letrasMonedaCentavoSingular: currency.centSingular || 'CENTAVO'
        };

        if (data.centavos > 0) {
            data.letrasCentavos = 'CON ' + (function () {
                    if (data.centavos == 1)
                        return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoSingular;
                    else
                        return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoPlural;
                })();
        };

        if(data.enteros == 0)
            return 'CERO ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
        if (data.enteros == 1)
            return Millones(data.enteros) + ' ' + data.letrasMonedaSingular + ' ' + data.letrasCentavos;
        else
            return Millones(data.enteros) + ' ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
    };

})();