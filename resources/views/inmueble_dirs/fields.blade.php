<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Location Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location_id', 'Location Id:') !!}
    {!! Form::text('location_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Codpo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codpo_id', 'Codpo Id:') !!}
    {!! Form::text('codpo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Pais Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pais', 'Pais:') !!}
    {!! Form::text('pais', null, ['class' => 'form-control']) !!}
</div>

<!-- Calle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('calle', 'Calle:') !!}
    {!! Form::text('calle', null, ['class' => 'form-control']) !!}
</div>

<!-- Numext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numExt', 'Numext:') !!}
    {!! Form::text('numExt', null, ['class' => 'form-control']) !!}
</div>

<!-- Piso Field -->
<div class="form-group col-sm-6">
    {!! Form::label('piso', 'Piso:') !!}
    {!! Form::text('piso', null, ['class' => 'form-control']) !!}
</div>

<!-- Numint Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numInt', 'Numint:') !!}
    {!! Form::text('numInt', null, ['class' => 'form-control']) !!}
</div>

<!-- Referencia1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('referencia1', 'Referencia1:') !!}
    {!! Form::text('referencia1', null, ['class' => 'form-control']) !!}
</div>

<!-- Referencia2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('referencia2', 'Referencia2:') !!}
    {!! Form::text('referencia2', null, ['class' => 'form-control']) !!}
</div>

<!-- Linkmapa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('linkmapa', 'Linkmapa:') !!}
    {!! Form::text('linkmapa', null, ['class' => 'form-control']) !!}
</div>

<!-- Imagenmapa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('imagenMapa', 'Imagenmapa:') !!}
    {!! Form::text('imagenMapa', null, ['class' => 'form-control']) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inmuebleDirs.index') !!}" class="btn btn-default">Cancel</a>
</div>
