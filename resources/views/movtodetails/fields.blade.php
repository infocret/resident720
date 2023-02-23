<!-- Movtohead Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('movtohead_id', 'Movtohead Id:') !!}
    {!! Form::text('movtohead_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Movimientotipo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('movimientotipo_id', 'Movimientotipo Id:') !!}
    {!! Form::text('movimientotipo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Unidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unidad', 'Unidad:') !!}
    {!! Form::text('unidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Preciounit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('preciounit', 'Preciounit:') !!}
    {!! Form::number('preciounit', null, ['class' => 'form-control']) !!}
</div>

<!-- Subtot Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subtot', 'Subtot:') !!}
    {!! Form::number('subtot', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('movtodetails.index') !!}" class="btn btn-default">Cancel</a>
</div>
