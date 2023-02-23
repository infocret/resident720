@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Personas asignadas</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px;
            margin-left: 10px"  
            href="{!! route('relinmp.frompersonas',$inmuid) !!}">Agregar Existente</a>

            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px;
            margin-left: 10px" 
            href="{!! route('relinmp.newperson',$inmuid) !!}">Nueva Persona</a>
           
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('persona_inmuebles.tablepers')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection