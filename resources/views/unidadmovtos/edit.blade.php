@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Unidadmovto
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($unidadmovto, ['route' => ['unidadmovtos.update', $unidadmovto->id], 'method' => 'patch']) !!}

                        @include('unidadmovtos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection