@extends('layouts.app')

@section('content')
    <section class="content-header">
    {{-- Si se desea usar los fitros de valores para cada campo --}}
             
        {!! Form::open(['route' => ['codPos.index'], 'method' => 'get']) !!}
            <div class="col-md-4"> 
                <h1 class="pull-left">Codigos Postales</h1>    
            </div>
            
            <div class="col-md-3" > 
                {!! Form::text('search', null, ['class' => 'form-control', 
                'placeholder'=>'Buscar...','colspan'=>'3']) !!}
            </div> 
              
            <div class="col-md-1" > 
                <button type='submit' id='search-btn' class="btn btn-flat" colspan="1">
                <i class="fa fa-search " ></i></button> 
            </div>

            <div class="col-md-3"> 
                <h1 class="pull-right">
               {{--  <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom:5px" 
                href="{!! route('codPos.create') !!}">Agregar</a>  --}}
                 {{-- <a class="btn btn-primary pull-right" style="margin-top: 0px;margin-bottom:0px" 
                href="{!! route('codPos.create') !!}">Agregar</a>  --}}
                </h1> 
            </div>
        {!! Form::close() !!}
   
    {{-- Fin  Si se desea usar los fitros de valores para cada campo --}}

    {{-- Si se desea usar el campo de busqueda general --}}
{{--         <table class="table table-responsive" id="head">   
        <thead>
        <tr>
             {!! Form::open(['route' => ['codPos.index'], 'method' => 'get']) !!}
            <th colspan="3">
              Codigos Postales 
            </th>
            <th>{!! Form::text('search', null, ['class' => 'form-control', 'placeholder'=>'Buscar...',
            'colspan'=>'3']) !!}</th>
            <th> 
            <button type='submit' id='search-btn' class="btn btn-flat" colspan="1">
            <i class="fa fa-search"></i></button> 
            </th>       
            <th>                 
                <a class="btn btn-primary pull-right" colspan="3" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('codPos.create') !!}">Agregar</a>              
                
            </th>  
            {!! Form::close() !!}
        </tr> 
        </thead>       
        </table> --}}
{{--  FIn si desea usar el campo de busqueda general --}}
                
   {{--      <h1 class="pull-left">Cod Pos</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('codPos.create') !!}">Add New</a>
        </h1> --}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('cod_pos.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

