
   <!-- Medio Id Field -->   
    <div class="form-group col-sm-4">   
    {!! Form::label('medio_id', 'Tipo de Medio:') !!} 
     <select name="medio_id" id="medio_id" class="form-control"  required>
     <option value="">Seleccione Tipo de medio</option>
    @if (isset($inmuebleMedio)&& !empty($inmuebleMedio)) {{-- para Edit --}}

        @foreach($mediosList as $medio)
            
            <option value="{{$medio->id}}"
            {{$inmuebleMedio->medio_id == $medio->id ? 'selected="selected"' : '' }}
            >{{ $medio->nombre }}
            </option>            

        @endforeach

    @else                                            {{-- para Create --}}

        @foreach($mediosList as $medio)            
            <option value="{{$medio->id}}">{{ $medio->nombre }}</option>            
        @endforeach

    @endif
    </select> 
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
    <a href="{!! route('inmumediosexp.index', $inmuid) !!}" class="btn btn-default">Cancel</a>
</div>


<!-- inmueble Id Field -->
<div class="form-group col-sm-6">
 {!! Form::text('inmueble_id', $inmuid, 
 ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>
