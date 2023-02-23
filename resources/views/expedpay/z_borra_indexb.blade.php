@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{{ 'Pagos Registrados a'}}</h1>
        <h1 class="pull-left"><b><i>{{ ': '.$unidadn }}</i></b></h1>

        <h1 class="pull-right">
        <a class="btn btn-primary pull-right" 
        style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
        href="{!! route('cpay.index') !!}" >Volver</a>
        </h1>
        
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('expedpay.tableb')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection
