
<!-- Filetype Id Field -->   
<div class="form-group col-sm-4">   
    {!! Form::label('filetype_id', 'Tipo de Archivo:') !!} 
     <select name="filetype_id" id="filetype_id" class="form-control"  required>
     <option value="">Seleccione Tipo de Archivo</option>
    @if (isset($docType)&& !empty($docType)) {{-- para Edit --}}

        @foreach($filetypeList as $filetype)
            
            <option value="{{$filetype->id}}"
            {{$docType->filetype_id == $filetype->id ? 'selected="selected"' : '' }}
            >{{ $filetype->nombre }}
            </option>            

        @endforeach

    @else                                            {{-- para Create --}}

        @foreach($filetypeList as $filetype)            
            <option value="{{$filetype->id}}">{{ $filetype->nombre }}</option>            
        @endforeach

    @endif
    </select>
    {{-- {{Form::select('filetype_id',$filetypeList),['class' => 'form-control']}} --}}
 </div>


<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'100',
        'required' => 'required'
        ]) !!}
</div>

<!-- Sizemin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sizemin', 'Sizemin:') !!}
    {!! Form::number('sizemin', null, [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'2000',
        'required' => 'required'
        ]) !!}
</div>

<!-- Sizemax Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sizemax', 'Sizemax:') !!}
    {!! Form::number('sizemax', null, [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'2000',
        'required' => 'required'
        ]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('docTypes.index') !!}" class="btn btn-default">Cancelar</a>
</div>

<!-- Filetype Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('filetype_id', 'Filetype Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('filetype_id', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div> --}}