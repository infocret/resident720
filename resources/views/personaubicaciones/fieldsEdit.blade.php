
{{--  
$CodPo
"id" => 28752
"cp" => "08500"
"ciudad" => "Ciudad de México"
"estado" => "Ciudad de México"
"municipio" => "Iztacalco"
"tipo" => "Colonia"
"asentamiento" => "Agrícola Oriental"

$personaDir
 "id" => 2
"persona_id" => 1
"location_id" => 4
"codpo_id" => 28752
"pais" => "22"
"calle" => "Retorno 7 de Sur 20"
"numExt" => "21"
"piso" => "1"
"numInt" => "1"
"referencia1" => "Entre av sur 16 , av sur 20 , ote. 253 y ote 257"
"referencia2" => "frente a la otra"
"linkmapa" => "https://goo.gl/maps/D596SUAw3Cw"
"imagenMapa" => "http://"
"observaciones" => "ninguna"
"created_at" => "2018-03-23 07:43:55"
"updated_at" => "2018-03-23 07:43:55"
"deleted_at" => null

--}}
<div class="row">

<div class="form-group col-sm-4">
    {!! Form::label('location_id', 'Ubicación:') !!}
    <select name="location" id="location" class="form-control"  required>
    <option value="">Seleccione una ubicación</option>
    {{-- @if (isset($personaDir)&& !empty($personaDir)) --}}
    @foreach($ubicaciones as $ubicacion)            
        <option value="{{$ubicacion->id}}"
        {{$personaDir->location_id == $ubicacion->id ? 'selected="selected"' : '' }}
        >{{ $ubicacion->nombre }}
        </option>            
    @endforeach
    </select>
</div>

<div class="form-group col-sm-4">         
    {!! Form::label('lcontinente', 'Continente:',['id'=>'lcontinente']) !!}         
    <select name="continente" id="continente" class="form-control"  required>
    <option value="">Seleccione un Continente</option>            
    @foreach($continentes as $key => $value)            
        <option value="{{$key}}"
        {{$cont == $value ? 'selected="selected"' : '' }}
        >{{ $value}}
        </option>            
    @endforeach
    </select>
    {{-- {!!Form::select('continente',$continentes,null,
    ['placeholder'=>'Seleccione Continente','id'=>'continente','class' => 'form-control'])!!}   --}}
</div>

<div class="form-group col-sm-4">         
    {!! Form::label('lpais', 'País:',['id'=>'lpais']) !!}    

    <select name="pais" id="pais" class="form-control"  required>
    <option value="">Seleccione un País</option>            
    @foreach($paises as $key => $value)            
        <option value="{{$value}}"
        {{$personaDir->pais == $key ? 'selected="selected"' : '' }}
        >{{ $key}}
        </option>            
    @endforeach
    </select> 
    {{-- {!!Form::select('pais',$paises,null,
    ['placeholder'=>'Seleccione País','id'=>'pais','class' => 'form-control'])!!} --}} 
</div>

</div>

<div class="row">

<div class="form-group col-sm-4">         
    {!! Form::label('lestado', 'Estado:',['id'=>'lestado']) !!}
    <select name="estado" id="estado" class="form-control"  required>
    <option value="">Seleccione un Estado</option>            
    @foreach($estados as $key => $value)            
        <option value="{{$value}}"
        {{$CodPo->estado == $key ? 'selected="selected"' : '' }}
        >{{ $key}}
        </option>            
    @endforeach
    </select> 
    {{-- {!!Form::select('estado',$estados,null,
    ['placeholder'=>'Seleccione Estado','id'=>'estado','class' => 'form-control'])!!} --}}
</div>


<div class="form-group col-sm-4">         
   {!! Form::label('lciudad', 'Ciudad:',['id'=>'lciudad']) !!}  
    <select name="ciudad" id="ciudad" class="form-control"  required>
    <option value="">Seleccione una Ciudad</option>            
    @foreach($ciudades as $key => $value)            
        <option value="{{$value}}"
        {{$CodPo->ciudad == $key ? 'selected="selected"' : '' }}
        >{{ $key}}
        </option>            
    @endforeach
    </select> 
    {{--   {!!Form::select('ciudad',$ciudades,null,
        ['placeholder'=>'Seleccione Ciudad','id'=>'ciudad','class' => 'form-control'])!!}  --}}
</div>

<div class="form-group col-sm-4">         
   {!! Form::label('lmunicipio', 'Municipio:',['id'=>'lmunicipio']) !!}
   <select name="municipio" id="municipio" class="form-control"  required>
    <option value="">Seleccione un Municipio</option>            
    @foreach($municipios as $key => $value)            
        <option value="{{$value}}"
        {{$CodPo->municipio == $key ? 'selected="selected"' : '' }}
        >{{ $key}}
        </option>            
    @endforeach
    </select> 
    {{--   {!!Form::select('municipio',$municipios,null,
        ['placeholder'=>'Seleccione Municipio','id'=>'municipio','class' => 'form-control'])!!} --}}
</div>

</div>

<div class="row">

<div class="form-group col-sm-4">         
   {!! Form::label('lasentamiento', 'Asentamiento:',['id'=>'lasentamiento']) !!}
   <select name="asentamiento" id="asentamiento" class="form-control"  required>
    <option value="">Seleccione un Asentamiento</option>            
    @foreach($asentamientos as $key => $value)            
        <option value="{{$value}}"
        {{$CodPo->asentamiento == $key ? 'selected="selected"' : '' }}
        >{{ $key}}
        </option>            
    @endforeach
    </select> 
    {{--   {!!Form::select('asentamiento',
        ['placeholder'=>'Seleccione Asentamiento'],null,['id'=>'asentamiento','class' => 'form-control'])!!}--}}
</div>
