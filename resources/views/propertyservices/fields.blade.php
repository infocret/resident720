<!-- Cve Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cve', 'Cve:') !!}
    {!! Form::text('cve', null, ['class' => 'form-control']) !!}
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

<!-- Content Field -->
<div class="form-group col-sm-6">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::text('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Privileges Field -->
<div class="form-group col-sm-6">
    {!! Form::label('privileges', 'Privileges:') !!}
    {!! Form::text('privileges', null, ['class' => 'form-control']) !!}
</div>

<!-- Obligations Field -->
<div class="form-group col-sm-6">
    {!! Form::label('obligations', 'Obligations:') !!}
    {!! Form::text('obligations', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('propertyservices.index') !!}" class="btn btn-default">Cancel</a>
</div>
