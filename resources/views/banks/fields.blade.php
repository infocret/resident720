<!-- Cve Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cve', 'Cve:') !!}
    {!! Form::text('cve', null, ['class' => 'form-control']) !!}
</div>

<!-- Ident Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ident', 'Ident:') !!}
    {!! Form::text('ident', null, ['class' => 'form-control']) !!}
</div>

<!-- Shortname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shortname', 'Shortname:') !!}
    {!! Form::text('shortname', null, ['class' => 'form-control']) !!}
</div>

<!-- Fullname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fullname', 'Fullname:') !!}
    {!! Form::text('fullname', null, ['class' => 'form-control']) !!}
</div>

<!-- Participates Field -->
<div class="form-group col-sm-6">
    {!! Form::label('participates', 'Participates:') !!}
    {!! Form::text('participates', null, ['class' => 'form-control']) !!}
</div>

<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('banks.index') !!}" class="btn btn-default">Cancel</a>
</div>
