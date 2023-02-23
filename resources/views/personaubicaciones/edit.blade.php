@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Persona Dir
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($personaDir, ['route' => ['personaubicaciones.update', $personaDir->id], 'method' => 'patch']) !!}

                        @include('personaubicaciones.fieldsEdit')
                        @include('personaubicaciones.fieldscommon')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
{{--  *************************************************************************************
      Este script permite saber si se llama a  dropdown.js desde el create o el edit 
      y pasa una variable general , sirve tambien si se desea enviar una variable de session
      <script type="text/javascript">
        var action = '{!! Session::get('personaexpid') !!}';
      </script>   
      ************************************************************************************* --}}

  <script type="text/javascript">
    var action = 'edit';
    var rutax = '{{ url('/') }}';
  </script>
@endsection

@section('scripts')
    {{-- Carga el java script de dropdown --}}
     <script src="{{ url('/js/dropsdown.js') }}"></script>
@endsection