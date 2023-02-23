@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Indiviso
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($propertyparameter, ['route' => ['indivisos.update', $propertyparameter->id], 'method' => 'patch']) !!}

                        @include('indivisos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection