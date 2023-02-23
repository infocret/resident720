<!-- Conceptservices Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('conceptservices_id', 'Conceptservices Id:') !!}
    {!! Form::text('conceptservices_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Propaccounts Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('propaccounts_id', 'Propaccounts Id:') !!}
    {!! Form::text('propaccounts_id', null, ['class' => 'form-control']) !!}
</div>

<!-- T Use Field -->
<div class="form-group col-sm-6">
    {!! Form::label('t_use', 'T Use:') !!}
    {!! Form::text('t_use', null, ['class' => 'form-control']) !!}
</div>

<!-- Bank Agreement Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_agreement', 'Bank Agreement:') !!}
    {!! Form::text('bank_agreement', null, ['class' => 'form-control']) !!}
</div>

<!-- Bank Reference Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_reference', 'Bank Reference:') !!}
    {!! Form::text('bank_reference', null, ['class' => 'form-control']) !!}
</div>

<!-- Reciptext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reciptext', 'Reciptext:') !!}
    {!! Form::text('reciptext', null, ['class' => 'form-control']) !!}
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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('conceptservpropaccounts.index') !!}" class="btn btn-default">Cancel</a>
</div>
