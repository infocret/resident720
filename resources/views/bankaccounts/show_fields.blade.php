
{{-- 
    "id" => 1
    "shortname" => "BANAMEX"
    "square" => "Nuevo Vallarta"
    "ident" => "138001"
    "name" => "Banamex 5024"
    "account" => "1409615024"
    "clabe" => "012180014096150240"
    "description" => "Cta de recepción de pagos"
    "account_type" => "ING"
    "accounting" => "CtaContable"
    "allow_overdrafts" => 1 
    --}}
  
<div>
     {!! Form::label('tit1', 'Cuenta') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">id</div>
<div class="divTableHead">Banco</div>
<div class="divTableHead">CVE</div>
<div class="divTableHead">Nombre</div>
<div class="divTableHead">CLABE</div>
<div class="divTableHead">Cuenta</div>
<div class="divTableHead">Descripción</div>
<div class="divTableHead">Tipo</div>
<div class="divTableHead">CtaContable</div>
<div class="divTableHead">Sobregiro</div>



</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
<div class="divTableRow">
<div class="divTableCell">{!! $bankaccount->id !!}  </div>
<div class="divTableCell">{!! $bankaccount->shortname !!}    </div>
<div class="divTableCell">{!! $bankaccount->ident  !!}</div>
<div class="divTableCell">{!! $bankaccount->name !!}   </div>
<div class="divTableCell">{!! $bankaccount->clabe !!}   </div>
<div class="divTableCell">{!! $bankaccount->account !!}   </div>
<div class="divTableCell">{!! $bankaccount->description !!}   </div>
<div class="divTableCell">
    @if($bankaccount->account_type == 'ING') 
    {!! 'Ingresos' !!}   
    @endif
    @if($bankaccount->account_type == 'EGR') 
    {!! 'Egresos' !!}   
    @endif
    @if($bankaccount->account_type == 'IYE') 
    {!! 'Ingresos y Egresos' !!}   
    @endif
</div>
<div class="divTableCell">{!! $bankaccount->accounting !!}   </div>
<div class="divTableCell">{!! $bankaccount->allow_overdrafts !!}   </div>
</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}

{{--         
        "shortname" => "Proveed"
        "fullname" => "Pago a Proveedores"
        "description" => "Chequera para pago deproveedores"
        "start" => "1"
        "end" => "100" 
--}}

<div>
     {!! Form::label('tit2', 'Chequeras de la cuenta') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">id</div>
<div class="divTableHead">Nom / Cve</div>
<div class="divTableHead">Nombre</div>
<div class="divTableHead">Descripción</div>
<div class="divTableHead">Cheque inicial</div>
<div class="divTableHead">Cheque Final</div>
<div class="divTableHead">Acción</div>

</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
@foreach($checkbooks as $checkbook)
<div class="divTableRow">
<div class="divTableCell">{!! $checkbook->id !!}  </div>
<div class="divTableCell">{!! $checkbook->shortname !!}    </div>
<div class="divTableCell">{!! $checkbook->fullname  !!}</div>
<div class="divTableCell">{!! $checkbook->description !!}   </div>
<div class="divTableCell">{!! $checkbook->start !!}   </div>
<div class="divTableCell">{!! $checkbook->end !!}   </div>
<div class="divTableCell">

{!! Form::open(['route' => ['checkbooks.destroyb',  $checkbook->id], 'method' => 'delete']) !!}
<div class='btn-group'>
<a href="{!! route('checkbooks.editb', $checkbook->id) !!}" class='btn btn-default btn-xs'>
<i class="glyphicon glyphicon-edit"></i></a>
{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', 
['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 
'onclick' => "return confirm('Seguro desea desactivar chequera?')"]) !!}
 </div>
{!! Form::close() !!}

</div>

</div> {{-- row --}}
@endforeach
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}

