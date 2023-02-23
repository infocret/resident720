@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Stockmovement
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($stockmovement, ['route' => ['stockmovements.update', $stockmovement->id], 'method' => 'patch']) !!}

                        @include('stockmovements.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection