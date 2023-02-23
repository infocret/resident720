 
@extends('layouts.app')

@section('content')
    <section class="content-header">

        <h1 class="pull-left">Estado de Cuenta</h1>

        <h1 class="pull-right">
        <a class="btn btn-primary pull-right" 
        style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
        href="{!! url()->previous() !!}" >Volver</a>        
        </h1>
        
        @if ($exists)

          <h1 class="pull-right">
          <a class="btn btn-primary pull-right"            
          style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
          href="{{ url($filepath.$filename) }}" target="_blank">
           Ver PDF
          </a>
          </h1>

          <h1 class="pull-right">
          <a class="btn btn-primary pull-right" 
          style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
          href="{{ url($filepath.$filename) }}" download="{{ $filename }}">Descargar PDF</a>
          </h1> 

        @else  

          <h1 class="pull-right">
             <a class="btn btn-primary pull-right" 
             style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
             href="{!! route('edoscta.showpdf', [$charge->chrid,0]) !!}" target="blank" >
              Ver PDF
             </a>
          </h1>

          <h1 class="pull-right">
            {{-- 
             <a class="btn btn-primary pull-right" 
             style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
             href="{!! route('edoscta.dnlwpdf', [$charge->chrid,1]) !!}">Descargar PDF</a>
              --}}
              <a class="btn btn-primary pull-right" 
             style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
             href="{!! route('edoscta.showpdf', [$charge->chrid,1]) !!}">Descargar PDF</a>
          </h1>        

        @endif  

        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" 
           style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
           href="{!! route('edoscta.mailpdf', [$charge->chrid]) !!}">Enviar PDF por Correo</a>
        </h1>     

        @if ($charge->balance > 0)
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" 
           style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
           href="{!! route('inmovto.createpay', [$charge->chrid]) !!}">Registrar Pago</a>
        </h1>   
        @endif  
              
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('expededocta.movtobt')                   
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection


@section('css')
<link rel="stylesheet" href="{{ url('/css/pdfrecipb.css') }}">
@endsection

