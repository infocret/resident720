@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Presupuesto
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['id'=>'form1','route' => 'presup.store']) !!}
                        
                         @include('expedpresupuestos.tableedit')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
{{--  *************************************************************************************
      Este script permite enviar una variable de session
      <script type="text/javascript">
        var action = '{!! Session::get('personaexpid') !!}';
      </script>   
      <script type="text/javascript">
        var numunids = '{{ $numunids }}';       
      </script> 
      ************************************************************************************* --}}    
  
@endsection

@section('scripts')
    {{-- Carga el java script de dropdown --}}
    <script src="{{ url('/js/presup.js') }}"></script>
@endsection
