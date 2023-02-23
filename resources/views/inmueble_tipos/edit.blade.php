@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inmueble Tipo
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inmuebleTipo, ['route' => ['inmuebleTipos.update', $inmuebleTipo->id], 'method' => 'patch']) !!}

                        @include('inmueble_tipos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection