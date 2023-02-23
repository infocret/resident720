<!-- Inmu Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmu_id', 'Inmu Id:') !!}
    {!! Form::text('inmu_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Movto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('movto_id', 'Movto Id:') !!}
    {!! Form::text('movto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Periodap Field -->
<div class="form-group col-sm-6">
    {!! Form::label('periodap', 'Periodap:') !!}
    {!! Form::text('periodap', null, ['class' => 'form-control']) !!}
</div>

<!-- Validity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('validity', 'Validity:') !!}
    {!! Form::text('validity', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Nextap Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nextap', 'Nextap:') !!}
    {!! Form::date('nextap', null, ['class' => 'form-control']) !!}
</div>

<!-- Endvalidity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('endvalidity', 'Endvalidity:') !!}
    {!! Form::date('endvalidity', null, ['class' => 'form-control']) !!}
</div>

<!-- Observ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observ', 'Observ:') !!}
    {!! Form::text('observ', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('unidadmovtos.index') !!}" class="btn btn-default">Cancel</a>
</div>
