@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            {{ 'Pagos de '.$charge->unidcve.'-'.$charge->unidname.
            ' por '.$charge->chrcve.'-'.$charge->chrdesc}}
        </h1>

        <h1 class="pull-right">
        <a class="btn btn-primary pull-right" 
        style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
        href="{!! route('cpay.indexb', $charge->unidid ) !!}" >Volver</a>
        </h1>
        
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('expedpay.tabled')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

