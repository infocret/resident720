@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Persona Document
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($personaDocument, ['route' => ['personaDocuments.update', $personaDocument->id], 'method' => 'patch']) !!}

                        @include('persona_documents.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection