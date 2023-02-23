{{-- 
  "unidid" => 69
  "unidcve" => "2101"
  "unidname" => "A-101"
  "chrid" => 1
  "chrdate" => "2019-10-10"
  "chrcve" => 1100
  "chrdesc" => "Cuota de Mantenimiento  [octubre]"
  "chrfolio" => "0691910100003302001100000011"
  "chrsaldo" => "3302.0000"
  "movid" => 52
  "movdate" => "2019-10-14"
  "movtocve" => 1111
  "movdesc" => "Abono Pago Cuota mantenimiento"
  "movfolio" => "0691910140003302001111000012"
  "movtpago" => "3302.0000"
--}}

    {{--  *****************    Cargo   ******************* --}}
    <table  class="table table-responsive">
        <thead>
        <tr>
            <th class="tit1">
                Fecha Aplicación
            </th>            
            <th class="tit1">
                Folio
            </th>       
            <th class="tit1">
                Cargo
            </th>               
            <th class="tit1">
                Saldo
            </th>   
            <th colspan="3">
                Pago - EdoCta
            </th>        
        </tr>
        </thead>

        <tbody>
        <tr>            

            <td class="dat1">
               {{ \Carbon\Carbon::parse($charge->chrdate)->format('d/m/Y') }}
            </td>         
           <td class="dat1">
                {{ $charge->chrfolio }}
            </td>    
            <td class="dat1" style="font-weight: bold;">
                {{ '$ '.number_format($charge->chrtotal + $charge->chriva, 2, '.', ',') }}
            </td>                
            <td class="dat1" style="font-weight: bold;">
                {{ '$ '.number_format($charge->chrsaldo, 2, '.', ',') }}
            </td> 
            <td>              
                <div class='btn-group'>
                @if ($charge->chrsaldo > 0)
                  <a href="{!! route('inmovto.createpay', [$charge->chrid,'']) !!}" 
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
    
    
{{-- ******************************* Pagos ************************************** --}}
    <div align="center" style="background: #eeeeee"> 
      Pagos Registrados
    </div>

<table class="table table-responsive" id="propertyparameters-table">
    <thead>
        <tr>        
        <th>Id</th>  
        <th>Fecha</th> 
        <th>Cve</th>                         
        <th>Folio</th>          
        <th>Monto</th>                  
        <th>Recibo</th>
        </tr>
    </thead>
    <tbody>
    @foreach($edoscta as $edocta)
        <tr>
           <td>{!! $edocta->movid !!}</td>            
           <td>{{ \Carbon\Carbon::parse( $edocta->movdate)->format('d/m/Y') }}</td> 
           <td>{!! $edocta->movtocve !!}</td>
           <td>{!! $edocta->movfolio !!}</td>           
           <td>{!! '$ '.number_format($edocta->movtpago, 2, '.', ',') !!}</td>
            <td>              
            <div class='btn-group'>                   
            <a href="{!! route('cpay.receip',[$edocta->chrid,$edocta->movid]) !!}" 
              class='btn btn-default btn-xs'>
              <i class="glyphicon glyphicon-list-alt"></i>
            </a>
            </div>              
            </td> 
        </tr>
    @endforeach
    </tbody>
</table>