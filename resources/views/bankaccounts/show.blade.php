@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Datos de Cuenta Bancaria
            <a class="btn btn-primary pull-right" 
            href="{!! route('checkbooks.createb',[$bankaccount->id]) !!}">Agregar Chequera</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        
        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('bankaccounts.show_fields')
                    <a href="{!! route('bankaccounts.indexb') !!}" class="btn btn-default">Regresar</a>
                    
                </div>
            </div>
        </div>
    </div>
@endsection


@section('css') {{-- Carga estilos de tabla como la de egresos--}}
<link rel="stylesheet" href="{{ url('/css/egresos.css') }}">
@endsection