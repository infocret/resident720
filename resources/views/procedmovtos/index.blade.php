@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Procedimientos de aplicación de Movimientos</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('procedmovtos.create') !!}">Agregar</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('procedmovtos.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

@section('css')
  {{-- Carga el estilo css --}}
  <link rel="stylesheet" href="{{ url('/css/procedmovtos.css') }}">
@endsection