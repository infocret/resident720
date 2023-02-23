@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Registrar Anticipo
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'anticipos.store']) !!}

                        @include('anticipos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
{{--  *************************************************************************************
      Este script permite saber si se llama a  anticipos.js desde el create o el edit 
      y pasa una variable general , sirve tambien si se desea enviar una variable de session
      ************************************************************************************* --}}
  <script type="text/javascript">
    var action = 'create';   
    var rutax = '{{ url('/') }}';
  </script>

@endsection


@section('scripts')
    {{-- Carga el java script  --}}
    <script src="{{ url('/js/anticipos.js') }}"></script>
@endsection

