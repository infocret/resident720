<!-- Conceptserv Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('conceptserv_id', 'Conceptserv Id:') !!}
    {!! Form::text('conceptserv_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cve Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cve', 'Cve:') !!}
    {!! Form::number('cve', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo', 'Tipo:') !!}
    {!! Form::text('tipo', null, ['class' => 'form-control']) !!}
</div>

<!-- Shortname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shortname', 'Shortname:') !!}
    {!! Form::text('shortname', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Observ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observ', 'Observ:') !!}
    {!! Form::text('observ', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('catmovtos.index') !!}" class="btn btn-default">Cancel</a>
</div>
