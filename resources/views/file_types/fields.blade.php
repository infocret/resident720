<!-- Ident Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ident', 'Ident:') !!}
    {!! Form::text('ident', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Ext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ext', 'Ext:') !!}
    {!! Form::text('ext', null, ['class' => 'form-control']) !!}
</div>

<!-- Mimetype Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mimetype', 'Mimetype:') !!}
    {!! Form::text('mimetype', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('fileTypes.index') !!}" class="btn btn-default">Cancel</a>
</div>
