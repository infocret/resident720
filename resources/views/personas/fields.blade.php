<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Nombre(s):') !!}
    {!! Form::text('name', null, 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>

<!-- Appat Field -->
<div class="form-group col-sm-4">
    {!! Form::label('appat', 'Aapellido Paterno :') !!}
    {!! Form::text('appat', null, 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>

<!-- Apmat Field -->
<div class="form-group col-sm-4">
    {!! Form::label('apmat', 'Apellido Materno:') !!}
    {!! Form::text('apmat', null, 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>

 
@if (isset($persona)&& !empty($persona)) {{-- para Edit --}}
    <!-- Datebirth Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('datebirth', 'Fecha de Nacimiento:') !!}
        {!! Form::date('datebirth', $persona->datebirth, 
        ['class' => 'form-control',        
            'required' => 'required'
        ]) !!}
    </div>

    <div class="form-group col-sm-4">   
    {!! Form::label('lugaresnac', 'Lugar de Nacimiento:') !!} 
     <select name="lugaresnac" id="lugaresnac" class="form-control"  required>
     <option value="">Seleccione lugar de nacimiento</option>
        @foreach($lugaresnac as $key => $value)
            <option value="{{$key}}"
            {{$persona->lugarnac == $value ? 'selected="selected"' : '' }}
            >{{ $value }}
            </option>
        @endforeach
        {{-- @foreach($lugaresnac as $lugar)
            <option value="{{$lugar->renapo}}"
            {{$persona->lugarnac == $lugar->estado ? 'selected="selected"' : '' }}
            >{{ $lugar->estado }}
            </option>
        @endforeach --}}
    </select>
    </div>

    <div class="form-group col-sm-4">   
    {!! Form::label('lgenero2', 'Genero:') !!} 
     <select name="genero2" id="genero2" class="form-control"  required>
     <option value="">Seleccione Genero</option>    
     <option value="Mujer"
        {{$persona->genero == 'Mujer' ? 'selected="selected"' : '' }}
         >Mujer
     </option>
    <option value="Hombre"
        {{$persona->genero == 'Hombre' ? 'selected="selected"' : '' }}
         >Hombre
     </option>     
    </select>
    </div>    

@else    
    <!-- Datebirth Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('datebirth', 'Fecha de Nacimiento:') !!}
        {!! Form::date('datebirth', null, 
        ['class' => 'form-control',        
            'required' => 'required'
        ]) !!}
    </div>
    <!-- Lugar de Nacimiento -->
    <div class="form-group col-sm-4">
        {!! Form::label('lugaresnac', 'Lugar de Nacimiento:') !!}
        {!!Form::select('lugaresnac',$lugaresnac,null,
        ['placeholder'=>'Seleccione lugar de nacimiento','id'=>'lugaresnac',
        'class' => 'form-control','required' => 'required'])!!}       
    </div>
    <!-- Genero Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('lgenero2', 'Genero:') !!}
        {!!Form::select('genero2',['Hombre'=>'Hombre','Mujer'=>'Mujer'],null,
        ['placeholder'=>'Seleccione Genero','id'=>'genero2',
        'class' => 'form-control','required' => 'required'])!!}    
    </div>
@endif


<div class="form-group col-sm-12">
<a href="#" class='btn btn-default btn-xs' id='genrfccurp'>
<i class="fa fa-magic"></i>
Generar RFC y CURP</a>
</div>


<!-- Rfc Field -->
<div class="form-group col-sm-4">
    {!! Form::label('rfc', 'RFC:',['id'=>'lrfc']) !!}
    {!! Form::text('rfc', null, 
    ['class' => 'form-control',
        'minlength'=>'13',
        'maxlength'=>'13',
        'required' => 'required'
    ]) !!}
</div>

<!-- Curp Field -->
<div class="form-group col-sm-4">
    {!! Form::label('curp', 'CURP:',['id'=>'lcurp']) !!}
    {!! Form::text('curp', null, 
    ['class' => 'form-control',
        'minlength'=>'16',
        'maxlength'=>'18',
        'required' => 'required'
    ]) !!}
</div>

<!-- Nss Field -->
<div class="form-group col-sm-4">
    {!! Form::label('nss', 'NSS:') !!}
    {!! Form::text('nss', null, 
    ['class' => 'form-control',
        'minlength'=>'11',
        'maxlength'=>'11',
        'required' => 'required'
    ]) !!}
</div>
<!-- ******************************************************************************* 
 Submit Field -->
 @if (isset($orig) && !empty($orig)) {{-- Si trae origen --}}


<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    @if ($orig == 'expedp')     {{-- Si el origen es de expediente de persona --}}
        <a href="{!! route('personaexp.index',$persona->id) !!}" class="btn btn-default">Cancelar</a>
    @else                       {{-- Si el origen es index de personas  --}}
        <a href="{!! route('personas.index') !!}" class="btn btn-default">Cancelar</a>
    @endif
</div>

@endif

{{--  <div class="form-group col-sm-4">
    {!! Form::label('lgenero', 'Genero:') !!}  --}}
    {!! Form::hidden('genero', null, ['class' => 'form-control','id' => 'genero']) !!}
{{--  </div> --}} 

<!-- Lugarnac Field -->
{{--  <div class="form-group col-sm-4">
    {!! Form::label('llugarnac', 'Lugarnac:') !!} --}}
    {!! Form::hidden('lugarnac', null, ['class' => 'form-control','id' => 'lugarnac']) !!}
{{--  </div>  --}}