
<!-- Reltipo Id Field -->
<div class="form-group col-sm-6">
{!! Form::label('reltipo_id', 'Reltipo Id:') !!} 
  <select name="reltipo_id" id="reltipo_id" class="form-control"  required>
     <option value="">Seleccione Tipo de Relación:</option>
    @if (isset($persInmuReltipoReqDoc)&& !empty($persInmuReltipoReqDoc)) {{-- para Edit --}}

        @foreach($reltypes as $reltype)
            
            <option value="{{$reltype ->id}}"
            {{$persInmuReltipoReqDoc ->tablaexterna_id == $reltype ->id ? 'selected="selected"' : '' }}
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
    {!! Form::date('asignacion', $hoy, ['class' => 'form-control']) !!}
</div>



<!-- Observaciones Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', 'N/A', ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('relinmp.expinmuindex',$propertyid) !!}" class="btn btn-default">Cancel</a>
</div>

<!-- Baja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('baja', 'Baja:',['style'=>'visibility:hidden']) !!}
    {!! Form::date('baja', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('persona_id', $personaid, 
    ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('inmueble_id', $propertyid, 
    ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>
