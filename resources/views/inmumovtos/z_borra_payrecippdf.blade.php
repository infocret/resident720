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
             {{ $mhead->nomcorto." ".$mhead->razonsocial." ".$mhead->rfcmoral }}             
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
            {{ $mhead->folio }}
        </td> 
        <td class="dat1">
            {{ $mhead->ccve." - ".$mhead->cname }}
        </td> 
        <td class="dat1">
            {{ \Carbon\Carbon::parse($mhead->ffact)->format('d/m/Y') }}
        </td>      
        </tr>   
        </tbody>
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
               {{$mhead->ucve." ".$mhead->udesc }}
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
    <tr>  
    <td class="dat2c">               
        {{ \Carbon\Carbon::parse($movto->date)->format('d/m/Y') }}      
    </td>   
    <td class="dat2c">
        {{ $movto->catmovtocve.' - '.$movto->description }}
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
            {{ 'Saldo $ '.number_format($mhead->balance, 2, '.', ',') }}
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

    </table>

    </main>

    <footer>      

    
    </footer>

  </body>
</html>




