@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Anticiposapli
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($anticiposapli, ['route' => ['anticiposaplis.update', $anticiposapli->id], 'method' => 'patch']) !!}

                        @include('anticiposaplis.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection