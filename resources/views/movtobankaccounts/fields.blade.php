<!-- Movtohead Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('movtohead_id', 'Movtohead Id:') !!}
    {!! Form::text('movtohead_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Checkbook Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('checkbook_id', 'Checkbook Id:') !!}
    {!! Form::text('checkbook_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Bankaccount Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bankaccount_id', 'Bankaccount Id:') !!}
    {!! Form::text('bankaccount_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Nchbook Ntrx Ref Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nchbook_ntrx_ref', 'Nchbook Ntrx Ref:') !!}
    {!! Form::text('nchbook_ntrx_ref', null, ['class' => 'form-control']) !!}
</div>

<!-- Owner Field -->
<div class="form-group col-sm-6">
    {!! Form::label('owner', 'Owner:') !!}
    {!! Form::text('owner', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Partial Payment Field -->
<div class="form-group col-sm-12">
    {!! Form::label('partial_payment', 'Partial Payment:') !!}
    <label class="radio-inline">
        {!! Form::radio('partial_payment', "1", null) !!} Si
    </label>

    <label class="radio-inline">
        {!! Form::radio('partial_payment', "0", null) !!} No
    </label>

</div>

<!-- Observations Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observations', 'Observations:') !!}
    {!! Form::text('observations', null, ['class' => 'form-control']) !!}
</div>

<!-- Head Balance Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Head_balance_Amount', 'Head Balance Amount:') !!}
    {!! Form::number('Head_balance_Amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('movtobankaccounts.index') !!}" class="btn btn-default">Cancel</a>
</div>
