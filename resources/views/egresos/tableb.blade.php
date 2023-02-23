{{-- 
        "condid" => 68
        "condcve" => "210"
        "condnom" => "COND. PUERTA DEL RIO A.C."
        "chrid" => 1125
        "chrdate" => "2020-06-25"
        "chrcve" => 1000
        "chrfolio" => "0682006250022272001000011251"
        "concepto" => "PESONAL DE SEGURIDAD JUNIO"
        "razonsocial" => "Human Devolpment Services Arguello S. A. DE C. V."
        "nomcorto" => "11386"
        "chrstatus" => "Pagado"
        "cargo" => "19200.0000"
        "iva" => "3072.0000"
        "tpagos" => "22272.0000"
        "saldo" => "0.0000"
--}}

<table class="table table-responsive" id="propertyparameters-table">
    <thead>
        <tr>   
        <th>Id</th>       
        <th>Fecha</th>  
        <th>Cve</th> 
        <th>Concepto</th>  
        <th>Proveedor</th>         
        <th>Monto</th>     
        <th>IVA</th>        
        <th>Pagos</th>        
        <th>Saldo</th>        
        <th>Acción</th>    
        </tr>
    </thead>
    <tbody>
    @foreach($egresos as $egreso)
        <tr>
           <td>{!! $egreso->chrid !!}</td> 
           <td>{!! $egreso->chrdate !!}</td> 
           <td>{!! $egreso->chrcve !!}</td> 
           <td>{!! $egreso->concepto !!}</td> 
           <td>{!! $egreso->nomcorto.'-'.$egreso->razonsocial !!}</td>                    
           <td>{!! '$ '.number_format($egreso->cargo, 2, '.', ',') !!}</td> 
           <td>{!! '$ '.number_format($egreso->iva, 2, '.', ',') !!}</td> 
           <td>{!! '$ '.number_format($egreso->tpagos, 2, '.', ',') !!}</td> 
           <td>{!! '$ '.number_format($egreso->saldo, 2, '.', ',') !!}</td> 
           <td>
            @if ($egreso->saldo > 0)
              <a href="{!! route('checkissuances.emit',[$egreso->chrid]) !!}" 
                  class='btn btn-default btn-xs'>                  
                  <i class="glyphicon glyphicon-edit"></i>
              </a>
            @else
              <a href="" class='btn btn-default btn-xs' disabled="true" >
                  <i class="glyphicon glyphicon-thumbs-up " disabled="true"></i>
                  </a>
             @endif  

              <a href="{!! route('egresos.indexc', [$egreso->chrid]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-list-alt"></i>
              </a>
              
          </td>

           

         {{--   <td>{!! '$ '.number_format(
            $edocta->tcargo + $edocta->tiva, 2, '.', ',') !!}</td>
           <td>{!! '$ '.number_format($edocta->tpagos, 2, '.', ',') !!}</td>  
           <td>{!! '$ '.number_format($edocta->tsaldo, 2, '.', ',') !!}</td> 
            <td>               
                <div class='btn-group'>
                <a href="{!! route('edoscta.indexb', [$edocta->unidid,$dfrom,$dto]) !!}" 
                  class='btn btn-default btn-xs'>
                  <i class="glyphicon glyphicon-eye-open"></i>
                </a>
                </div>               
            </td>  --}}
        </tr>
    @endforeach
    </tbody>
</table>