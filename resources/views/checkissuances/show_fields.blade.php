
<div>
     {!! Form::label('tit1', 'Datos de impresión de cheque') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">Fecha</div>
<div class="divTableHead">A nombre</div>
<div class="divTableHead">Cant</div>
<div class="divTableHead">Cant.Letra</div>
<div class="divTableHead">Leyenda</div>
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
<div class="divTableCell">{!! $checkissuance->datetext !!}  </div>
<div class="divTableCell">{!! $checkissuance->nom !!}       </div>
<div class="divTableCell">{!! $checkissuance->amount !!}    </div>
<div class="divTableCell">{!! $checkissuance->letamount  !!}</div>
<div class="divTableCell">{!! $checkissuance->leyenda !!}   </div>
</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}





<div>
     {!! Form::label('tit2', 'Datos de Registro') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">Id</div>
<div class="divTableHead">NumCheque</div>
<div class="divTableHead">Mov. Cancelación</div>
<div class="divTableHead">Estatus</div>

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
<div class="divTableCell">{!! $checkissuance->id !!}        </div>
<div class="divTableCell">{!! $checkissuance->numcheck !!}  </div>
<div class="divTableCell">{!! $checkissuance->cancelid !!}  </div>
<div class="divTableCell">{!! $checkissuance->estatus !!}  </div>
</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}


{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">

<div class="divTableHead">Observaciones</div>
<div class="divTableHead">Creado</div>
<div class="divTableHead">Modificado</div>
</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
<div class="divTableRow">
<div class="divTableCell">{!! $checkissuance->observ !!}       </div>
<div class="divTableCell">{!! $checkissuance->creado !!}    </div>
<div class="divTableCell">{!! $checkissuance->mod  !!}</div>
</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}





<div>
     {!! Form::label('tit3', 'Datos Bancarios') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">

<div class="divTableHead">Banco</div>
<div class="divTableHead">Cuenta</div>
<div class="divTableHead">NumCta</div>
<div class="divTableHead">Chequera</div>
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
<div class="divTableCell">{!! $checkissuance->bankname !!}  </div>
<div class="divTableCell">{!! $checkissuance->acconame !!}  </div>
<div class="divTableCell">{!! $checkissuance->account !!}   </div>
<div class="divTableCell">{!! $checkissuance->checkbook !!} </div>
</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}




<div>
     {!! Form::label('tit4', 'Datos de Movimiento de Cargo / Gasto') !!}
</div>

{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">

<div class="divTableHead">Id</div>
<div class="divTableHead">Fecha</div>
<div class="divTableHead">Clave</div>
<div class="divTableHead">Nombre</div>
<div class="divTableHead">Descripción</div>
<div class="divTableHead">Saldo</div>
<div class="divTableHead">Estatus</div>

</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
<div class="divTableRow">
<div class="divTableCell">{!! $charge->chrid !!}   	</div>
<div class="divTableCell">{!! $charge->chrdate  !!} </div>
<div class="divTableCell">{!! $charge->chrcve   !!}	</div>
<div class="divTableCell">{!! $charge->chrname  !!}	</div>
<div class="divTableCell">{!! $charge->cdesc  !!}	</div>
<div class="divTableCell">{!! $charge->chrbalance !!}</div>
<div class="divTableCell">{!! $charge->chrstatus !!}    </div>

</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}


<div>
     {!! Form::label('tit5', 'Datos de Inmueble / Proveedor') !!}
</div>

{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">

<div class="divTableHead">Inmu Cve</div>
<div class="divTableHead">Inmu Nombre </div>
<div class="divTableHead">Prov Cve</div>
<div class="divTableHead">Prov Nombre</div>
<div class="divTableHead">Prov RFC</div>

</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
<div class="divTableRow">
<div class="divTableCell">{!! $charge->unidid !!}    </div>
<div class="divTableCell">{!! $charge->unidname  !!} </div>
<div class="divTableCell">{!! $charge->providnom !!} </div>
<div class="divTableCell">{!! $charge->providrazsoc !!}	</div>
<div class="divTableCell">{!! $charge->providrfc !!}	</div>


</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}

