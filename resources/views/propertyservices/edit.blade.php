@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Propertyservice
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($propertyservice, ['route' => ['propertyservices.update', $propertyservice->id], 'method' => 'patch']) !!}

                        @include('propertyservices.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection