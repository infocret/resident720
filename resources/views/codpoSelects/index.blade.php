@extends('layouts.app')

@section('content')
    <section class="content-header">

        <!-- selects -->
         <div class="form-group">         
           {!! Form::label('lciudad', 'Ciudad:') !!}  
           {!!Form::select('ciudad',$ciudades,null,
            ['placeholder'=>'Seleccione Ciudad','id'=>'ciudad'])!!} 
        </div>
      {{--   <div class="form-group">         
           {!! Form::label('lestado', 'Estado:') !!}  
           {!!Form::select('estado',$estados,null,
            ['placeholder'=>'Seleccione Estado','id'=>'estado'])!!} 
        </div> --}}
        <div class="form-group">
            {!! Form::label('lestado', 'Estado:') !!}
            {!!Form::select('etado',
            ['placeholder'=>'Seleccione Estado'],null,['id'=>'estado'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('lmunicipio', 'Municipio:') !!}
            {!!Form::select('municipio',
            ['placeholder'=>'Seleccione Municipio'],null,['id'=>'municipio'])!!}
        </div>
    
        <div class="form-group">
            {!! Form::label('lasentamiento', 'Asentamiento:') !!}
            {!!Form::select('asentamiento',
            ['placeholder'=>'Seleccione Asentamiento'],null,['id'=>'asentamiento'])!!}
        </div>

    </section>


    
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                   {{--  @include('cod_pos.table') --}}
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

@section('scripts')
        {{-- Carga el java script de dropdown --}} 
       
       <script src="/js/dropsdown.js"></script>
@endsection

 {{-- Para llenar el combo barriendo la colleccion y armarlo a manita --}}
{{-- <select name="estado" id="estado" class="form-control" >
    <option value="">Seleccione Estado</option>
    @foreach($estados as $estado)
    <option value="{{$estado->estado}}"> {{$estado->estado}}</option>        
@endforeach
</select>  --}}  