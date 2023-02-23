@extends('layouts.app')

@section('content')
    <section class="content-header">
        @if($cuotedit == "1")
           <h1 class="pull-left">Cuotas</h1>
        @else
          <h1 class="pull-left">Cuotas - (No Editable)</h1>
        @endif
        <h1 class="pull-right"> 
           {!! Form::label('tpresup', 
           'Presupuesto: $ '.
           number_format($presupuesto, 2, '.', ',').
           ' - Cuotas: $ '.
           number_format($tcuotas, 2, '.', ',')
           ) !!}
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('inmuindivisos.tablec')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection