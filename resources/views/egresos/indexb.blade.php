@extends('layouts.app')

@section('content')
    
    <section class="content-header">    
    <div>
    <p style="     
    background-color: rgb(221, 221, 221);
    padding: 2px;
    opacity: 1;
    font-size: 12pt;
    color: rgb(136, 136, 136);
    text-align: left;
    font-family: Verdana, Geneva, sans-serif;
    font-style: italic;
    font-weight: bold;
    ">
    Lista de Egresos 
    </p> 
        <a class="btn btn-default pull-right"
        href="{!! route('egresos.selperiod',[$condomid]) !!}" >
        Cancelar
        </a> 
      <a class="btn btn-primary pull-right"          
        href="{!! route('egreso.create',$condomid) !!}"
        style="margin-right: 10px;" >
        Agregar
      </a>

    </div>       
    </section>  
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('egresos.tableb')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

