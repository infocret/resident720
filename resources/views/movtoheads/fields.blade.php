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

<!-- Movtype Field -->
<div class="form-group col-sm-6">
    {!! Form::label('movtype', 'Movtype:') !!}
    {!! Form::text('movtype', null, ['class' => 'form-control']) !!}
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

<!-- Doc Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('doc_link', 'Doc Link:') !!}
    {!! Form::text('doc_link', null, ['class' => 'form-control']) !!}
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

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('movtoheads.index') !!}" class="btn btn-default">Cancel</a>
</div>
