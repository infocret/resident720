@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Correo de lista de correos
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($maillist, ['route' => ['correolist.update', $maillist->id,$inmuid], 'method' => 'patch']) !!}

                        @include('condomcorreos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection