@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Storage
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($storage, ['route' => ['storages.update', $storage->id], 'method' => 'patch']) !!}

                        @include('storages.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection