<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::textarea('link', null, ['class' => 'form-control']) !!}
</div>

<!-- Filename Field -->
<div class="form-group col-sm-6">
    {!! Form::label('filename', 'Filename:') !!}
    {!! Form::text('filename', null, ['class' => 'form-control']) !!}
</div>

<!-- Activ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activ', 'Activ:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('activ', false) !!}
        {!! Form::checkbox('activ', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inmuebleImagesids.index') !!}" class="btn btn-default">Cancel</a>
</div>
