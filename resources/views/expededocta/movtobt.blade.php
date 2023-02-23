

    {{--  *****************     Logo condominio proveedor ******************* --}}
    <table class="table table-responsive"> 

    <tr>
      <td id="logo" rowspan="4">        
       <img src="{{ url('/').'/img/adplogo_200h.png' }}">
      </td>
    </tr>

    <tr>
      <td class="titulo">
        Estado de Cuenta
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

    {{--  *****************     Unidad, Propietario ******************* --}}
    <table  class="table table-responsive"> 
    <thead>
        <tr>
            <th class="tit1">
                Unidad
            </th>
            <th class="tit1"> {{-- Tipo de relacion de la persona e inmueble --}}
                {{ $propietario->nombre }}
            </th>
            <th class="tit1">
                Fecha Aplicación
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="dat1">
                {{$charge->unidcve." ".$charge->uniddesc }}
            </td>
            <td class="dat1">
                {{ $propietario->name." ".$propietario->apmat." ".$propietario->appat }}
            </td>
            <td class="dat1">
               {{ \Carbon\Carbon::parse($charge->chrdate)->format('d/m/Y') }}
            </td>
        </tr>   
    </tbody>
    </table>

    {{--  *****************     Unidad, Propietario ******************* --}}
    <table  class="table table-responsive">
        <thead>
        <tr>
            <th class="tit1">
                Area
            </th>
            <th class="tit1">
                Folio
            </th>      
            <th class="tit1">
                Concepto
            </th>                   
        </tr>
        </thead>

        <tbody>
        <tr>
            <td class="dat1">
                {{ $charge->area }}
            </td>
            <td class="dat1">
                {{ $charge->chrfolio }}
            </td> 
            <td class="dat1">
                {{ $charge->chrcve." - ".$charge->cdesc }}
            </td>                       
        </tr>   
        </tbody>
    </table>

    <div style="clear:both; margin:10px" > </div> {{-- Separador --}}    
    
    {{--  *****************  Detalles ******************* --}}
    <div align="center" style="color: gray">
        Detalle de Movimientos
    </div>
    <table  class="table table-responsive"> 

    <thead>
    <tr>
    <th class="tit2">Fecha</th>    
    <th class="tit2">Cant.</th>
    <th class="tit2">Unid.</th>
    {{-- <th class="tit2">Cve</th>     --}}
    <th class="tit2">Descripción</th>
    <th class="tit2">P.Unit.</th>    
    <th class="tit2">Subt.</th>
    </tr>
    </thead>

    <tbody>
    @foreach($details as $detail)

    <tr>  
    <td class="dat2c">{{ \Carbon\Carbon::parse($detail->movdate)->format('d/m/Y')}}</td>
    <td class="dat2c">{{ number_format($detail->movcant, 2, '.', ',') }}</td>
    <td class="dat2l">{{ $detail->movtipo}}</td>
    {{--  <td class="dat2c">{{ $detail->cve}}</td>     --}}
    <td class="dat2l">
    {{ $detail->movcve.' - '.$detail->movdesc.' Fol.: '.$detail->movfolio}}
    </td>
    <td class="dat2r">{{ '$ '.number_format($detail->movpunit, 2, '.', ',') }}</td>    
    <td class="dat2r">{{ '$ '.number_format($detail->movbalance, 2, '.', ',') }}</td>
    </tr>

    @endforeach
    </tbody>

    </table>

    <div style="clear:both; margin:10px" > </div> {{-- Separador --}}

    {{--  *****************     Estatus, Subtotal, IVA, Total ******************* --}}
    <table  class="table table-responsive">   
    <thead>
        <tr>
            <th class="tit1">
               Estatus
            </th>
            <th class="tit1">
               Cargos
            </th>
            <th class="tit1">
               I.V.A.
            </th> 
            <th class="tit1">
               Total
            </th> 
            <th class="tit1">
               Pagos
            </th>
            <th class="tit1">
               Saldo
            </th>                       
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="dat1">
               {{ $charge->chrstatus }}
            </td>
            <td class="dat1">
              {{ '$ '.number_format($charge->chrtotal, 2, '.', ',') }}
            </td>
            <td class="dat1">
               {{ '$ '.number_format($charge->chriva, 2, '.', ',') }}
            </td>
            <td class="dat1" style="font-weight: bold;">
               {{ '$ '.number_format($charge->chriva+$charge->chrtotal, 2, '.', ',') }}
            </td>
            <td class="dat1" style="font-weight: bold;">
                {{ '$ '.number_format($tpagos, 2, '.', ',') }}
            </td>           
            <td class="dat1" style="font-weight: bold;">
                {{ '$ '.number_format($charge->chrbalance, 2, '.', ',') }}
            </td>           
        </tr>   
    </tbody>
    </table>
    {{-- Separador --}}
    <div style="clear:both; margin:10px; border-bottom: 1px solid black;" > </div> 

        <p class="datpc"> Datos para realizar su  pago - deposito - transferencia.</p>  


    {{--  *****************  Cta de Deposito ******************* --}}

    <table  class="table table-responsive">
        <thead>
        <tr>
            <th class="tit1">
                Beneficiario
            </th>
            <th class="tit1">
                Banco
            </th>
            <th class="tit1">
                Número de Cuenta
            </th>
            <th class="tit1">
                CLABE
            </th> 
            <th class="tit1">
                Convenio
            </th>       
            <th class="tit1">
                Referencia
            </th>                   
        </tr>
        </thead>

        <tbody>
        <tr>
            <td class="dat1">
                {{ $ncondomi }}
            </td>
            <td class="dat1">
                {{ $propaccount->bname }}
            </td>
            <td class="dat1">
               {{ $propaccount->bcta }}
            </td>
            <td class="dat1">
                {{ $propaccount->bclabe }}
            </td>
            <td class="dat1">
                {{ $propaccount->bconv }}
            </td> 
            <td class="dat1">
                {{ $propaccount->bref }}
            </td>                        
        </tr>   
        </tbody>
    </table>

    <div style="clear:both; margin:10px; border-bottom: 1px solid black;" > </div> {{-- Separador --}}

    {{--  ***************** Folio - Codigo de Barras  ******************* --}}
    <table  class="table table-responsive">
    
    <tr>
        <td>
        {!! '<img src="data:image/png;base64,' . 
        DNS1D::getBarcodePNG($charge->chrfolio, "C39",1,35,array(0,0,0),true) . '" 
        alt="FolioBbarCode"   />'  !!}
        </td>
    </tr>
    <tr>
        <td class="dat3"> {{ $charge->chrfolio }} </td>
    </tr>

    </table>
    @if ($charge->chrcve == '1140')
        <p class="datpc">  {{ $charge->chrname }}</p> 
    @elseif ($charge->chrcve == '1100')
        <p class="datpc"> {{ $propaccount->rtext }}</p> 
    @endif


    {{-- <p class="datpc">Posterior al dia último se adicionara el 10 % por mes o fracción. </p> --}}


