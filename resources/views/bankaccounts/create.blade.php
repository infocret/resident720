@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
           Cuenta Bancaria
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'bankaccounts.store']) !!}

                        @include('bankaccounts.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
{{--  *************************************************************************************
      Este script permite saber si se llama a  dropdownctas.js desde el create o el edit 
      y pasa una variable general , sirve tambien si se desea enviar una variable de session
      <script type="text/javascript">
        var action = '{!! Session::get('personaexpid') !!}';
      </script>   
      ************************************************************************************* --}}
  <script type="text/javascript">
    var action = 'create';   
    var rutax = '{{ url('/') }}';
  </script>

@endsection


@section('scripts')
    {{-- Carga el java script de checkbookonbank --}}
    <script src="{{ url('/js/checkbookonbank.js') }}"></script>  
@endsection
