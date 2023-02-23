@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Proveedor
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'providers.store']) !!}

                      @include('providers.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

  @include('providers.createpop'){{-- Incluye view para ventana modal de categorias--}}
  @include('providers.createpopb'){{-- Incluye view para ventana modal de cuentas bancarias--}}
{{--  *************************************************************************************
      Este script permite saber si se llama a  dropdownctas.js desde el create o el edit 
      y pasa una variable general , sirve tambien si se desea enviar una variable de session
      <script type="text/javascript">
        var action = '{!! Session::get('personaexpid') !!}';
      </script>   
      ************************************************************************************* --}}
  <script type="text/javascript">
    var action = 'create';   
    var rutax = '{{ url('/') }}';
  </script>

@endsection

@section('css')
<link rel="stylesheet" href="{{ url('/css/tablescroll.css') }}">
@endsection

@section('scripts')
    {{-- Carga el java script de checkbox --}}
    <script src="{{ url('/js/checkbox.js') }}"></script>
    {{-- Carga el java script de dropdown de cuentas --}}
    <script src="{{ url('/js/dropsdownctas.js') }}"></script>
    {{-- Carga el java script de checkbookonbank --}}
    <script src="{{ url('/js/checkbookonbank.js') }}"></script>  
@endsection




