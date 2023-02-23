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
                   {!! Form::model($personaDir, ['route' => ['personaDirs.update', $personaDir->id], 'method' => 'patch']) !!}

                        @include('persona_dirs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection