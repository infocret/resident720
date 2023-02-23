{{-- 
  "unidid" => 71
  "providnom" => "ADP"
  "providrazsoc" => "Adprocon"
  "providrfc" => "1234567891234"
  "unidcve" => "2103"
  "unidname" => "A-201"
  "uniddesc" => "Departamento A-201"
  "chrid" => 3
  "area" => "Administración"
  "chrdate" => "2019-10-10"
  "chrfolio" => "0711910100003302001100000031"
  "chrcve" => 1100
  "chrname" => "Cuota de Mantenimiento  [octubre]"
  "chrtotal" => "3302.0000"
  "chriva" => "0.0000"
  "chrbalance" => "2950.0000"
  "chrstatus" => "Generado"
  "chrflink" => "N/A"

  // "movid" => 55
  // "movtipo" => "A"
  // "movdate" => "2019-10-23"
  // "movcant" => "1.0000"
  // "movumed" => "pago"
  // "movcve" => 1111
  // "movdesc" => "Abono Pago Cuota mantenimiento"
  // "movfolio" => "0711910230000300001111000552"
  // "movbalance" => "300.0000"
--}}
<table class="table table-responsive">
  <thead>
  <tr>
      <th class="tit1">
          Unidad
      </th >            
      <th class="tit1">
          Concepto / Servicio
      </th> 
      <th class="tit1">
          Fecha Aplicación
      </th>                  
  </tr>
  </thead>      
  <tbody>
  <tr>
    <td style="font-weight: bold;">
      {{ $charge->unidcve.' - '.$charge->uniddesc }}
    </td>
    <td style="font-weight: bold;"> 
      {{ $charge->chrcve.' - '.$charge->chrname }}    
    </td>
    <td style="font-weight: bold;">
        {{ \Carbon\Carbon::parse($charge->chrdate)->format('d/m/Y') }}
    </td>     
  </tr>
  </tbody>
</table>
    {{--  *****************    Concepto/Serv   ******************* --}}
    <table  class="table table-responsive">
        <thead>
        <tr>
            <th class="tit1">
                Folio
            </th>       
            <th class="tit1">
                Cargos
            </th>  
            <th class="tit1">
                Pagos
            </th>              
            <th class="tit1">
                Saldo
            </th>   
            <th class="tit1" colspan="3">
                Pago - EdoCta
            </th>        
        </tr>
        </thead>

        <tbody>
        <tr>    
           <td title="{{$charge->chrid }}">
                {{ $charge->chrfolio }}
            </td>    
            <td style="font-weight: bold;">
                {{ '$ '.number_format($charge->chrtotal + $charge->chriva, 2, '.', ',') }}
            </td> 
            <td style="font-weight: bold;">
                {{ '$ '.number_format($tpagos, 2, '.', ',') }}
            </td>                 
            <td style="font-weight: bold;">
                {{ '$ '.number_format($charge->chrbalance, 2, '.', ',') }}
            </td> 
            <td>              
                <div class='btn-group'>
                @if ($charge->chrbalance > 0)
                  <a href="{!! route('inmovto.createpay', [$charge->chrid]) !!}" 
                  class='btn btn-default btn-xs'>
                  <i class="glyphicon glyphicon-usd "></i>
                  </a>
                @else
                  <a href="" class='btn btn-default btn-xs' disabled="true" >
                  <i class="glyphicon glyphicon-thumbs-up " disabled="true"></i>
                  </a>
                @endif                 
                  <a href="{!! route('edoscta.indexc', [$charge->chrid]) !!}" 
                    class='btn btn-default btn-xs'>
                    <i class="glyphicon glyphicon-list-alt"></i>
                  </a>
                </div>              
            </td>                        
        </tr>   
        </tbody>
    </table>
    
    
{{-- ******************************* Cargos ************************************** --}}
    <div align="center" style="background: #eeeeee"> 
      Cargos Registrados
    </div>

