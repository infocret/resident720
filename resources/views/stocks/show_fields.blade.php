<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $stock->id !!}</p>
</div>

<!-- Storage Id Field -->
<div class="form-group">
    {!! Form::label('storage_id', 'Storage Id:') !!}
    <p>{!! $stock->storage_id !!}</p>
</div>

<!-- Article Id Field -->
<div class="form-group">
    {!! Form::label('article_id', 'Article Id:') !!}
    <p>{!! $stock->article_id !!}</p>
</div>

<!-- Stock Field -->
<div class="form-group">
    {!! Form::label('stock', 'Stock:') !!}
    <p>{!! $stock->stock !!}</p>
</div>

<!-- Location Field -->
<div class="form-group">
    {!! Form::label('location', 'Location:') !!}
    <p>{!! $stock->location !!}</p>
</div>

<!-- Stock Max Field -->
<div class="form-group">
    {!! Form::label('stock_max', 'Stock Max:') !!}
    <p>{!! $stock->stock_max !!}</p>
</div>

<!-- Stock Min Field -->
<div class="form-group">
    {!! Form::label('stock_min', 'Stock Min:') !!}
    <p>{!! $stock->stock_min !!}</p>
</div>

<!-- Observations Field -->
<div class="form-group">
    {!! Form::label('observations', 'Observations:') !!}
    <p>{!! $stock->observations !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $stock->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $stock->updated_at !!}</p>
</div>

