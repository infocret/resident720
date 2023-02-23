<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $maillist->id !!}</p>
</div>

<!-- Inmueble Id Field -->
<div class="form-group">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    <p>{!! $maillist->inmueble_id !!}</p>
</div>

<!-- Listtype Field -->
<div class="form-group">
    {!! Form::label('listtype', 'Listtype:') !!}
    <p>{!! $maillist->listtype !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $maillist->email !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $maillist->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $maillist->updated_at !!}</p>
</div>

