@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Categorias de proveedores</h1>
        <h1 class="pull-right">
            {{-- ini - Boton que llama a ventana modal  --}}
{{--             <button 
            type="button" 
            class="btn btn-primary  pull-right" 
            style="margin-top: -10px;margin-bottom: 5px"
            data-toggle="modal" 
            data-target="#creapop">
            Nueva PopMod
            </button> --}}
            {{-- Fin- Boton que llama a ventana modal  --}}
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('provcats.create') !!}">Agregar</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('provcats.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
       @include('provcats.createpop'){{-- Incluye view para ventana modal --}}
@endsection

