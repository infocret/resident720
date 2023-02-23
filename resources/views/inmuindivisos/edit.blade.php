@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
           Indivisos de Unidad{{ " : ".$unidcve."-".$unidnom }}   
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($propertyvalue, 
                    ['route' => ['indivisos.update', $propertyvalue->id,$inmuid], 'method' => 'patch']) !!}

                        @include('inmuindivisos.fields') 
                        

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection