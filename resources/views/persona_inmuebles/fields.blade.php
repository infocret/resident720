<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    {!! Form::text('persona_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Reltipo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reltipo_id', 'Reltipo Id:') !!}
    {!! Form::text('reltipo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Asignacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('asignacion', 'Asignacion:') !!}
    {!! Form::date('asignacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Baja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('baja', 'Baja:') !!}
    {!! Form::date('baja', null, ['class' => 'form-control']) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('personaInmuebles.index') !!}" class="btn btn-default">Cancel</a>
</div>
