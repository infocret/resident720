<!-- Inmu Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmu_id', 'Inmu Id:') !!}
    {!! Form::text('inmu_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Conceptserv Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('conceptserv_id', 'Conceptserv Id:') !!}
    {!! Form::text('conceptserv_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Proparea Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('proparea_id', 'Proparea Id:') !!}
    {!! Form::text('proparea_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Provider Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('provider_id', 'Provider Id:') !!}
    {!! Form::text('provider_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Folio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('folio', 'Folio:') !!}
    {!! Form::text('folio', null, ['class' => 'form-control']) !!}
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

<!-- Balance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('balance', 'Balance:') !!}
    {!! Form::number('balance', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Observ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observ', 'Observ:') !!}
    {!! Form::text('observ', null, ['class' => 'form-control']) !!}
</div>

<!-- Filelink Field -->
<div class="form-group col-sm-6">
    {!! Form::label('filelink', 'Filelink:') !!}
    {!! Form::text('filelink', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inmucharges.index') !!}" class="btn btn-default">Cancel</a>
</div>
