<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    {!! Form::text('persona_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Bankaccount Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bankaccount_id', 'Bankaccount Id:') !!}
    {!! Form::text('bankaccount_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Checkbook Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('checkbook_id', 'Checkbook Id:') !!}
    {!! Form::text('checkbook_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('personaccounts.index') !!}" class="btn btn-default">Cancel</a>
</div>
