<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Parametro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parametro', 'Parametro:') !!}
    {!! Form::text('parametro', null, ['class' => 'form-control']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::text('valor', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('propertyparameters.index') !!}" class="btn btn-default">Cancel</a>
</div>
