
<!-- Medio Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('medio_id', 'Medio Id:') !!}
    {!! Form::text('medio_id', null, ['class' => 'form-control']) !!}
</div> --}}

{{--   Para probar que trae la variable --}}
{{--    {!! dd($mediosList) !!}  --}}
{{-- {{ dd($medioPersona->medio_id) }} --}}

   <!-- Medio Id Field -->   
    <div class="form-group col-sm-4">   
    {!! Form::label('medio_id', 'Tipo de Medio:') !!} 
     <select name="medio_id" id="medio_id" class="form-control"  required>
     <option value="">Seleccione Tipo de medio</option>
    @if (isset($medioPersona)&& !empty($medioPersona)) {{-- para Edit --}}

        @foreach($mediosList as $medio)
            
            <option value="{{$medio->id}}"
            {{$medioPersona->medio_id == $medio->id ? 'selected="selected"' : '' }}
            >{{ $medio->nombre }}
            </option>            

        @endforeach

    @else                                            {{-- para Create --}}

        @foreach($mediosList as $medio)            
            <option value="{{$medio->id}}">{{ $medio->nombre }}</option>            
        @endforeach

    @endif
    </select>
    {{-- {{Form::select('medio_id',$mediosList),['class' => 'form-control']}} --}}
    </div>


<!-- Dato Field -->
<div class="form-group col-sm-4">
    {!! Form::label('dato', 'Dato:') !!}
    {!! Form::text('dato', null, [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'50',
        'required' => 'required'
        ]) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-8">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', null, [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'100',
        'required' => 'required'
        ]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('personamedios.index') !!}" class="btn btn-default">Cancel</a>
</div>


<!-- Persona Id Field -->
<div class="form-group col-sm-6">
  {{--   {!! Form::label('persona_id', 'Persona Id:',['style'=>'visibility:hidden']) !!} 
  ,'placeholder'=>'1' --}}
 {!! Form::text('persona_id', Session::get('personaexpid'), 
 ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>
