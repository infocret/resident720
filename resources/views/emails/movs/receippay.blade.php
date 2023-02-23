{{--   
 +"sfrom": "julio.buendia@infocret.com"
  +"sname": "Adprocon"
  +"sto": "user@mail.com"
  +"subj": "Recibo de Pago ADP"
  +"smsg": "Recibo de Pago ADP"
  +"ncondomi": "210 COND. PUERTA DEL RIO A.C."
  +"satach": "movscond1/0711910100003302001100000031.pdf"
  +"sfilename": "0711910100003302001100000031.pdf"
  +"smimetype": "application/pdf"
  +"uid": 71
  +"ucve": "2103"
  +"uname": "A-201"
  +"udesc": "Departamento A-201"
  +"hid": 3
  +"ccve": 1100
  +"cname": "Cuota de Mantenimiento  [octubre]"
  +"ffact": "2019-10-10"
  +"folio": "0711910100003302001100000031"
  +"area": "Administración"
  +"nomcorto": "ADP"
  +"razonsocial": null
  +"rfcmoral": "1234567891234"
  +"stotal": "3302.0000"
  +"iva": "0.0000"
  +"balance": "2950.0000"
  +"status": "Generado"
  +"filelink": "N/A"
  +"npropietario": "MARIA EUGENIA SAN VICENTE SAENZ"
  +"titprop": "Propietario"
  +"snotapie": ""
  +"snotapie2": ""

    "id" => 55
    "inmucharg_id" => 3
    "unidmovto_id" => 54
    "catmovto_cve" => 1111
    "date" => "2019-10-23"
    "folio" => "0711910230000300001111000552"
    "quantity" => "1.0000"
    "measurunit_id" => 25
    "amount" => "300.0000"
    "balance" => "300.0000"
    "status" => "Registrado"
    "apmode" => "Manual"
    "description" => "Abono Pago Cuota mantenimiento"
    "observ" => "user:1-Julio buendia"
    "filelink" => "N/A"
    "created_at" => "2019-10-23 23:54:31"
    "updated_at" => "2019-10-23 23:54:32"
    "deleted_at" => null

$propietario
 "id" => 174
    "name" => "BERNARDO"
    "appat" => "RUIZ"
    "apmat" => "CELORIO"
    "rfc" => "N/A"
    "inmueble_id" => 69
    "reltipo_id" => 1
    "nombre" => "Propietario"
    "descripcion" => "Propietario de un inmueble"


$ncondomi
"210 COND. PUERTA DEL RIO A.C."

$propaccount
 "scve" => 1100
    "sname" => "CuotaAdmin"
    "bname" => "SANTANDER"
    "bcta" => "65506816316"
    "bclabe" => "014180655068163169"
    "bconv" => "10000000001"
    "bref" => "20000000002"
    "rtext" => 
  "Si usted paga entre el día 16 y el último dia del mes 
   en curso el importe de su aportación deberá aumentar 
   en $ 330.00, por concepto   de pena convencional por mora. "
    "desc" => "Receptora de pagos de cuotas de mantenimiento"

 --}}

  <!DOCTYPE html>
<html lang="sp">
  <head>
    <meta charset="utf-8">
    <title>Adprocon - Recibo de Pago</title>    
  </head>

  <body style="margin: 20px 80px 20px 20px;">
    <header> 
         {{--  *****************     Logo condominio proveedor ******************* --}}
      <table
    style="width:106%;  
      height:auto;
      border-collapse:collapse;
      text-align:center;"> 
        <tr>
          <td id="logo" rowspan="4">        
            <img src="https://lh3.googleusercontent.com/jExe1-O3OuFpoYZseMMt9BKOVLncbHaH6_O4dAdSz3fdg1MTwcvW6DZh9PKLBhDqqZVrRIp6Axf_RwwU6wk_axyeGVPbK23SYhI83m061BfeWsRJNSp6Yhiz_yAutB7vJyvdLwyITw=w200-h92-no" 
            alt="Adprocon" /> 
          </td>
        </tr>

        <tr>
          <td style="
          font-family: Tahoma, Geneva, sans-serif;
          font-size: 15px;
          font-weight: bold;
          font-style: italic;
          color: #ffffff;
          text-align: center; 
          background: #DCDEE0;
          padding: 2px ;">
           Recibo de Pago
          </td>
        </tr>
        
        <tr>
          <td style="
          font-family: Tahoma, Geneva, sans-serif;
          font-size: 12px; 
          font-style: italic; 
          color: #000000;
          text-align: center;   
          padding: 2px ;">        
          {{ $edata->ncondomi }}                       {{-- *** CONDOMINIO *** --}}
          </td>
        </tr>

        <tr>
          <td style="
          font-family: Tahoma, Geneva, sans-serif;
          font-size: 12px; 
          font-style: italic; 
          color: #000000;
          text-align: center;   
          padding: 2px ;">                   
            {{ $edata->nomcorto." ".$edata->razonsocial." ".$edata->rfcmoral }}
          </td>
        </tr>

       </table>
    </header>

    <main>

    {{--  *****************     Datos del cargo ******************* --}}
    <table style="
      width:106%;  
      height:auto;
      border-collapse:collapse;
      text-align:center;"> 
        <thead>
        <tr>
            <th style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            text-align: center; 
            background: #DCDEE0;
            padding: 4px 10px;
            border: 2px solid white;">
                Folio Cargo
            </th>      
            <th style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            text-align: center; 
            background: #DCDEE0;
            padding: 4px 10px;
            border: 2px solid white;">
                Concepto Cargo
            </th>  
            <th style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            text-align: center; 
            background: #DCDEE0;
            padding: 4px 10px;
            border: 2px solid white;">
                Fecha Cargo
            </th>                 
        </tr>
        </thead>

        <tbody>
        <tr>
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
            {{ $edata->folio }}
        </td> 
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
            {{ $edata->ccve." - ".$edata->cname }}
        </td> 
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
            {{ \Carbon\Carbon::parse($edata->ffact)->format('d/m/Y') }}
        </td>      
        </tr>   
        </tbody>
    </table>

   {{-- <div style="clear:both; margin:10px" > </div>   Separador --}}

   {{--  *****************     Unidad, Propietario ******************* --}}
    <table style="
      width:106%;  
      height:auto;
      border-collapse:collapse;
      text-align:center;">
    <thead>
        <tr> {{-- Tipo de relacion de la persona e inmueble --}}
            <th style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            text-align: center; 
            background: #DCDEE0;
            padding: 4px 10px;
            border: 2px solid white;">
                Recibimos de
            </th>
           <th style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            text-align: center; 
            background: #DCDEE0;
            padding: 4px 10px;
            border: 2px solid white;">
                Unidad
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
               {{ $edata->npropietario }}
            </td>            
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
               {{$edata->ucve." ".$edata->udesc }}
            </td>
        </tr>   
    </tbody>
    </table>
    {{--  *****************  Movimiento ******************* --}}
    <table style="
      width:106%;  
      height:auto;
      border-collapse:collapse;
      text-align:center;">
    <thead>
    <tr>
    <th style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            text-align: center; 
            background: #DCDEE0;
            padding: 4px 10px;
            border: 2px solid white;">
    Fecha Pago
    </th>    
    <th style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            text-align: center; 
            background: #DCDEE0;
            padding: 4px 10px;
            border: 2px solid white;">
    Concepto Pago
    </th>     
   <th style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 13px;
            font-weight: bold;
            color: #000000;
            text-align: center; 
            background: #DCDEE0;
            padding: 4px 10px;
            border: 2px solid white;">
    Cantidad
    </th>
    </tr>
    </thead>

    <tbody>
    <tr>  
      <td style="
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 12px;
      color: #000000;
      text-align: center;   
      padding: 4px 10px; ">         
        {{ \Carbon\Carbon::parse($movto->date)->format('d/m/Y') }}      
    </td>   
      <td style="
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 12px;
      color: #000000;
      text-align: center;   
      padding: 4px 10px; ">
        {{ $movto->catmovto_cve.' - '.$movto->description }}
    </td>       
    
      <td style="
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 12px;
      color: #000000;
      text-align: center;   
      padding: 4px 10px; ">
        {{ '$ '.number_format($movto->balance, 2, '.', ',') }}
    </td>
    </tr>

   
    </tbody>

    </table>

     {{--<div style="clear:both; margin:10px" > </div>    Separador --}}

 {{--  ***************** Leyenda  ******************* --}}    
    <table>


        <tr>
        <td>
          <p
            style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
            Conforme al presupuesto autorizado por asamblea general de condominio.
            </p>    
            <p style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
            Exija el original de este recibo como un comprobante de su aportación.
            </p>
        </td>
        <td style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 12px;
        color: #000000;
        text-align: right;   
        padding: 4px 10px; ">
            {{ 'Saldo $ '.number_format($edata->balance, 2, '.', ',') }}
        </td> 
        </tr>
    </table>

    {{--  ***************** Folio - Codigo de Barras  ******************* --}}
    <table style="
      width:106%;  
      height:auto;
      border-collapse:collapse;
      text-align:center;"> 

    {{-- <div style="clear:both; margin:10px" > </div> Separador --}}

    <tr>
        <td>                              {{-- *** CODIGO DE BARRAS FOLIO *** --}} 
           {!! '<img src="data:image/png;base64,' . 
        DNS1D::getBarcodePNG($movto->folio, "C39",1,35,array(0,0,0),true) . '" 
        alt="FolioBbarCode"   />'  !!}
        </td>
    </tr>
    <tr>
        <td style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10px;
        font-style: italic;
        color: #000000;
        text-align: center;   
        padding: 4px 10px; ">
        {{ $movto->folio }} {{-- *** FOLIO *** --}} 
        </td>
    </tr>
    <tr>
        <td style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10px;
        font-style: italic;
        color: #000000;
        text-align: center;   
        padding: 4px 10px; ">
        {{ $edata->snotapie }} {{-- *** Desc de lectura de gas *** --}} 
        </td>
    </tr>
    </table>



    </main>

    <footer>      

    
    </footer>

  </body>
</html>




