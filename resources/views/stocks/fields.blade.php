<!-- Storage Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('storage_id', 'Storage Id:') !!}
    {!! Form::text('storage_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Article Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('article_id', 'Article Id:') !!}
    {!! Form::text('article_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock', 'Stock:') !!}
    {!! Form::number('stock', null, ['class' => 'form-control']) !!}
</div>

<!-- Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location', 'Location:') !!}
    {!! Form::text('location', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Max Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_max', 'Stock Max:') !!}
    {!! Form::number('stock_max', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Min Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_min', 'Stock Min:') !!}
    {!! Form::number('stock_min', null, ['class' => 'form-control']) !!}
</div>

<!-- Observations Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observations', 'Observations:') !!}
    {!! Form::text('observations', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('stocks.index') !!}" class="btn btn-default">Cancel</a>
</div>
