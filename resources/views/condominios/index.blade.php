@extends('layouts.app')

@section('content')
    <section class="content-header">

    {{  Form::open(['route' => ['condominios.index'], 'method' => 'get'])  }}

        <div class="col-md-4"> 

        <h1 class="pull-left">Condominios</h1>

        </div>

        <div class="col-md-3" > 
        {!! Form::text('search', null, ['class' => 'form-control', 
        'placeholder'=>'Buscar...','colspan'=>'3']) !!}
        </div>               
        <div class="col-md-1" > 
        <button type='submit' id='search-btn' class="btn btn-flat" colspan="1">
        <i class="fa fa-search " ></i></button> 
        </div>           

        <h1 class="pull-right">
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('condominios.create') !!}">Agregar</a>
        @if (Auth::user()->name == "Julio buendia")
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('condimport.index') !!}">Importar</a>
        @endif
        </h1>
    {!! Form::close() !!}    
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('condominios.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

