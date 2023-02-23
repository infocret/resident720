@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Doc Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($docType, ['route' => ['docTypes.update', $docType->id], 'method' => 'patch']) !!}

                        @include('doc_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection