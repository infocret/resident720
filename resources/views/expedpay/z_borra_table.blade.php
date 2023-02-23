{{-- 
// "unidid" => 70
// "unidcve" => "2102"
// "unidname" => "Departamento A-102"
// "tstotal" => "3302.0000"
// "totiva" => "0.0000"
// "totpagos" => "3000.0000"
// "tsaldo" => "302.0000"
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
           <td>{!! $edocta->unidname !!}</td> 
           <td>{!! '$ '.number_format($edocta->tstotal + $edocta->totiva, 2, '.', ',') !!}</td> 
           <td>{!! '$ '.number_format($edocta->totpagos, 2, '.', ',') !!}</td> 
           <td>{!! '$ '.number_format($edocta->tsaldo, 2, '.', ',') !!}</td> 
            <td>               
                <div class='btn-group'>
                    <a href="{!! route('cpay.indexb', [$edocta->unidid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                </div>               
            </td> 
        </tr>
    @endforeach
    </tbody>
</table>