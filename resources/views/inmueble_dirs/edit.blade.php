@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inmueble Dir
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inmuebleDir, ['route' => ['inmuebleDirs.update', $inmuebleDir->id], 'method' => 'patch']) !!}

                        @include('inmueble_dirs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection