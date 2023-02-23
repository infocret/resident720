<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Inmucharge Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmucharge_id', 'Inmucharge Id:') !!}
    {!! Form::text('inmucharge_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Reading Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reading_date', 'Reading Date:') !!}
    {!! Form::date('reading_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Reading Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_reading', 'Last Reading:') !!}
    {!! Form::number('last_reading', null, ['class' => 'form-control']) !!}
</div>

<!-- Current Reading Field -->
<div class="form-group col-sm-6">
    {!! Form::label('current_reading', 'Current Reading:') !!}
    {!! Form::number('current_reading', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Gas Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gas_price', 'Gas Price:') !!}
    {!! Form::number('gas_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Application Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('application_date', 'Application Date:') !!}
    {!! Form::date('application_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('gasconsumptions.index') !!}" class="btn btn-default">Cancel</a>
</div>
