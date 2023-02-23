{{-- 
        // "unidid" => 71
        // "providnom" => "ADP"
        // "providrazsoc" => "Adprocon"
        // "providrfc" => "1234567891234"
        // "unidcve" => "2103"
        // "unidname" => "A-201"
        // "uniddesc" => "Departamento A-201"
        // "chrid" => 3
        // "area" => "Administración"
        // "chrdate" => "2019-10-10"
        // "chrfolio" => "0711910100003302001100000031"
        // "chrcve" => 1100
        // "chrname" => "Cuota de Mantenimiento  [octubre]"
        // "chrtotal" => "3302.0000"
        // "chriva" => "0.0000"
        // "chrbalance" => "2950.0000"
        // "chrstatus" => "Generado"
        // "chrflink" => "N/A"  

        "id" => 57
        "inmucharg_id" => 3
        "unidmovto_id" => 54
        "catmovto_cve" => 1111
        "date" => "2019-10-23"
        "folio" => "0711910230000050001111000572"
        "quantity" => "1.0000"
        "measurunit_id" => 25
        "amount" => "50.0000"
        "balance" => "50.0000"
        "status" => "Registrado"
        "apmode" => "Manual"
        "description" => "Abono Pago Cuota mantenimiento"
        "observ" => "user:1-Julio buendia"
        "filelink" => "N/A"
        "created_at" => "2019-10-23 23:58:56"
        "updated_at" => "2019-10-23 23:58:56"
        "deleted_at" => null        
--}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Adprocon - Recibo de Pago</title>
    <link rel="stylesheet" 
     href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/').'/css/pdfrecip.css' }}" media="all" /> 
  </head>

  <body>
    <header> 
      <table> {{--  *****************     Logo condominio proveedor ******************* --}}
        
        <tr>
          <td id="logo" rowspan="4">        
           <img src="{{ url('/').'/img/adplogo_200h.png' }}">
          </td>
        </tr>

        <tr>
          <td class="titulo">
           Recibo de Pago
          </td>
        </tr>
        
        <tr>
          <td class="datpc">        
             {{ $ncondomi }}
          </td>
        </tr>

        <tr>
          <td class="datpc">
             {{ $charge->providnom." ".$charge->providrazsoc." ".$charge->providrfc }}             
          </td>
        </tr>

       </table>
    </header>

    <main>

    {{--  *****************     Datos del cargo ******************* --}}
    <table  class="table table-responsive">
        <thead>
        <tr>
            <th class="tit1">
                Folio Cargo
            </th>      
            <th class="tit1">
                Concepto Cargo
            </th>  
            <th class="tit1">
                Fecha Cargo
            </th>                 
        </tr>
        </thead>

        <tbody>
        <tr>
        <td class="dat1">
            {{ $charge->chrfolio }}
        </td> 
        <td class="dat1">
            {{ $charge->chrcve." - ".$charge->cdesc}}
        </td> 
        <td class="dat1">
            {{ \Carbon\Carbon::parse($charge->chrdate)->format('d/m/Y') }}
        </td>      
        </tr>   
        </tbody>charge
    </table>

    <div style="clear:both; margin:10px" > </div>  {{-- Separador --}}

   {{--  *****************     Unidad, Propietario ******************* --}}
    <table  class="table table-responsive"> 
    <thead>
        <tr>
            <th class="tit1"> {{-- Tipo de relacion de la persona e inmueble --}}
                Recibimos de
            </th>
            <th class="tit1">
                Unidad
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="dat1">
               {{ $propietario->name." ".$propietario->apmat." ".$propietario->appat }}
            </td>            
            <td class="dat1">
               {{$charge->unidcve." ".$charge->uniddesc }}
            </td>
        </tr>   
    </tbody>
    </table>
    {{--  *****************  Movimiento ******************* --}}
    <table  class="table table-responsive"> 

    <thead>
    <tr>
    <th class="tit2">Fecha Pago</th>    
    <th class="tit2">Concepto Pago</th>     
    <th class="tit2">Cantidad</th>
    </tr>
    </thead>
    <tbody>
    <tr>  
    <td class="dat2c">               
        {{ \Carbon\Carbon::parse($movto->date)->format('d/m/Y') }}      
    </td>   
    <td class="dat2c">
        {{ $movto->catmovto_cve.' - '.$movto->description }}
    </td>       
    
    <td class="dat2c" style="font-weight: bold; font-size: 13px;">
        {{ '$ '.number_format($movto->balance, 2, '.', ',') }}
    </td>
    </tr>
   
    </tbody>

    </table>

     <div style="clear:both; margin:10px" > </div> {{--   Separador --}}

 {{--  ***************** Leyenda  ******************* --}}    
    <table>

        <tr>
        <td>
            <p class="datpc"> 
            Conforme al presupuesto autorizado por asamblea general de condominio.
            </p>    
            <p class="datpc">
            Exija el original de este recibo como un comprobante de su aportación.
            </p>
        </td>
        <td class="tit2" >
            {{ 'Saldo $ '.number_format($charge->chrbalance, 2, '.', ',') }}
        </td> 
        </tr>
    </table>

    
    {{--  ***************** Folio - Codigo de Barras  ******************* --}}    
    <table> 
    <tr>
        <td>
        {!! '<img src="data:image/png;base64,' . 
        DNS1D::getBarcodePNG($movto->folio, "C39",1,35,array(0,0,0),true) . '" 
        alt="FolioBbarCode"   />'  !!}
        </td>
    </tr>
    <tr>
        <td class="dat3"> {{ $movto->folio }} </td>        
    </tr>
    <tr>
        <td class="dat3"> {{ $charge->chrname }} </td>
    </tr>
    </table>

    </main>

    <footer>      

    
    </footer>

  </body>
</html>




