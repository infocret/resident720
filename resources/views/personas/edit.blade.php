@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Persona
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($persona, ['route' => ['personas.update', $persona->id,$orig], 'method' => 'patch']) !!}
                        @include('personas.fields')
                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@section('scripts')
    {{-- Carga el java script para generar CURP y RFC --}}
    <script src="{{ url('/js/persona.js') }}"></script>
@endsection