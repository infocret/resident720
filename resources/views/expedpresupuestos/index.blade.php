@extends('layouts.app')

@section('content')
    <section class="content-header">
        @if($editpre == "1")
          <h1 class="pull-left">Presupuesto</h1>
        @else
          <h1 class="pull-left">Presupuesto - (No Editable)</h1>
        @endif

        <h1 class="pull-right"> 
           {!! Form::label('tpresup', 'Total :$ '.number_format($totpre, 2, '.', ',')) !!} 
           @if ($editpre == "1")             
             <a class="btn btn-primary pull-right" 
             style="margin-left: 20px;margin-top: -10px;margin-bottom: 5px" 
             href="{!! route('presup.create',$inmuid) !!}">Modificar</a>
           @endif
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                     @include('expedpresupuestos.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection