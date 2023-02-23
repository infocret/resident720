<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Propertyarea Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('propertyarea_id', 'Propertyarea Id:') !!}
    {!! Form::text('propertyarea_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Provider Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('provider_id', 'Provider Id:') !!}
    {!! Form::text('provider_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecharegistro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecharegistro', 'Fecharegistro:') !!}
    {!! Form::date('fecharegistro', null, ['class' => 'form-control']) !!}
</div>

<!-- Fechafactura Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fechafactura', 'Fechafactura:') !!}
    {!! Form::date('fechafactura', null, ['class' => 'form-control']) !!}
</div>

<!-- Folio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('folio', 'Folio:') !!}
    {!! Form::text('folio', null, ['class' => 'form-control']) !!}
</div>

<!-- Doc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('doc', 'Doc:') !!}
    {!! Form::text('doc', null, ['class' => 'form-control']) !!}
</div>

<!-- Stotal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stotal', 'Stotal:') !!}
    {!! Form::number('stotal', null, ['class' => 'form-control']) !!}
</div>

<!-- Iva Field -->
<div class="form-group col-sm-6">
    {!! Form::label('iva', 'Iva:') !!}
    {!! Form::number('iva', null, ['class' => 'form-control']) !!}
</div>

<!-- Gtotal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gtotal', 'Gtotal:') !!}
    {!! Form::number('gtotal', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('headmovs.index') !!}" class="btn btn-default">Cancel</a>
</div>
