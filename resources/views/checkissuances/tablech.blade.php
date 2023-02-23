{{-- 
"unidid" => 68
"providnom" => "11386"
"providrazsoc" => "Human Devolpment Services Arguello S. A. DE C. V."
"providrfc" => "N/A"
"unidcve" => "210"
"unidname" => "COND. PUERTA DEL RIO A.C."
"uniddesc" => "COND. PUERTA DEL RIO A.C."
"chrid" => 943
"area" => "Administrador de condominio"
"chrdate" => "2019-04-15"
"chrfolio" => "0"
"chrcve" => 1000
"cdesc" => "Gastos del condominio"
"chrname" => "Vigilancia 1ra Quincena Abril 2019"
"chrtotal" => "19140.0400"
"chriva" => "0.0000"
"chrbalance" => "19140.0400"
"chrstatus" => "Generado"
"chrflink" => "N/A"

"id" => 1
"egreso_id" => 943
"bankname" => "SANTANDER"
"acconame" => "Santander 210 Puerta Rio"
"account" => "65506816316"
"checkbook_id" => 4
"checkbook" => "Pago a Proveedores"
"datetext" => "2020-06-08"
"nom" => "Human Devolpment Services Arguello S. A. DE C. V."
"amount" => "19140.04"
"letamount" => "DIECINUEVE MIL CIENTO CUARENTA PESOS CON CUATRO CENTAVOS"
"incluir" => 1
"leyenda" => "Para abono en cuenta del beneficiario"
"cancelid" => "0"
"numcheck" => "0"
"estatus" => "Registrado"
"observ" => "Ninguna"
"creado" => "2020-06-09 03:14:07"
"mod" => "2020-06-09 03:14:07"

--}}
<table class="table table-responsive">
  <thead>
  <tr>
      <th>
          Unidad
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
                {{ '$ '.number_format($chtot, 2, '.', ',') }}
            </td>                 
            <td style="font-weight: bold;">
                {{ '$ '.number_format($charge->chrbalance, 2, '.', ',') }}
            </td> 
            <td>              
                <div class='btn-group'>
                @if ($charge->chrbalance > 0)
                  <a href="{!! route('checkissuances.emit', [$charge->chrid]) !!}" 
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
 