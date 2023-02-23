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

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Mask Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mask', 'Mask:') !!}
    {!! Form::text('mask', null, ['class' => 'form-control']) !!}
</div>

<!-- Imgfilename Field -->
<div class="form-group col-sm-6">
    {!! Form::label('imgfilename', 'Imgfilename:') !!}
    {!! Form::text('imgfilename', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('medios.index') !!}" class="btn btn-default">Cancel</a>
</div>
