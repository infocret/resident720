<!-- Cve Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cve', 'Cve:') !!}
    {!! Form::text('cve', null, ['class' => 'form-control']) !!}
</div>

<!-- Shortname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shortname', 'Shortname:') !!}
    {!! Form::text('shortname', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_date', 'Start Date:') !!}
    {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Final Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('final_date', 'Final Date:') !!}
    {!! Form::date('final_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Recurrence Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recurrence', 'Recurrence:') !!}
    {!! Form::number('recurrence', null, ['class' => 'form-control']) !!}
</div>

<!-- Interval Field -->
<div class="form-group col-sm-6">
    {!! Form::label('interval', 'Interval:') !!}
    {!! Form::number('interval', null, ['class' => 'form-control']) !!}
</div>

<!-- Unit Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unit_time', 'Unit Time:') !!}
    {!! Form::text('unit_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Business Days Field -->
<div class="form-group col-sm-6">
    {!! Form::label('business_days', 'Business Days:') !!}
    {!! Form::number('business_days', null, ['class' => 'form-control']) !!}
</div>

<!-- Sub Add Day Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_add_day', 'Sub Add Day:') !!}
    {!! Form::number('sub_add_day', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Observations Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observations', 'Observations:') !!}
    {!! Form::text('observations', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('periods.index') !!}" class="btn btn-default">Cancel</a>
</div>
