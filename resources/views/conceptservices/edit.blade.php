@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Conceptservice
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($conceptservice, ['route' => ['conceptservices.update', $conceptservice->id], 'method' => 'patch']) !!}

                        @include('conceptservices.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection