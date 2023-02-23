@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Consulta de Movimiento</h1>
        {{-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('pparams.create') !!}">Agregar</a>
        </h1> --}}

        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" 
           href="{!! route('edoscta.showpdf', [$edocta->hid]) !!}">Ver PDF</a>
        </h1>

        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" 
           href="{!! route('edoscta.dnlwpdf', [$edocta->hid]) !!}">Descargar PDF</a>
        </h1>        

        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" 
           href="{!! route('edoscta.mailpdf', [$edocta->hid]) !!}">Enviar PDF por Correo</a>
        </h1>                           


    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('expededocta.movtoh')
                    @include('expededocta.movtod') 
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection


@section('css')
<link rel="stylesheet" href="{{ url('/css/tableedocta.css') }}">
@endsection

