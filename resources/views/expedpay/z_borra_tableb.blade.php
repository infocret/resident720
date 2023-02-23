{{-- 
  // "unidid" => 69
  // "unidcve" => "2101"
  // "unidname" => "Departamento A-101"
  // "chrid" => 1
  // "chrdate" => "2019-10-10"
  // "chrcve" => 1100
  // "chrdesc" => "Cuota de Mantenimiento  [octubre]"
  // "chrfolio" => "0691910100003302001100000011"
  // "chrstot" => "3302.0000"
  // "chriva" => "0.0000"
  // "chrsaldo" => "0.0000"
  // "chrtotpagos" => "3302.0000"
--}}

<table class="table table-responsive" id="propertyparameters-table">
    <thead>
        <tr>                
        <th>Fecha</th> 
        <th>Concepto</th>                 
        <th>Folio</th>          
        <th>Cargos</th>          
        <th>Pagos</th>  
        <th>Saldo</th>          
        <th colspan="3">Acción</th>
        </tr>
    </thead>
    <tbody>
    @foreach($edoscta as $edocta)
        <tr>          
           <td>{{ \Carbon\Carbon::parse( $edocta->chrdate)->format('d/m/Y') }}</td> 
           <td>{!! $edocta->chrcve.' - '.$edocta->chrdesc !!}</td>
           <td>{!! $edocta->chrfolio !!}</td>           
           <td>{!! '$ '.number_format($edocta->chrstot + $edocta->chriva, 2, '.', ',') !!}</td>
           <td>{!! '$ '.number_format($edocta->chrtotpagos, 2, '.', ',') !!}</td>
           <td>{!! '$ '.number_format($edocta->chrsaldo, 2, '.', ',') !!}</td>  
            <td>              
                <div class='btn-group'>                    
                @if ($edocta->chrsaldo > 0)
                  <a href="{!! route('inmovto.createpay', [$edocta->chrid,'']) !!}" 
                  class='btn btn-default btn-xs'>
                  <i class="glyphicon glyphicon-usd "></i>
                  </a>
                @else
                  <a href="" class='btn btn-default btn-xs' disabled="true" >
                  <i class="glyphicon glyphicon-thumbs-up " disabled="true"></i>
                  </a>
                @endif 
                  <a href="{!! route('cpay.indexd', [$edocta->chrid,$edocta->unidid]) !!}" class='btn btn-default btn-xs'>
                  <i class="glyphicon glyphicon-eye-open"></i>
                  </a>
                </div>              
            </td> 
        </tr>
    @endforeach
    </tbody>
</table>