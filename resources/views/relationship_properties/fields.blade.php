<!-- Parent Property Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_property', 'Parent Property:') !!}
    {!! Form::text('parent_property', null, ['class' => 'form-control']) !!}
</div>

<!-- Son Property Field -->
<div class="form-group col-sm-6">
    {!! Form::label('son_property', 'Son Property:') !!}
    {!! Form::text('son_property', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('relationshipProperties.index') !!}" class="btn btn-default">Cancel</a>
</div>
