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

<!-- Folio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('folio', 'Folio:') !!}
    {!! Form::text('folio', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tickets.index') !!}" class="btn btn-default">Cancel</a>
</div>
