<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $statusticket->id !!}</p>
</div>

<!-- Ticket Id Field -->
<div class="form-group">
    {!! Form::label('ticket_id', 'Ticket Id:') !!}
    <p>{!! $statusticket->ticket_id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $statusticket->user_id !!}</p>
</div>

<!-- Status Date Field -->
<div class="form-group">
    {!! Form::label('status_date', 'Status Date:') !!}
    <p>{!! $statusticket->status_date !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $statusticket->status !!}</p>
</div>

<!-- Observations Field -->
<div class="form-group">
    {!! Form::label('observations', 'Observations:') !!}
    <p>{!! $statusticket->observations !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $statusticket->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $statusticket->updated_at !!}</p>
</div>

