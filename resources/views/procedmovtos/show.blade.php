@extends('layouts.app')

@section('content')
    <section class="content-header">

        <h1 class="pull-left">
            Registro de procedimiento
        </h1>
        
        <h1 class="pull-right">

        

         @if ($origen == 'EXECSP') {{-- para Ejecutar --}}

                <a class="btn btn-default" 
                style="margin-top: -10px;margin-bottom: 5px;margin-left: 5px"  
                href="{!! route('procedmovtos.index') !!}">Cancelar</a>

                <a class="btn btn-primary pull-right" 
                style="margin-top: -10px;margin-bottom: 5px;margin-left: 5px" 
                href="{!! route('procedmovtos.ejecutasp', [$procedmovto->id]) !!}">Ejecutar</a>

         @endif

         @if ($origen == 'REPROG') {{-- para Reprogramar --}}        
           
                {!! Form::open(['route' => ['procedmovtos.programar'],
                    'method'=>'post']) !!}
                
                {!! csrf_field() !!}  
                
                {!! Form::hidden('id', $procedmovto->id, 
                ['class' => 'form-control','readonly'=>'readonly']) !!}

                <a class="btn btn-default" 
                style="margin-top: -10px;margin-bottom: 5px;margin-left: 5px"  
                href="{!! route('procedmovtos.index') !!}">Cancelar</a>

                {!! Form::label('tlabel', 'Fecha:') !!}
{{-- 
                 {!! Form::date('datexec',  $fecha , 
                 ['required' => 'required','value'=>$fecha,'min'=>$fecha,'max'=>'2050-12-31']) !!} --}}

                {!! Form::date('dfecha', $fecha , ['required' => 'required']) !!}

                {!! Form::submit('Programar', ['class' => 'btn btn-primary', 
                'style' => 'margin-top: -10px;margin-bottom: 5px;margin-left: 5px' ]) !!}

                {!! Form::close() !!}
         @endif
        
        @if (isset($origen)&& !empty($origen)) {{-- para Show --}}
                <a class="btn btn-default" 
                style="margin-top: -10px;margin-bottom: 5px;margin-left: 5px"  
                href="{!! route('procedmovtos.index') !!}">Cancelar</a>
        @endif

        </h1>
      

    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')

         <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('procedmovtos.show_fields')
                   
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css') {{-- Carga estilos --}}
<link rel="stylesheet" href="{{ url('/css/egresos.css') }}">
@endsection