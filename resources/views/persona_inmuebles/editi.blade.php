@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar Asignación
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($personaInmueble, ['route' => ['relinmpd.expupdate', $personaInmueble->id], 'method' => 'patch']) !!}
                        @include('persona_inmuebles.fieldsedi')
                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection