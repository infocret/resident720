<!-- Movtobankaccount Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('movtobankaccount_id', 'Movtobankaccount Id:') !!}
    {!! Form::text('movtobankaccount_id', null, ['class' => 'form-control']) !!}
</div>

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

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Act Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('act_type', 'Act Type:') !!}
    {!! Form::text('act_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Activity Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activity_date', 'Activity Date:') !!}
    {!! Form::date('activity_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Applied Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_applied', 'Status Applied:') !!}
    {!! Form::text('status_applied', null, ['class' => 'form-control']) !!}
</div>

<!-- Observations Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observations', 'Observations:') !!}
    {!! Form::text('observations', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('activitytrackings.index') !!}" class="btn btn-default">Cancel</a>
</div>
