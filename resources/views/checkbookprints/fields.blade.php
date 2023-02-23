<!-- Checkbook Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('checkbook_id', 'Checkbook Id:') !!}
    {!! Form::text('checkbook_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Desc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('desc', 'Desc:') !!}
    {!! Form::text('desc', null, ['class' => 'form-control']) !!}
</div>

<!-- Imgsample Field -->
<div class="form-group col-sm-6">
    {!! Form::label('imgsample', 'Imgsample:') !!}
    {!! Form::text('imgsample', null, ['class' => 'form-control']) !!}
</div>

<!-- Cssfile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cssfile', 'Cssfile:') !!}
    {!! Form::text('cssfile', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('checkbookprints.index') !!}" class="btn btn-default">Cancel</a>
</div>
