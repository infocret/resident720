@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Print test</h1>
        <h1 class="pull-right">
           
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="cheque">
                    <p class="ptext">Hola mundo</p>
    
                </div>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

@section('css') {{-- Carga estilos --}}
<link rel="stylesheet" href="{{ url('/css/checkprinttest.css') }}">
@endsection

