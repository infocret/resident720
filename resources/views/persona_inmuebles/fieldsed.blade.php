
<!-- Reltipo Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('reltipo_id', 'Reltipo Id:') !!}
    {!! Form::text('reltipo_id', null, ['class' => 'form-control']) !!}
</div> --}}
<!-- Reltipo Id Field -->
<div class="form-group col-sm-6">
{!! Form::label('reltipo_id', 'Reltipo Id:') !!} 
  <select name="reltipo_id" id="reltipo_id" class="form-control"  required>
     <option value="">Seleccione Tipo de Relación:</option>
    @if (isset($personaInmueble)&& !empty($personaInmueble)) {{-- para Edit --}}

        @foreach($reltypes as $reltype)
            
            <option value="{{$reltype ->id}}"
            {{ $personaInmueble->reltipo_id == $reltype->id ? 'selected="selected"' : '' }}
            >{{ $reltype ->nombre }}
            </option>            

        @endforeach

    @else                                            {{-- para Create --}}

        @foreach($reltypes as $reltype)            
            <option value="{{$reltype ->id}}">{{ $reltype ->nombre }}</option>            
        @endforeach

    @endif
    </select>
    {{-- {{Form::select('tablaexterna _id',$reltypes),['class' => 'form-control']}} --}}
 </div>

<!-- Asignacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('asignacion', 'Asignacion:') !!}
    {!! Form::date('asignacion', $personaInmueble->asignacion, ['class' => 'form-control']) !!}
</div>

<!-- Baja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('baja', 'Baja:') !!}
    {!! Form::date('baja', $personaInmueble->baja, ['class' => 'form-control']) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('relperinmu.expindex',$personaInmueble->persona_id) !!}" class="btn btn-default">Cancelar</a>
</div>

<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('persona_id', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>
