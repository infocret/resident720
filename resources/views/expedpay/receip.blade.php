{{--  *****************     Logo condominio proveedor ******************* --}}     
     <table class="table table-responsive">   
        
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
    <table class="table table-responsive">
        <tbody>
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
        </tbody>
    </table>

    
    {{--  ***************** Folio - Codigo de Barras  ******************* --}}    
    <table class="table table-responsive">    
    <tbody>
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
    </tbody>
    </table>
