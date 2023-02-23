@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Areas
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($propertyareas, 
                    ['route' => ['condomareas.update', $propertyareas->id], 'method' => 'patch']) !!}

                        @include('condomareas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection