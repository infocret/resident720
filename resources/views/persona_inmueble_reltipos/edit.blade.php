@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Persona Inmueble Reltipo
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($personaInmuebleReltipo, ['route' => ['personaInmuebleReltipos.update', $personaInmuebleReltipo->id], 'method' => 'patch']) !!}

                        @include('persona_inmueble_reltipos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection