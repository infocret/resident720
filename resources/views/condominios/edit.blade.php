@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
           Condominio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inmueble, ['route' => ['condominios.update', $inmueble->id], 'method' => 'patch']) !!}

                        @include('condominios.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection