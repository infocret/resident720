<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $docType->id !!}</p>
</div>

<!-- Filetype Id Field -->
{{-- <div class="form-group">
    {!! Form::label('filetype_id', 'Filetype Id:') !!}
    <p>{!! $docType->filetype_id !!}</p>
</div> --}}

<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{!! $docType->nombre !!}</p>
</div>

<!-- Sizemin Field -->
<div class="form-group">
    {!! Form::label('sizemin', 'Sizemin:') !!}
    <p>{!! $docType->sizemin !!}</p>
</div>

<!-- Sizemax Field -->
<div class="form-group">
    {!! Form::label('sizemax', 'Sizemax:') !!}
    <p>{!! $docType->sizemax !!}</p>
</div>

<!-- Filetype Descripción Field -->
<div class="form-group">
    {!! Form::label('filetype', 'Tipo de Archivo:') !!}
    <p>{!! $filetype !!}</p>
</div> 

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $docType->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $docType->updated_at !!}</p>
</div>

