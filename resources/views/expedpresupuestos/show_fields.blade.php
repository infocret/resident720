<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $presupuesto->id !!}</p>
</div>

<!-- Inmueble Id Field -->
<div class="form-group">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    <p>{!! $presupuesto->inmueble_id !!}</p>
</div>

<!-- Movtipo Id Field -->
<div class="form-group">
    {!! Form::label('movtipo_id', 'Movtipo Id:') !!}
    <p>{!! $presupuesto->movtipo_id !!}</p>
</div>

<!-- Monto Field -->
<div class="form-group">
    {!! Form::label('monto', 'Monto:') !!}
    <p>{!! $presupuesto->monto !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $presupuesto->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $presupuesto->updated_at !!}</p>
</div>

