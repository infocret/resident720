@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Indiviso 1            
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['id' => 'form1','name' => 'form1','route' => 'indivisos.store']) !!}
                        {{-- @include('propertyvalues.fields') --}}
                        @include('inmuindivisos.tableedit') 
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
{{--  *************************************************************************************
      Este script envia a  indivisos.js una variable general , 
      sirve tambien si se desea enviar una variable de session
      <script type="text/javascript">
        var action = '{!! Session::get('personaexpid') !!}';
      </script>   
      ************************************************************************************* --}}    
  <script type="text/javascript">
    var numunids = '{{ $numunids }}';       
  </script> 
@endsection

@section('scripts')
    {{-- Carga el java script de dropdown --}}
    <script src="{{ url('/js/indivisos.js') }}"></script>
@endsection
