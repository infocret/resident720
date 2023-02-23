<!-- Statusticket Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('statusticket_id', 'Statusticket Id:') !!}
    {!! Form::text('statusticket_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Filename Field -->
<div class="form-group col-sm-6">
    {!! Form::label('filename', 'Filename:') !!}
    {!! Form::text('filename', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>

<!-- Observations Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observations', 'Observations:') !!}
    {!! Form::text('observations', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('statusticketimgs.index') !!}" class="btn btn-default">Cancel</a>
</div>
