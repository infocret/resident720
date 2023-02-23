<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $checkbook->id !!}</p>
</div>

<!-- Bankaccount Id Field -->
<div class="form-group">
    {!! Form::label('bankaccount_id', 'Bankaccount Id:') !!}
    <p>{!! $checkbook->bankaccount_id !!}</p>
</div>

<!-- Shortname Field -->
<div class="form-group">
    {!! Form::label('shortname', 'Shortname:') !!}
    <p>{!! $checkbook->shortname !!}</p>
</div>

<!-- Fullname Field -->
<div class="form-group">
    {!! Form::label('fullname', 'Fullname:') !!}
    <p>{!! $checkbook->fullname !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $checkbook->description !!}</p>
</div>

<!-- Start Field -->
<div class="form-group">
    {!! Form::label('start', 'Start:') !!}
    <p>{!! $checkbook->start !!}</p>
</div>

<!-- End Field -->
<div class="form-group">
    {!! Form::label('end', 'End:') !!}
    <p>{!! $checkbook->end !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $checkbook->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $checkbook->updated_at !!}</p>
</div>

