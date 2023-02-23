@extends('layouts.app')

@section('content')
    <section class="content-header">
<div>
    {{  Form::open(['route' => ['providers.index'], 'method' => 'get'])  }}

        <div class="col-md-4"> 
            <h1 class="pull-left">Proveedores</h1>
        </div>

        <div class="col-md-3" > 
        {!! Form::text('search', null, ['class' => 'form-control', 
        'placeholder'=>'Buscar...']) !!}
        </div> 

        <div class="col-md-1" > 
        <button type='submit' id='search-btn' class="btn btn-flat" >
        <i class="fa fa-search " ></i></button> 
        </div>     

    <div class="col-md-4"> 
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('providers.create') !!}">Agregar</a>
        </h1>
    </div>

    {!! Form::close() !!}
</div>
    </section>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('providers.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

