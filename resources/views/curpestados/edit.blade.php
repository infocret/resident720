@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Curpestados
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($curpestados, ['route' => ['curpestados.update', $curpestados->id], 'method' => 'patch']) !!}

                        @include('curpestados.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection