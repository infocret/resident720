
<div class="form-group col-sm-12">
    <p>Datos del procedimiento: 01 - Seleccione el nombre del "store procedure" en base de datos, 02 - Asigne los parámetros a usar separados por comas, sean numeros o cadenas (NO agregue comillas), la longitud de cadenas debe coincidir con lo declarado en el SP,si no hay parámetros escriba "n/a", 03 - Marque si el procedimiento debe agregarse a la lista de ejecuciones automáticas diarias. </p>
    <p>Recuerde que en la ejecución automática, se ejecutara solo si la fecha de próxima aplicación del contrato de la unidad coincide con la fecha del día actual. </p>
</div>


<!-- Procedimiento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('procedimiento', 'Procedimiento:') !!}
    <select name="procedimiento" id="procedimiento" class="form-control"  required>
    <option value="">Seleccione Procedimiento</option>
    @if (isset($procedmovto)&& !empty($procedmovto)) {{-- para Edit --}}

        @foreach($procedims as $sp)
            
            <option value="{{$sp->nom}}"
            {{$procedmovto->procedimiento == $sp->nom ? 'selected="selected"' : '' }}
            >{{ $sp->spnom }}
            </option>            

        @endforeach

    @else                                   {{-- para Create --}}

        @foreach($procedims as $sp)            
            <option value="{{$sp->nom}}">{{$sp->spnom }}
            </option>            
        @endforeach

    @endif
    </select> 

</div>

<!-- Parametros Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parametros', 'Parametros(param1,Param2..) sin comillas:') !!}
    @if (isset($procedmovto)&& !empty($procedmovto))        {{-- para Edit --}}
    {!! Form::text('parametros', $procedmovto->parametros, 
    ['class' => 'form-control','maxlength'=>'150']) !!}
    @else                                                   {{-- para Create --}}
    {!! Form::text('parametros', 'n/a', 
    ['class' => 'form-control','maxlength'=>'150']) !!}
    @endif
</div>

<!-- Execauto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('execauto', 'Execauto:') !!}
    @if (isset($procedmovto)&& !empty($procedmovto))        {{-- para Edit --}}
    {{ Form::checkbox('execauto', '1', $procedmovto->execauto) }}
    @else                                                   {{-- para Create --}}
     {{ Form::checkbox('execauto', '1', null) }}
    @endif                                                
</div>


<div class="form-group col-sm-12">
    <p>Datos del Movimiento: 01 - Seleccione el condominio, 02 - Seleccione el concepto/servicio, 03 - Seleccione el movimiento. </p>
</div>


<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">       
    {!! Form::label('inmueble_id', 'Condominio:') !!}
     {{-- {!! Form::text('inmueble_id', null, ['class' => 'form-control']) !!} --}}
   <select name="inmueble_id" id="inmueble_id" class="form-control"  required>
     <option value="">Seleccione Condominio</option>
    @if (isset($procedmovto)&& !empty($procedmovto)) {{-- para Edit --}}

        @foreach($condoms as $condom)
            
            <option value="{{$condom->id}}"
            {{$procedmovto->inmueble_id == $condom->id ? 'selected="selected"' : '' }}
            >{{ $condom->ident.'-'.$condom->nombre }}
            </option>            

        @endforeach

    @else                                   {{-- para Create --}}

        @foreach($condoms as $condom)            
            <option value="{{$condom->id}}">{{ $condom->ident.'-'.$condom->nombre }}
            </option>            
        @endforeach

    @endif
    </select> 
</div>

<!-- Conceptservice Id Field -->
<div class="form-group col-sm-6">       
   {!! Form::label('lconceptservice_id', 'Concepto/Servicio:',['id'=>'lconceptservice_id']) !!}

   <select name="conceptservice_id" id="conceptservice_id" class="form-control"  required>
     <option value="">Seleccione Concepto/Servicio</option>
    @if (isset($procedmovto)&& !empty($procedmovto)) {{-- para Edit --}}

        @foreach($concepts as $concept)
            
            <option value="{{$concept->id}}"
            {{$procedmovto->id == $concept->id ? 'selected="selected"' : '' }}
            >{{ $concept->cve.'-'.$concept->name }}
            </option>            

        @endforeach

    @else                                   {{-- para Create --}}

        @foreach($concepts as $concept)            
            <option value="{{$concept->id}}">{{ $concept->cve.'-'.$concept->name }}
            </option>            
        @endforeach

    @endif
    </select> 
</div>



<!-- Catmovto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lcatmovto_id', 'Movimiento:',['id'=>'lcatmovto_id']) !!}
    {{-- {!! Form::text('catmovto_id', null, ['class' => 'form-control']) !!} --}}
    <select name="catmovto_id" id="catmovto_id" class="form-control"  required>
    <option value="">Seleccione Movimiento</option>
    @if (isset($procedmovto)&& !empty($procedmovto)) {{-- para Edit --}}

        @foreach($movtos as $movto)
            
            <option value="{{$movto->id}}"
            {{$procedmovto->catmovto_id == $movto->id ? 'selected="selected"' : '' }}
            >{{ $movto->movtocve."-".$movto->movtodesc."|".$movto->fechaaplica }}
            </option>            

        @endforeach

    @else                                   {{-- para Create --}}

        {{--  @foreach($movtos as $movto)           
            <option value="{{$movto->id}}">
                {{ $movto->movtocve."-".$movto->movtodesc."|".$movto->fechaaplica }}
            </option>            
        @endforeach --}}

    @endif
    </select>   
</div>

<div class="form-group col-sm-12">
    <p>Recuerde que los movimientos presentados son los que están registrados en el contrato de cada unidad del condominio seleccionado.</p>
</div>

<!-- Concept Cve Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lconcept_cve', 'Concept Cve:') !!}
    {!! Form::text('concept_cve', null, 
    ['class' => 'form-control','id'=>'concept_cve','readonly'=>'readonly']) !!}
</div>

<!-- Movto Cve Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lmovto_cve', 'Movto Cve:') !!}
    {!! Form::text('movto_cve', null, 
    ['class' => 'form-control','id'=>'movto_cve','readonly'=>'readonly']) !!}
</div>


<div class="form-group col-sm-12">
    <p>Datos del Registro: 01 -Especifique un nombre, 02 - Escriba una descripción, 03 - Si es necesario agregue alguna observación o escriba "n/a". </p>
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','maxlength'=>'35']) !!}
</div>

<!-- Desc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('desc', 'Desc:') !!}
    {!! Form::text('desc', null, ['class' => 'form-control','maxlength'=>'150']) !!}
</div>

<!-- Observ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observ', 'Observ:') !!}
    {!! Form::text('observ', null, ['class' => 'form-control','maxlength'=>'150']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('procedmovtos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