<table class="table table-responsive" >
    <thead>
        <tr>                 
        <th>Fecha</th>        
        <th>Cant</th>       
        <th>um</th>
        <th>Folio</th>   
        <th>Cve</th>  
        <th>Descripción</th>  
        <th>Monto</th>                  
        <th>______</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cargos as $cargo)
        <tr>           
           <td>{{ \Carbon\Carbon::parse( $cargo->movdate)->format('d/m/Y') }}</td> 
           <td>{!! number_format($cargo->movcant, 2, '.', ',') !!}</td>  
           <td>{!! $cargo->movumed !!}</td>  
           <td title="{{$cargo->movid }}">{!! $cargo->movfolio !!}</td>
           <td>{!! $cargo->movcve !!}</td>
           <td>{!! $cargo->movdesc !!}</td>           
           <td>{!! '$ '.number_format($cargo->movbalance, 2, '.', ',') !!}</td>        
           <td>    
            <div class='btn-group'>                   
           @if (in_array($cargo->movcve, array(1106,1123,1143,1107,1124,1144)))          
            <a id='brunpop' class='btn btn-default btn-xs' 
            onclick="rollbackc('{{ $cargo->toJson() }}')">
              <i class="glyphicon glyphicon-minus-sign"></i>
            </a>            
           @else            
            <a href="" class='btn btn-default btn-xs'disabled="true">
              <i class="glyphicon glyphicon-ban-circle" disabled="true" ></i>
            </a>            
           @endif           
           </div>    
           </td> 
        </tr>
    @endforeach
    </tbody>
</table>

{{-- ******************************* Pagos ************************************** --}}
    <div align="center" style="background: #eeeeee"> 
      Pagos Registrados
    </div>

<table class="table table-responsive" >
    <thead>
        <tr>                 
        <th>Fecha</th>         
        <th>Cant</th>
        <th>um</th>
        <th>Folio</th>
        <th>Cve</th>        
        <th>Descripción</th>
        <th>Monto</th>                  
        <th>Recibo</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pagos as $pago)
        <tr>           
           <td>{{ \Carbon\Carbon::parse( $pago->movdate)->format('d/m/Y') }}</td>
           <td>{!! number_format($pago->movcant, 2, '.', ',') !!}</td>  
           <td>{!! $pago->movumed !!}</td>
           <td title="{{$pago->movid }}">{!! $pago->movfolio !!}</td>
           <td>{!! $pago->movcve !!}</td>           
           <td>{!! $pago->movdesc !!}</td>                    
           <td>{!! '$ '.number_format($pago->movbalance, 2, '.', ',') !!}</td>
            <td>              
            <div class='btn-group'>                   
          
             {{-- ini - Boton que llama a ventana modal de cancelacion --}}
             @if ($pago->estatus == 'Cancelado')
                  <a href="" class='btn btn-default btn-xs' disabled="true" >
                  <i class="glyphicon glyphicon-remove" disabled="true"></i>
                  </a>
                  <a href="" class='btn btn-default btn-xs' disabled="true" >
                  <i class="glyphicon glyphicon-ban-circle " disabled="true"></i>
                  </a>
                  <a href="" class='btn btn-default btn-xs' disabled="true" >
                  <i class="glyphicon glyphicon-ban-circle " disabled="true"></i>
                  </a>
             @else
                <a href="{!! route('cpay.receip',[$charge->chrid,$pago->movid]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-list-alt"></i>
                </a>      
                <a id='brunpope' class='btn btn-default btn-xs'
                onclick="fillmovtosed('{{ $pago->toJson() }}')"> 
                <i class="glyphicon glyphicon-pencil"></i>
                </a>                
                <a id='brunpop' class='btn btn-default btn-xs'
                onclick="fillmovtos('{{ $pago->toJson() }}',{{ $pago->movid }})"> 
                <i class="glyphicon glyphicon-minus-sign"></i>
                </a>               
             @endif

            </div>              
            </td> 
        </tr>
    @endforeach
    </tbody>
</table>