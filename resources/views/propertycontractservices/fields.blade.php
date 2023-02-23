<!-- Contract Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contract_id', 'Contract Id:') !!}
    {!! Form::text('contract_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Propertyservice Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('propertyservice_id', 'Propertyservice Id:') !!}
    {!! Form::text('propertyservice_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Period Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('period_id', 'Period Id:') !!}
    {!! Form::text('period_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('propertycontractservices.index') !!}" class="btn btn-default">Cancel</a>
</div>
