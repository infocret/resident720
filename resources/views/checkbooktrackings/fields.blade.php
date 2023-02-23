<!-- Checkissuance Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('checkissuance_id', 'Checkissuance Id:') !!}
    {!! Form::text('checkissuance_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Datereg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('datereg', 'Datereg:') !!}
    {!! Form::date('datereg', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Observ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observ', 'Observ:') !!}
    {!! Form::text('observ', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('checkbooktrackings.index') !!}" class="btn btn-default">Cancel</a>
</div>
