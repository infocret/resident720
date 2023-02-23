{{-- 
    +"inmutipo_id": 2
    +"inmutipo_name": "Departamento"
    +"inmueble_id": 2
    +"inmu_name": "Departamento 101"
    +"reltipo_id": 3
    +"reltipo_name": "Habitante"
    +"reltipo_desc": "Persona que habita un inmueble con el propietario o inquilino"
    +"pinmu_id": 2
    +"persona_id": 1
    +"observaciones": "Habitante y propietario"
    +"asignacion": "2018-04-25 00:00:00"
    +"baja": null
    +"Asignado": "1"
 --}}

<!-- pinmu_id Field -->
<div class="form-group">
    {!! Form::label('pinmu_id', 'Relación Id:') !!}
    <p>{!! $personaInmueble->pinmu_id !!}</p>
</div>

<!-- persona_id Field -->
<div class="form-group">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    <p>{!! $personaInmueble->persona_id !!}</p>
</div>

<!-- inmutipo_id Field -->
<div class="form-group">
    {!! Form::label('inmutipo_id', 'Tipo de inmueble Id:') !!}
    <p>{!! $personaInmueble->inmutipo_id !!}</p>
</div>

<!-- inmutipo_name Field -->
<div class="form-group">
    {!! Form::label('inmutipo_name', 'Tipo de inmueble:') !!}
    <p>{!! $personaInmueble->inmutipo_name !!}</p>
</div>

<!-- inmueble_id Field -->
<div class="form-group">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    <p>{!! $personaInmueble->inmueble_id !!}</p>
</div>

<!-- inmu_name Field -->
<div class="form-group">
    {!! Form::label('inmu_name', 'Inmueble Nombre:') !!}
    <p>{!! $personaInmueble->inmu_name !!}</p>
</div>

<!-- reltipo_id Field -->
<div class="form-group">
    {!! Form::label('reltipo_id', 'Tipo de Rel Id:') !!}
    <p>{!! $personaInmueble->reltipo_id !!}</p>
</div>

<!-- reltipo_name Field -->
<div class="form-group">
    {!! Form::label('reltipo_name', 'Tipo de Relación:') !!}
    <p>{!! $personaInmueble->reltipo_name !!}</p>
</div>

<!-- reltipo_desc Field -->
<div class="form-group">
    {!! Form::label('reltipo_desc', 'Descripcion de Relación:') !!}
    <p>{!! $personaInmueble->reltipo_desc !!}</p>
</div>

<!-- observaciones Field -->
<div class="form-group">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    <p>{!! $personaInmueble->observaciones !!}</p>
</div>

<!-- asignacion Field -->
<div class="form-group">
    {!! Form::label('asignacion', 'Asignación:') !!}
    <p>{!! $personaInmueble->asignacion !!}</p>
</div>

<!-- baja Field -->
<div class="form-group">
    {!! Form::label('baja', 'Baja:') !!}
    <p>{!! $personaInmueble->baja !!}</p>
</div>



