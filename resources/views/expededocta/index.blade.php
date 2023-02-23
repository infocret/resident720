@extends('layouts.app')

@section('content')
    
    <section class="content-header">    
    <div class="col-sm-10">
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
    {{ $cservi }}    
    </p> 
    </div>
    <div class="col-sm-2">        
        <a class="btn btn-primary pull-right" 
        style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
        href="{!! route('edoscta.selperiod', [$condomid]) !!}" >Volver</a>    
    </div>       
    </section>  
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('expededocta.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

