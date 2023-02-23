<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::text('estado', null, ['class' => 'form-control']) !!}
</div>

<!-- Renapo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('renapo', 'Renapo:') !!}
    {!! Form::text('renapo', null, ['class' => 'form-control']) !!}
</div>

<!-- Abrev Field -->
<div class="form-group col-sm-6">
    {!! Form::label('abrev', 'Abrev:') !!}
    {!! Form::text('abrev', null, ['class' => 'form-control']) !!}
</div>

<!-- Dosdig Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dosdig', 'Dosdig:') !!}
    {!! Form::text('dosdig', null, ['class' => 'form-control']) !!}
</div>

<!-- Iso Field -->
<div class="form-group col-sm-6">
    {!! Form::label('iso', 'Iso:') !!}
    {!! Form::text('iso', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('curpestados.index') !!}" class="btn btn-default">Cancel</a>
</div>
