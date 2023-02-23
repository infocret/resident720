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
      <th>
          Condominio
      </th>            
      <th>
          Concepto / Servicio
      </th> 
      <th>
          Fecha Aplicación
      </th>                  
  </tr>
  </thead>      
  <tbody>
  <tr>
    <td>
      {{ $charge->unidcve.' - '.$charge->uniddesc }}
    </td>
    <td> 
      {{ $charge->chrcve.' - '.$charge->chrname }}    
    </td>
    <td>
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
            <th colspan="3">
                Pago - EdoCta
            </th>        
        </tr>
        </thead>

        <tbody>
        <tr>    
           <td>
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
                  <a href="{!! route('checkissuances.emit',[$charge->chrid]) !!}" 
                  class='btn btn-default btn-xs'>
                  <i class="glyphicon glyphicon-edit "></i>
                  </a>
                @else
                  <a href="" class='btn btn-default btn-xs' disabled="true" >
                  <i class="glyphicon glyphicon-thumbs-up " disabled="true"></i>
                  </a>
                @endif                 
                  <a href="{!! route('egresos.indexd', [$charge->chrid]) !!}" 
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
           <td>{!! $cargo->movfolio !!}</td>
           <td>{!! $cargo->movcve !!}</td>
           <td>{!! $cargo->movdesc !!}</td>           
           <td>{!! '$ '.number_format($cargo->movbalance, 2, '.', ',') !!}</td>        
           <td>              
            <div class='btn-group'>                   
            <a href="" class='btn btn-default btn-xs'disabled="true">
              <i class="glyphicon glyphicon-ban-circle" disabled="true" ></i>
            </a>
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
           <td>{!! $pago->movfolio !!}</td>
           <td>{!! $pago->movcve !!}</td>           
           <td>{!! $pago->movdesc !!}</td>                    
           <td>{!! '$ '.number_format($pago->movbalance, 2, '.', ',') !!}</td>
            <td>              
            <div class='btn-group'> 
            {{-- Llama a ver el recibo pero todavia no esta echo --}}                  
            {{-- <a href="{!! route('cpay.receip',[$charge->chrid,$pago->movid]) !!}" 
              class='btn btn-default btn-xs'>
              <i class="glyphicon glyphicon-list-alt"></i>
            </a> --}}
            </div>              
            </td> 
        </tr>
    @endforeach
    </tbody>
</table>


{{-- ******************************* Cargos ************************************** --}}
    <div align="center" style="background: #eeeeee"> 
      Cheques Registrados
    </div>
 {{-- "egreso_id" => 943
        "bankname" => "SANTANDER"
        "acconame" => "Santander 210 Puerta Rio"
        "account" => "65506816316"
        "checkbook" => "Pago a Proveedores"
        "nom" => "Human Devolpment Services Arguello S. A. DE C. V."
        "amount" => "19140.04"
        "numcheck" => "0"
        "estatus" => "Registrado" --}}
<table class="table table-responsive" id="checkissuances-table">
    <thead>
        <tr>
        <th>Mov</th>
        <th>Banco</th>
        <th>NomCta</th>
        <th>Cuenta</th>
        <th>Chequera</th>        
        <th>A nombre de</th>
        <th>Cantidad</th>
        <th>No.Cheque</th>
        <th>Estatus</th>
        
        
            <th colspan="2">Acción</th>
        </tr>
    </thead>
    <tbody>
    @foreach($checkissuances as $checkissuance)
        <tr>
            <td>{!! $checkissuance->egreso_id !!}</td>
            <td>{!! $checkissuance->bankname !!}</td>
            <td>{!! $checkissuance->acconame !!}</td>
            <td>{!! $checkissuance->account !!}</td>
            <td>{!! $checkissuance->checkbook !!}</td>
            <td>{!! $checkissuance->nom !!}</td>
            <td>{!! '$ '.round($checkissuance->amount,2) !!}</td>
            <td>{!! $checkissuance->numcheck !!}</td>
            <td>{!! $checkissuance->estatus !!}</td>
            <td>
                {{-- {!! Form::open(['route' => ['checkissuances.destroy', $checkissuance->id], 'method' => 'delete']) !!}
                 --}}
                <div class='btn-group'>
                   
                    <a href="{!! route('checkissuances.show', [$checkissuance->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                   
                    <a href="{!! route('checkissuances.edit', [$checkissuance->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>

                    <a href="{!! route('checkissuances.chprint', [$checkissuance->id]) !!}" 
                        class='btn btn-default btn-xs' target="_blank"><i class="glyphicon glyphicon-print"></i></a>
                
                {{-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                </div>                
                {{--    {!! Form::close() !!} --}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>