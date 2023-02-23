<!-- Movtobankaccount Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('movtobankaccount_id', 'Movtobankaccount Id:') !!}
    {!! Form::text('movtobankaccount_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Movtodetail Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('movtodetail_id', 'Movtodetail Id:') !!}
    {!! Form::text('movtodetail_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Applie Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('applie_date', 'Applie Date:') !!}
    {!! Form::date('applie_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Applied Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount_applied', 'Amount Applied:') !!}
    {!! Form::number('amount_applied', null, ['class' => 'form-control']) !!}
</div>

<!-- Detail Balance Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('detail_balance_amount', 'Detail Balance Amount:') !!}
    {!! Form::number('detail_balance_amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('movdetailapplies.index') !!}" class="btn btn-default">Cancel</a>
</div>
