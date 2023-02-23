<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $ticket->id !!}</p>
</div>

<!-- Inmueble Id Field -->
<div class="form-group">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    <p>{!! $ticket->inmueble_id !!}</p>
</div>

<!-- Propertyarea Id Field -->
<div class="form-group">
    {!! Form::label('propertyarea_id', 'Propertyarea Id:') !!}
    <p>{!! $ticket->propertyarea_id !!}</p>
</div>

<!-- Folio Field -->
<div class="form-group">
    {!! Form::label('folio', 'Folio:') !!}
    <p>{!! $ticket->folio !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $ticket->description !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $ticket->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $ticket->updated_at !!}</p>
</div>

