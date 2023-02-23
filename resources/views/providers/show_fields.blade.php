
<div>
     {!! Form::label('tit1', 'Datos de Proveedor') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">id</div>
<div class="divTableHead">Nomc.orto</div>
<div class="divTableHead">Razon Social</div>
<div class="divTableHead">RFC</div>

</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
<div class="divTableRow">
<div class="divTableCell">{!! $providers->id !!}  </div>
<div class="divTableCell">{!! $providers->nomcorto !!}    </div>
<div class="divTableCell">{!! $providers->razonsocial  !!}</div>
<div class="divTableCell">{!! $providers->rfcmoral !!}   </div>
</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}




<div>
	@if($providers->tipo == 'SE') 
	{!! Form::label('tit2', 'Ofrece Servicios para estas Categorias') !!}  @endif
	@if($providers->tipo == 'VP') 
	{!! Form::label('tit2', 'Ofrece Venta de Productos para estas Categorias') !!}  @endif	
	@if($providers->tipo == 'SV')
	{!! Form::label('tit2', 'Ofrece Servicios y Venta de Productos para estas Categorias') !!} 
	@endif	      
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">Ofrece</div>
<div class="divTableHead">Categoria</div>
</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
 @foreach($categorias as $categoria)
<div class="divTableRow">
<div class="divTableCell">{!! $categoria->ofrece !!}  </div>
<div class="divTableCell">{!! $categoria->categoria !!}       </div>
</div> {{-- row --}}
 @endforeach
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}


<div>
     {!! Form::label('tit2', 'Cuenta Bancaria') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">Banco</div>
<div class="divTableHead">CtaNom</div>
<div class="divTableHead">CLABE</div>
<div class="divTableHead">CtaNum</div>

</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
 @foreach($accounts as $account)
<div class="divTableRow">              
<div class="divTableCell">{!! $account->bankname !!}     </div>
<div class="divTableCell">{!! $account->accountname !!}   </div>
<div class="divTableCell">{!! $account->clabe !!}  </div>
<div class="divTableCell">{!! $account->account !!}  </div>
</div> {{-- row --}}
 @endforeach
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}



<div>
     {!! Form::label('tit3', 'Persona de contacto') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">Exped</div>
<div class="divTableHead">Id</div>
<div class="divTableHead">Nombre</div>
<div class="divTableHead">Apellido Pterno</div>
<div class="divTableHead">Apellido Materno</div>

</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
<div class="divTableRow">
<div class="divTableCell">
	 <a href="{!! route('personaexp.index', [$persona->id]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-folder-open"></i>
                </a>
</div>                
<div class="divTableCell">{!! $persona->id !!}     </div>
<div class="divTableCell">{!! $persona->name !!}   </div>
<div class="divTableCell">{!! $persona->appat !!}  </div>
<div class="divTableCell">{!! $persona->apmat !!}  </div>
</div> {{-- row --}}
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}



<div>
     {!! Form::label('tit4', 'Medios de Contacto') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">Img</div>
<div class="divTableHead">Nombre</div>
<div class="divTableHead">Descripción</div>
<div class="divTableHead">Dato</div>
<div class="divTableHead">Observaciones</div>

</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
 @foreach($medioPersonas as $medio)
<div class="divTableRow">
<div class="divTableCell">
	<i class="{!!$medio->imgfilename !!}" style="color:grey"></i>   </div>
<div class="divTableCell">{!! $medio->nombre !!}  </div>
<div class="divTableCell">{!! $medio->descripcion !!} </div>
<div class="divTableCell">{!! $medio->dato !!} </div>
<div class="divTableCell">{!! $medio->observaciones !!} </div>
</div> {{-- row --}}
 @endforeach
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}



<div>
     {!! Form::label('tit5', 'Ubicaciones') !!}
</div>
{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">Link Mapa</div>
<div class="divTableHead">Tipo</div>
<div class="divTableHead">Dirección</div>
{{-- <div class="divTableHead">Img Mapa</div> --}}

</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">
 @foreach($personaDirs as $direccion)
<div class="divTableRow">
<div class="divTableCell">
 @if (is_null($direccion->linkmapa) || $direccion->linkmapa == "N/A" 
 || $direccion->linkmapa == "n/a")
    <a href="{!! env('Gmaps_Search2').$direccion->dir !!}" 
    	class='btn btn-default btn-xs' target="_blank">
        <i class="glyphicon fa fa-map" style="color:green"></i>
    </a> 
@else
    <a href="{!! $direccion->linkmapa !!}" class='btn btn-default btn-xs' target="_blank">
        <i class="glyphicon fa fa-map" style="color:green"></i>
    </a>  
@endif
</div>	
<div class="divTableCell">{!! $direccion->nombre !!}    </div>
<div class="divTableCell">{!! $direccion->dir !!}  		</div>
{{-- <div class="divTableCell">{!! $direccion->imagenMapa !!} </div> --}}
</div> {{-- row --}}
 @endforeach
</div> {{-- body --}}

<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
</div>{{-- row --}}
</div>{{-- foot --}}

</div> {{-- table --}}