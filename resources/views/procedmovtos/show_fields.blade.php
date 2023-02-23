
<div>
     {!! Form::label('tit1', 'Datos del registro') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">Id</div>
<div class="divTableHead">Nombre</div>
<div class="divTableHead">Descripción</div>
<div class="divTableHead">Observaciones</div>
<div class="divTableHead">Creado</div>
<div class="divTableHead">Modificado</div>

{{-- <div class="divTableHead">
<button type="button" class="btn btn-info btn-xs" onclick="AddItem();">
<span title="Agregar detalle" class="glyphicon glyphicon-plus"></span>
</button>
</div>
 --}}
</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
<div class="divTableRow">
<div class="divTableCell">{!! $procedmovto->id !!}  </div>
<div class="divTableCell">{!! $procedmovto->nombre !!}       </div>
<div class="divTableCell">{!! $procedmovto->desc  !!}</div>
<div class="divTableCell">{!! $procedmovto->observ !!}   </div>
<div class="divTableCell">{!! $procedmovto->created_at !!}   </div>
<div class="divTableCell">{!! $procedmovto->updated_at !!}   </div>

</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}




<div>
     {!! Form::label('tit2', 'Datos del Procedimiento') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">Procedimiento</div>
<div class="divTableHead">Parametros</div>
<div class="divTableHead">ExecAuto</div>

{{-- <div class="divTableHead">
<button type="button" class="btn btn-info btn-xs" onclick="AddItem();">
<span title="Agregar detalle" class="glyphicon glyphicon-plus"></span>
</button>
</div>
 --}}
</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
<div class="divTableRow">
<div class="divTableCell">{!! $procedmovto->procedimiento !!}  </div>
<div class="divTableCell">{!! $procedmovto->parametros !!}       </div>
<div class="divTableCell">
	@if ($procedmovto->execauto == '1')	SI	@else	NO	@endif
</div>
</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}



<div>
     {!! Form::label('tit3', 'Datos del Movimiento') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">

<div class="divTableHead">Condominio</div>
<div class="divTableHead">Concepto/Serv</div>
<div class="divTableHead">Movimiento</div>


{{-- <div class="divTableHead">
<button type="button" class="btn btn-info btn-xs" onclick="AddItem();">
<span title="Agregar detalle" class="glyphicon glyphicon-plus"></span>
</button>
</div>
 --}}
</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
<div class="divTableRow">
<div class="divTableCell">{!! $condominio !!} </div>
<div class="divTableCell">{!! $servicio !!} </div>
<div class="divTableCell">{!! $movimiento !!} </div>

</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}



<div>
     {!! Form::label('tit4', 
     $ncont.' Unidades a quienes se aplicara el Movimiento '.$movimiento) !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">

<div class="divTableHead">Id</div>
<div class="divTableHead">Tipo</div>
<div class="divTableHead">Cve</div>
<div class="divTableHead">Nombre</div>
<div class="divTableHead">FechaAplica</div>
<div class="divTableHead">Monto</div>

{{-- <div class="divTableHead">
<button type="button" class="btn btn-info btn-xs" onclick="AddItem();">
<span title="Agregar detalle" class="glyphicon glyphicon-plus"></span>
</button>
</div>
 --}}
</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">

@foreach($contratos as $contrato)
<div class="divTableRow">

<div class="divTableCell">{!! $contrato->unid_id !!} </div>
<div class="divTableCell">{!! $contrato->unid_tipo !!} </div>
<div class="divTableCell">{!! $contrato->unid_cve !!} </div>
<div class="divTableCell">{!! $contrato->unid_nom !!} </div>
<div class="divTableCell">{!! $contrato->fech_aplica !!} </div>
<div class="divTableCell">{!! '$ '.number_format($contrato->amount, 2, '.', ',') !!} </div>

</div> {{-- row --}}
@endforeach

</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}
