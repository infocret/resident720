
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
      <!-- Location Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('location_id', 'Location Id:') !!}
        {!!Form::select('location',$ubicaciones,null,
        ['placeholder'=>'Seleccione Ubicación','id'=>'slocation',
        'class' => 'form-control','required' => 'required'])!!}       
    </div>
    <div class="form-group col-sm-4">         
        {!! Form::label('lcontinente', 'Continente:',['id'=>'lcontinente']) !!} 
        {!!Form::select('continente',$continentes,null,
        ['placeholder'=>'Seleccione Continente','id'=>'continente',
        'class' => 'form-control','required' => 'required'])!!}  
    </div>
    <div class="form-group col-sm-4">         
        {!! Form::label('lpais', 'País:',['id'=>'lpais']) !!}
        {!!Form::select('pais',$paises,null,
        ['placeholder'=>'Seleccione País','id'=>'pais',
        'class' => 'form-control','required' => 'required'])!!}   
    </div>
 </div>

<div class="row">
    <div class="form-group col-sm-4"> 
        {!! Form::label('lestado', 'Estado:',['id'=>'lestado']) !!}
        {!!Form::select('estado',$estados,null,
        ['placeholder'=>'Seleccione Estado','id'=>'estado',
        'class' => 'form-control','required' => 'required'])!!}
    </div>

     <div class="form-group col-sm-4"> 
        {!! Form::label('lciudad', 'Ciudad:',['id'=>'lciudad']) !!}  
        {!!Form::select('ciudad',$ciudades,null,
        ['placeholder'=>'Seleccione Ciudad','id'=>'ciudad',
        'class' => 'form-control','required' => 'required'])!!} 
    </div>

    <div class="form-group col-sm-4">
        {!! Form::label('lmunicipio', 'Municipio:',['id'=>'lmunicipio']) !!}
        {!!Form::select('municipio',$municipios,null,
        ['placeholder'=>'Seleccione Municipio','id'=>'municipio',
        'class' => 'form-control','required' => 'required'])!!}
    </div>

      

</div>

<div class="row">
  <div class="form-group col-sm-4">
        {!! Form::label('lasentamiento', 'Asentamiento:',['id'=>'lasentamiento']) !!}
        {!!Form::select('asentamiento',
        ['placeholder'=>'Seleccione Asentamiento'],null,['id'=>'asentamiento',
        'class' => 'form-control','required' => 'required'])!!}
    </div>
