
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre de Area:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Planta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('planta', 'Planta:') !!}
    {!! Form::text('planta', null, ['class' => 'form-control']) !!}
</div>

<!-- Filename Field -->
<div class="form-group col-sm-6">
    {!! Form::label('filename', 'Filename:') !!}
    {!! Form::text('filename', null, ['class' => 'form-control']) !!}
</div>

<!-- Filepath Field -->
<div class="form-group col-sm-6">
    {!! Form::label('filepath', 'Ruta de Archivo de imagen:') !!}
    {!! Form::text('filepath', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('condomareas.index',$inmuid) !!}" class="btn btn-default">Cancelar</a>
</div>


<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    {!! Form::text('inmueble_id', $inmuid, ['class' => 'form-control',]) !!}
</div>
