<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $countries->id !!}</p>
</div>

<!-- Continente Field -->
<div class="form-group">
    {!! Form::label('continente', 'Continente:') !!}
    <p>{!! $countries->continente !!}</p>
</div>

<!-- Pais Field -->
<div class="form-group">
    {!! Form::label('pais', 'Pais:') !!}
    <p>{!! $countries->pais !!}</p>
</div>

<!-- Capital Field -->
<div class="form-group">
    {!! Form::label('capital', 'Capital:') !!}
    <p>{!! $countries->capital !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $countries->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $countries->updated_at !!}</p>
</div>

