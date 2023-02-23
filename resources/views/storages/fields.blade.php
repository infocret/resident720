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

<!-- Shortname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shortname', 'Shortname:') !!}
    {!! Form::text('shortname', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Observations Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observations', 'Observations:') !!}
    {!! Form::text('observations', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('storages.index') !!}" class="btn btn-default">Cancel</a>
</div>
