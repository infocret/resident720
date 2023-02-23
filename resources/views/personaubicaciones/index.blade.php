@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Persona Dirs</h1>
        <h1 class="pull-right">       
        <a  style="margin-top: -10px;margin-bottom: 5px;
            margin-left: 10px" 
            href="{!! route('personaubicaciones.create') !!}" 
            class="btn btn-primary pull-right" >
           Add New
        </a>
        {{--
            <a  style="margin-top: -10px;margin-bottom: 5px;
            margin-left: 10px" 
            href="{{ route('personaubicaciones.excell') }}" 
            class="btn btn-primary pull-right">
            Exportar a Excel
        </a> 
        --}}
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('personaubicaciones.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

