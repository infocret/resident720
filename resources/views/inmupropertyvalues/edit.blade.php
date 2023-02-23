@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
           Datos y Valores de Unidad{{ " : ".$unidcve."-".$unidnom }}   
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($propertyvalue, 
                    ['route' => ['ivalues.update', $propertyvalue->id,$inmuid], 'method' => 'patch']) !!}

                        @include('inmupropertyvalues.fieldsb')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection