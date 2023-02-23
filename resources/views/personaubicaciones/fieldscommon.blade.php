
 <!-- Calle Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('calle', 'Calle:') !!}
        {!! Form::text('calle', null,
        [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'150',
        'required' => 'required'
        ]) !!}
    </div>

    <!-- Numext Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('numExt', 'Numext:') !!}
        {!! Form::text('numExt', null,        
        [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'8',
        'required' => 'required'
        ]) !!}
    </div>
    
</div>
    <!-- Pais Field -->
    {{-- <div class="form-group col-sm-3">
        {!! Form::label('pais', 'Pais:') !!}
        {!! Form::text('pais', null, ['class' => 'form-control']) !!}
    </div> --}}
<div class="row">
        <!-- Piso Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('piso', 'Piso:') !!}
        {!! Form::text('piso', null,        
        [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'8',
        'required' => 'required'
        ]) !!}
    </div>
    <!-- Numint Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('numInt', 'Numint:') !!}
        {!! Form::text('numInt', null,        
        [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'8',
        'required' => 'required'
        ]) !!}
    </div>
    <!-- Referencia1 Field -->
    <div class="form-group col-sm-4">
    {!! Form::label('referencia1', 'Referencia1:') !!}
    {!! Form::text('referencia1', null,        
        [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'100',
        'required' => 'required'
        ]) !!}
    </div>
</div>

<div class="row">
    <!-- Referencia2 Field -->
    <div class="form-group col-sm-4">
    {!! Form::label('referencia2', 'Referencia2:') !!}
    {!! Form::text('referencia2', null,        
        [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'100',
        'required' => 'required'
        ]) !!}
    </div>
     <!-- Linkmapa Field -->
    <div class="form-group col-sm-4">
    {!! Form::label('linkmapa', 'Linkmapa:') !!}
    {!! Form::text('linkmapa', null,        
        [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'300',
        'required' => 'required'
        ]) !!}
    </div>
    <!-- Imagenmapa Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('imagenMapa', 'Imagenmapa:') !!}        
        {!! Form::text('imagenMapa', null,        
        [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'150',
        'required' => 'required'
        ]) !!}
    </div>
</div>

<div class="row">
    <!-- Observaciones Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('observaciones', 'Observaciones:') !!}
        {!! Form::text('observaciones', null,                    
        [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'150',
        'required' => 'required'
        ]) !!}
    </div>
</div>

<div class="row">
   <!-- Submit Field -->
    <div class="form-group col-sm-6">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('personaubicaciones.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</div>

 <div class="row">
  <!-- Persona Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('llocation_id', 'Ubicación Id:',['style'=>'visibility:hidden']) !!}
        {!! Form::text('location_id', null, 
        ['class' => 'form-control','required' => 'required','style'=>'visibility:hidden']) !!} 
        {!! Form::label('persona_id', 'Persona Id:',['style'=>'visibility:hidden']) !!}
        {!! Form::text('persona_id', Session::get('personaexpid'), 
        ['class' => 'form-control','required' => 'required','style'=>'visibility:hidden']) !!}
        {{-- ['class' => 'form-control','style'=>'visibility:hidden']) !!} --}}  
            <!-- Codpo Id Field -->    
        {!! Form::label('codpo_id', 'Codpo Id:',['style'=>'visibility:hidden']) !!}
        {!! Form::text('codpo_id', null, ['class' => 'form-control',
        'class' => 'form-control','required' => 'required','style'=>'visibility:hidden']) !!}
    </div>  
</div> 

{{-- 

Ubicacion:

Continente:         Pais:       Ciudad:     

Estado:             Municipio:  Asentamiento: tipo+asentamiento
    
CP:             CodPos_id:

Calle:

NumExt:             NumInt:     Piso:

Referencia 1:           
    
Referencia 2:

Observaciones:

Link de Mapa:

Imagen de Mapa (PNG 600 px de ancho): 

 --}}