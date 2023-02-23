@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
          Categoría
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($provcats, ['route' => ['provcats.update', $provcats->id], 'method' => 'patch']) !!}

                        @include('provcats.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection