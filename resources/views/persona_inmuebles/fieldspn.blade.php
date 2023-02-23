<div class="form-group col-sm-12">
<h5 class="pull-left" style="
color: #616161;
background: #bababa;
text-shadow: #e0e0e0 1px 1px 0;
color: #616161;
background: #ECECEC;
">
 Esta operación crea una nueva persona y establece la relación con el inmueble.
</h5>
</div>

{{-- <div class="row"> --}}
<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Nombre(s):') !!}
    {!! Form::text('namep', 'N/A', 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>
<!-- Appat Field -->
<div class="form-group col-sm-4">
    {!! Form::label('appat', 'Aapellido Paterno :') !!}
    {!! Form::text('appatp', 'N/A', 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>
<!-- Apmat Field -->
<div class="form-group col-sm-4">
    {!! Form::label('apmat', 'Apellido Materno:') !!}
    {!! Form::text('apmatp', 'N/A', 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>
</div> <!-- Row 3 -->

<div class="row">
<!-- Dato correo -->
<div class="form-group col-sm-4">
    {!! Form::label('dato', 'Correo:') !!}
    {!! Form::text('datemailp', 'N/A', [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'50',
        'required' => 'required'
        ]) !!}
</div>

<!-- Dato telefono -->
<div class="form-group col-sm-4">
    {!! Form::label('dato', 'Telefono:') !!}
    {!! Form::text('datphonep', 'N/A', [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'50',
        'required' => 'required'
        ]) !!}
</div>
{{-- <!-- Inmueble Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    {!! Form::text('inmueble_id', $propertyid, ['class' => 'form-control']) !!}
</div> --}}

<!--</div>  Row 4 -->






<!-- Reltipo Id Field -->
<div class="form-group col-sm-4">
{!! Form::label('reltipo_id', 'Reltipo Id:') !!} 
  <select name="reltipo_id" id="reltipo_id" class="form-control"  required>
     <option value="">Seleccione Tipo de Relación:</option>
    @if (isset($persInmuReltipoReqDoc)&& !empty($persInmuReltipoReqDoc)) {{-- para Edit --}}

        @foreach($reltypes as $reltype)
            
            <option value="{{$reltype ->id}}"
            {{$persInmuReltipoReqDoc ->tablaexterna_id == $reltype ->id ? 'selected="selected"' : '' }}
            >{{ $reltype ->nombre }}
            </option>            

        @endforeach

    @else                                            {{-- para Create --}}

        @foreach($reltypes as $reltype)            
            <option value="{{$reltype ->id}}">{{ $reltype ->nombre }}</option>            
        @endforeach

    @endif
    </select>
    {{-- {{Form::select('tablaexterna _id',$reltypes),['class' => 'form-control']}} --}}
 </div>

<!-- Asignacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('asignacion', 'Asignacion:') !!}
    {!! Form::date('asignacion', $hoy, ['class' => 'form-control']) !!}
</div> 

<!-- Baja Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('baja', 'Baja:') !!}
    {!! Form::date('baja', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Observaciones Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', 'N/A', ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('relinmp.expinmuindex',$propertyid) !!}" class="btn btn-default">Cancelar</a>
</div>
