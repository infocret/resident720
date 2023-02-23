@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inmumovto
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inmumovto, ['route' => ['inmumovtos.update', $inmumovto->id], 'method' => 'patch']) !!}

                        @include('inmumovtos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection