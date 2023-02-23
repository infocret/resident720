<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    {!! Form::number('inmueble_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Bankaccount Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bankaccount_id', 'Bankaccount Id:') !!}
    {!! Form::number('bankaccount_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Checkbook Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('checkbook_id', 'Checkbook Id:') !!}
    {!! Form::number('checkbook_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Bank Agreement Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_agreement', 'Bank Agreement:') !!}
    {!! Form::text('bank_agreement', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('propaccounts.index') !!}" class="btn btn-default">Cancel</a>
</div>
