@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Anticipo
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($anticipo, ['route' => ['anticipos.update', $anticipo->id], 'method' => 'patch']) !!}

                        @include('anticipos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection