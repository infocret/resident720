<!-- Tipo Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tipo', 'Tipo:') !!}
    <label class="radio-inline">
        {!! Form::radio('tipo', "I", null) !!} Ingreso
    </label>

    <label class="radio-inline">
        {!! Form::radio('tipo', "E", null) !!} Egreso
    </label>

</div>

<!-- Cve Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cve', 'Cve:') !!}
    {!! Form::number('cve', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('movimientoTipos.index') !!}" class="btn btn-default">Cancel</a>
</div>
