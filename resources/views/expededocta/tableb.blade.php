{{-- 
        "unidid" => 120
        "unidcve" => "2101"
        "unidnom" => "Departamento A-101"
        "conceptserid" => 1
        "chrid" => 377
        "chrdate" => "2019-04-01"
        "chrcve" => 1100
        "chrfolio" => "1201904010003302111100003771"
        "concepto" => "Cuota de Mantenimiento [abril]"
        "chrstatus" => "Pagado"
        "tcargo" => "3302.1100"
        "tiva" => "0.0000"
        "tpagos" => "3302.1100"
        "tsaldo" => "0.0000"
--}}

<table class="table table-responsive" id="propertyparameters-table">
    <thead>
        <tr>        
        <th>Fecha</th> 
        <th>Concepto</th> 
        <th>Folio</th>                
        <th>Estatus</th>  
        <th>Tot Cargos</th>          
        <th>Tot Pagos</th>          
        <th>Saldo</th>
        <th colspan="3">Acción</th>        
        </tr>
    </thead>
    <tbody>
    @foreach($edoscta as $edocta)
        <tr>                   
           <td>{{ \Carbon\Carbon::parse( $edocta->chrdate)->format('d/m/Y') }}</td> 
           <td>{!! $edocta->chrcve.' - '.$edocta->concepto !!}</td>
           <td title="{{$edocta->chrid }}">{!! $edocta->chrfolio !!}</td>                      
           <td>{!! $edocta->chrstatus !!}</td>
           <td>{!! '$ '.number_format($edocta->tcargo + $edocta->tiva, 2, '.', ',') !!}</td>
           <td>{!! '$ '.number_format($edocta->tpagos, 2, '.', ',') !!}</td>
           <td>{!! '$ '.number_format($edocta->tsaldo, 2, '.', ',') !!}</td>           
            <td>              
              <div class='btn-group'> 

              @if ($edocta->tsaldo > 0)
                  <a href="{!! route('inmovto.createpay', [$edocta->chrid]) !!}" 
                  class='btn btn-default btn-xs'>
                  <i class="glyphicon glyphicon-usd "></i>
                  </a>
              @else
                  <a href="" class='btn btn-default btn-xs' disabled="true" >
                  <i class="glyphicon glyphicon-thumbs-up " disabled="true"></i>
                  </a>
              @endif  
           
              <a href="{!! route('edoscta.indexd', [$edocta->chrid,$dfrom,$dto,$cservid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-list-alt"></i></a>
              </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>