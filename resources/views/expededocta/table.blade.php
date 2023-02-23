{{-- 
  // "unidid" => 72
  // "unidcve" => "2104"
  // "unidnom" => "Departamento A-202"
  // "tcargo" => "3302.0000"
  // "tiva" => "0.0000"
  // "tpagos" => "0.0000"
  // "tsaldo" => "3302.0000"
--}}

<table class="table table-responsive" id="propertyparameters-table">
    <thead>
        <tr>        
        <th>Id</th>  
        <th>Cve</th> 
        <th>Nombre</th>
        <th>Tot Cargos</th> 
        <th>Tot Pagos</th> 
        <th>Tot Saldo</th> 
        <th>Detalle</th>
        </tr>
    </thead>
    <tbody>
    @foreach($edoscta as $edocta)
        <tr>
           <td>{!! $edocta->unidid !!}</td> 
           <td>{!! $edocta->unidcve !!}</td> 
           <td>{!! $edocta->unidnom !!}</td> 
           <td>{!! '$ '.number_format(
            $edocta->tcargo + $edocta->tiva, 2, '.', ',') !!}</td>
           <td>{!! '$ '.number_format($edocta->tpagos, 2, '.', ',') !!}</td>  
           <td>{!! '$ '.number_format($edocta->tsaldo, 2, '.', ',') !!}</td> 
            <td>               
                <div class='btn-group'>
                <a href="{!! route('edoscta.indexb', [$edocta->unidid,$dfrom,$dto,$cservid]) !!}" 
                  class='btn btn-default btn-xs'>
                  <i class="glyphicon glyphicon-eye-open"></i>
                </a>
                </div>               
            </td> 
        </tr>
    @endforeach
    </tbody>
</table>