<!-- External_Id Field  -->
<div class="form-group col-sm-4">   
    {!! Form::label('reltipo_id', 'Tipo de Relación:') !!} 
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

<!-- Reltipo Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('reltipo_id', 'Reltipo Id:') !!}
    {!! Form::text('reltipo_id', null, ['class' => 'form-control']) !!}
</div> --}}

 <div class="form-group col-sm-4">
        {!! Form::label('ldoctype_id', 'Tipo de Documento:',['id'=>'ldoctype_id']) !!}
        {!!Form::select('doctype_id',
        ['placeholder'=>'Seleccione Documento'],null,['id'=>'doctype_id',
        'class' => 'form-control','required' => 'required'])!!}
    </div>



<!-- Doctype Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('doctype_id', 'Doctype Id:') !!}
    {!! Form::text('doctype_id', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('persInmuReltipoReqDocs.index') !!}" class="btn btn-default">Cancel</a>
</div>



