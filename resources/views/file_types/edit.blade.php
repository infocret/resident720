@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            File Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($fileType, ['route' => ['fileTypes.update', $fileType->id], 'method' => 'patch']) !!}

                        @include('file_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection