@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
        Estado de cuenta 
        <h1 class="pull-right">
        <a class="btn btn-primary pull-right" 
        style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
        href="{!! route('edoscta.indexb', [$charge->unidid,$dfrom,$dto,$cservid])  !!}" >Volver</a>
        </h1>
        
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('expededocta.tabled')                   
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
     @include('expededocta.movtopop') {{-- Incluye view para ventana modal de categorias--}}
     @include('expededocta.editmovpop') {{-- Incluye view para ventana modal de edición de movto--}}
     @include('expededocta.rollbackpop') {{-- Incluye view para ventana modal de reverso de cancelacion--}}

{{--  *************************************************************************************
      Este script permite saber si se llama a  dropdownctas.js desde el create o el edit 
      y pasa una variable general , sirve tambien si se desea enviar una variable de session
      ************************************************************************************* --}}
  <script type="text/javascript">
    var action = 'create';   
    var rutax = '{{ url('/') }}';
  </script>

@endsection

@section('css')
<link rel="stylesheet" href="{{ url('/css/pdfrecipb.css') }}">
@endsection 

@section('scripts')
    {{-- Carga el java script de checkbox --}}
    <script src="{{ url('/js/aplimovtos.js') }}"></script>
@endsection


