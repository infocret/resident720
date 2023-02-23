@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Propertyvalue
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($propertyvalue, ['route' => ['propertyvalues.update', $propertyvalue->id], 'method' => 'patch']) !!}

                        @include('propertyvalues.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection