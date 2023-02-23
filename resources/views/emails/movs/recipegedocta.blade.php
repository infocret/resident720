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


  // $datmail->bname         = $propaccount->bname;      // Banco
        // $datmail->bcta          = $propaccount->bcta;       // Numero de cuenta
        // $datmail->bclabe        = $propaccount->bclabe;     // CLABE
        // $datmail->bconv         = $propaccount->bconv;      // convenio
        // $datmail->bref          = $propaccount->bref;       // referencia

 --}}
<!DOCTYPE html>
<html lang="sp">
  <head>
    <meta charset="utf-8">
    <title>Adprocon - EdoCta</title>
  </head>
        {{--  *****************     Este se envia correctamente !! ******************* --}}
  <body style="margin: 20px 80px 20px 20px;">
    <header> 
      {{--  *****************     Logo condominio proveedor ******************* --}}
      <table style="
      width:106%;  
      height:auto;
      border-collapse:collapse;
      text-align:center;">         
        <tr>
          <td id="logo" rowspan="4">        
          {{--  <img src="{{ url('/').'/img/adplogo_200h.png' }}"> --}}                   
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
               Estado de Cuenta
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
    
    {{--  *****************     Unidad, Propietario ******************* --}}    
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
                Unidad
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
              {{--    {{ $edata->titprop }}    Relaacion PROPIETARIO  --}}
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
               Fecha Aplicación
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
               {{ $edata->ucve." ".$edata->udesc }} {{-- *** UNIDAD *** --}}
            </td>
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">                                                               
              {{ $edata->nproveedor }} {{-- $edata->npropietario *** NOMBRE POPIETARIO *** --}}
            </td>
            <td style=" 
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">                       {{-- *** FECHA APLICACION *** --}} 
              {{ \Carbon\Carbon::parse($edata->ffact)->format('d/m/Y') }}              
            </td>                        
        </tr>   
    </tbody>
    </table>

    {{--  *****************     Unidad, Propietario ******************* --}}
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
                Area
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
               Folio
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
               Concepto
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
              {{ $edata->area }} {{-- *** AREA *** --}} 
            </td>
            <td style=" 
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
              {{ $edata->folio }} {{-- *** FOLIO *** --}} 
            </td>
            <td style=" 
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
               {{ $edata->ccve." - ".$edata->cname }} {{-- *** CONCEPTO *** --}} 
            </td>

        </tr>   
        </tbody>
    </table>


    <div style="clear:both; margin:10px" > </div> {{-- Separador --}}

    {{--  *****************  Detalles ******************* --}}
    <div align="center" style="color: gray">
        Detalle de Movimientos
    </div>
    <table style="
      width:106%;  
      height:auto;
      border-collapse:collapse;
      text-align:center;"> 

    <thead>
        <tr>
        <th style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 11px;
        font-weight: bold;
        color: #000000;
        text-align: center; 
        background: #DCDEE0;
        padding: 4px 10px;
        border: 2px solid white;">
        Fecha</th>          
        <th style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 11px;
        font-weight: bold;
        color: #000000;
        text-align: center; 
        background: #DCDEE0;
        padding: 4px 10px;
        border: 2px solid white;">
        Cant.</th>
        <th style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 11px;
        font-weight: bold;
        color: #000000;
        text-align: center; 
        background: #DCDEE0;
        padding: 4px 10px;
        border: 2px solid white;">
        Unid.</th>
        <th style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 11px;
        font-weight: bold;
        color: #000000;
        text-align: center; 
        background: #DCDEE0;
        padding: 4px 10px;
        border: 2px solid white;">
        Descripción</th>
        <th style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 11px;
        font-weight: bold;
        color: #000000;
        text-align: center; 
        background: #DCDEE0;
        padding: 4px 10px;
        border: 2px solid white;">
        P.Unit.</th>    
        <th style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 11px;
        font-weight: bold;
        color: #000000;
        text-align: center; 
        background: #DCDEE0;
        padding: 4px 10px;
        border: 2px solid white;">
        Subt.</th>
        </tr>
    </thead>

    <tbody>
   @foreach($details as $detail) 

        <tr>
          
        <td style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10px;
        color: #000000;
        text-align: center;   
        padding: 4px 10px;   
        /*border: 1px solid black;*/
        border-bottom: 1px solid black;">
          {{-- *** FECHA *** --}}
          {{ \Carbon\Carbon::parse($detail->movdate)->format('d/m/Y')}}
        </td>

        <td style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10px;
        color: #000000;
        text-align: center;   
        padding: 4px 10px;   
        /*border: 1px solid black;*/
        border-bottom: 1px solid black;">
          {{number_format($detail->movcant, 2, '.', ',') }} {{-- *** CANTIDAD *** --}}
        </td>
        <td style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10px;
        color: #000000;
        text-align: center;   
        padding: 4px 10px;   
        /*border: 1px solid black;*/
        border-bottom: 1px solid black;">
          {{ $detail->movumed }} {{-- *** UNIDAD *** --}}
        </td>
        <td style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10px;
        color: #000000;
        text-align: left;   
        padding: 4px 10px;   
        /*border: 1px solid black;*/
        border-bottom: 1px solid black;">
          {{-- *** DESCRIPCION  *** --}}
          {{ $detail->movcve.' - '.$detail->movdesc.' Fol.: '.$detail->movfolio }} 
        </td>
        <td style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10px;
        color: #000000;
        text-align: right;   
        padding: 4px 10px;   
        /*border: 1px solid black;*/
        border-bottom: 1px solid black;">
        {{ '$ '.number_format($detail->movpunit, 2, '.', ',') }} {{-- * PRECIO UNITARIO * --}}
        </td>    
        <td style="
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10px;
        color: #000000;
        text-align: right;   
        padding: 4px 10px;   
        /*border: 1px solid black;*/
        border-bottom: 1px solid black;">
        {{ '$ '.number_format($detail->movbalance, 2, '.', ',') }}  {{-- * SUBTOTAL * --}}
        </td>
        </tr>

	 @endforeach
    </tbody>

    </table>

    <div style="clear:both; margin:10px" > </div> {{-- Separador --}}

    {{--  *****************     Estatus, Subtotal, IVA, Total ******************* --}}
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
                Estatus
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
               Cargos
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
               I.V.A.
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
               Total
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
               Pagos
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
               Saldo
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
              {{ $edata->status }} {{-- *** ESTATUS *** --}} 
            </td>
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
              {{ '$ '.number_format($edata->stotal, 2, '.', ',') }} {{-- *** Cargos *** --}} 
            </td>
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
               {{ '$ '.number_format($edata->iva, 2, '.', ',') }}  {{-- *** IVA *** --}} 
            </td>
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            font-weight: bold;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">      {{-- *** Total *** --}} 
               {{ '$ '.number_format($edata->iva+$edata->stotal, 2, '.', ',') }} 
            </td>            
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            font-weight: bold;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">       {{-- *** tot Pagos  *** --}}    
                {{ '$ '.number_format($edata->tpagos, 2, '.', ',') }}
            </td>  
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            font-weight: bold;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">       {{-- *** Saldo  *** --}}    
                {{ '$ '.number_format($edata->balance, 2, '.', ',') }}
            </td>           
        </tr>   
    </tbody>

    </table>

    <p style="
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 12px; 
      font-style: italic; 
      color: #000000;
      text-align: center;   
      padding: 2px ;"> 
     Datos para realizar su  pago - deposito - transferencia.
   </p>  


    {{--  *****************  Cta de Deposito ******************* --}}
{{-- 
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
                Beneficiario
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
                Banco
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
                Número de Cuenta
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
                CLABE
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
                Convenio
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
                Referencia
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
                {{ $edata->ncondomi }}
            </td>
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
                {{ $edata->bname }}
            </td>
            <td class="dat1">
               {{ $edata->bcta }}
            </td>
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
                {{ $edata->bclabe }}
            </td>
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
                {{ $edata->bconv }}
            </td> 
            <td style="
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #000000;
            text-align: center;   
            padding: 4px 10px; ">
                {{ $edata->bref }}
            </td>                        
        </tr>   
        </tbody>
    </table>
 --}}
    {{--  ***************** Folio - Codigo de Barras  ******************* --}}
    <table style="
      width:106%;  
      height:auto;
      border-collapse:collapse;
      text-align:center;"> 

    <div style="clear:both; margin:10px" > </div> {{-- Separador --}}

    <tr>
        <td>                              {{-- *** CODIGO DE BARRAS FOLIO *** --}} 
           {!! '<img src="data:image/png;base64,' . 
        DNS1D::getBarcodePNG($edata->folio, "C39",1,35,array(0,0,0),true) . '" 
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
        {{ $edata->folio }} {{-- *** FOLIO *** --}} 
        </td>
    </tr>

    </table>

    </main>

    <footer>   
    <p style="
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 12px; 
      font-style: italic; 
      color: #000000;
      text-align: center;   
      padding: 2px ;"> 
       {{ $edata->snotapie }} {{-- *** Linea a pie de pagina *** --}}   
    </p> 
    <p style="
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 12px; 
      font-style: italic; 
      color: #000000;
      text-align: center;   
      padding: 2px ;"> 
       {{ $edata->snotapie2 }} {{-- *** Linea2 a pie de pagina *** --}}   
    </p> 
    <p style="
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 12px; 
      font-style: italic; 
      color: #000000;
      text-align: center;   
      padding: 2px ;"> 
      {{ "Nota: ".$edata->smsg }} {{-- *** Nota o mensaje *** --}}       
    </p>   
    </footer>

  </body>
</html>




