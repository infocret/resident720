<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $relationshipPropertie->id !!}</p>
</div>

<!-- Parent Property Field -->
<div class="form-group">
    {!! Form::label('parent_property', 'Parent Property:') !!}
    <p>{!! $relationshipPropertie->parent_property !!}</p>
</div>

<!-- Son Property Field -->
<div class="form-group">
    {!! Form::label('son_property', 'Son Property:') !!}
    <p>{!! $relationshipPropertie->son_property !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $relationshipPropertie->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $relationshipPropertie->updated_at !!}</p>
</div>

