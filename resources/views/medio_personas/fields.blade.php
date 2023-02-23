<!-- Medio Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medio_id', 'Medio Id:') !!}
    {!! Form::text('medio_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    {!! Form::text('persona_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Dato Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dato', 'Dato:') !!}
    {!! Form::text('dato', null, ['class' => 'form-control']) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('medioPersonas.index') !!}" class="btn btn-default">Cancel</a>
</div>
