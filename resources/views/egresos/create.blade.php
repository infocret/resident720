@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
           Registro de Egresos 
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'egreso.store',
                    'method'=>'post','files'=>'true','enctype'=>'multipart/form-data']) !!}

                        @include('egresos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    {{--  *************************************************************************************
      Este script permite saber si se llama a  inmumovtos.js desde el create o el edit 
      y pasa una variable general , sirve tambien si se desea enviar una variable de session
      <script type="text/javascript">
        var action = '{!! Session::get('personaexpid') !!}';
      </script>   
      ************************************************************************************* --}}  
 <script type="text/javascript">
    var action = 'create';   
    var rutax = '{{ url('/') }}';
    var variva = .16;    
    var tmovtos ={!! json_encode($TiposMovtos) !!};
    var tunidades ={!! json_encode($Unidades) !!};    
    var idetrow = 0;
    var imodo = 1;// modo de trabajo un concepto =1 
  </script>
@endsection

@section('scripts')
    {{-- Carga el java script de inmuegresos --}}
    <script src="{{ url('/js/inmuegresos.js') }}"></script>
@endsection

@section('css') {{-- Carga estilos --}}
<link rel="stylesheet" href="{{ url('/css/egresos.css') }}">
@endsection