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

<!-- External_Id Field -->   
<div class="form-group col-sm-4">   
    {!! Form::label('doctype_id', 'Tipo de Documento:') !!} 
     <select name="doctype_id" id="doctype_id" class="form-control"  required>
     <option value="">Seleccione Tipo de Documento:</option>
    @if (isset($persInmuReltipoReqDoc)&& !empty($persInmuReltipoReqDoc)) {{-- para Edit --}}

        @foreach($doctypes as $doctype)
            
            <option value="{{$doctype ->id}}"
            {{$persInmuReltipoReqDoc ->doctype_id == $doctype ->id ? 'selected="selected"' : '' }}
            >{{ $doctype ->nombre }}
            </option>            

        @endforeach

    @else                                            {{-- para Create --}}

        @foreach($doctypes as $doctype)           
            <option value="{{$doctype ->id}}">{{ $doctype ->nombre }}</option>           
        @endforeach

    @endif
    </select>
    {{-- {{Form::select('tablaexterna _id',$doctypes),['class' => 'form-control']}} --}}
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




====================

<!-- Reltipo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reltipo_id', 'Reltipo Id:') !!}
    {!! Form::text('reltipo_id', null, ['class' => 'form-control']) !!}
</div> 

<!-- Doctype Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('doctype_id', 'Doctype Id:') !!}
    {!! Form::text('doctype_id', null, ['class' => 'form-control']) !!}
</div> 

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('persInmuReltipoReqDocs.index') !!}" class="btn btn-default">Cancel</a>
</div>
