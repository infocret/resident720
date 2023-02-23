<!-- Territory Field -->
<div class="form-group col-sm-6">
    {!! Form::label('territory', 'Territory:') !!}
    {!! Form::text('territory', null, ['class' => 'form-control']) !!}
</div>

<!-- Currency Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency', 'Currency:') !!}
    {!! Form::text('currency', null, ['class' => 'form-control']) !!}
</div>

<!-- Symbol Field -->
<div class="form-group col-sm-6">
    {!! Form::label('symbol', 'Symbol:') !!}
    {!! Form::text('symbol', null, ['class' => 'form-control']) !!}
</div>

<!-- Iso Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('iso_code', 'Iso Code:') !!}
    {!! Form::text('iso_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Fractional Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fractional_unit', 'Fractional Unit:') !!}
    {!! Form::text('fractional_unit', null, ['class' => 'form-control']) !!}
</div>

<!-- Base Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('base_number', 'Base Number:') !!}
    {!! Form::text('base_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('currencytypes.index') !!}" class="btn btn-default">Cancel</a>
</div>
