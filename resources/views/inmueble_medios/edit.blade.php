@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inmueble Medio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inmuebleMedio, ['route' => ['inmuebleMedios.update', $inmuebleMedio->id], 'method' => 'patch']) !!}

                        @include('inmueble_medios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection