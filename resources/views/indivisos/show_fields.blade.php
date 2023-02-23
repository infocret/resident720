<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $propertyparameter->id !!}</p>
</div>

<!-- Inmueble Id Field -->
<div class="form-group">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    <p>{!! $propertyparameter->inmueble_id !!}</p>
</div>

<!-- Parametro Field -->
<div class="form-group">
    {!! Form::label('parametro', 'Parametro:') !!}
    <p>{!! $propertyparameter->parametro !!}</p>
</div>

<!-- Valor Field -->
<div class="form-group">
    {!! Form::label('valor', 'Valor:') !!}
    <p>{!! $propertyparameter->valor !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $propertyparameter->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $propertyparameter->updated_at !!}</p>
</div>

