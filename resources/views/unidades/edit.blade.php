@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar Unidad
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inmueble, ['route' => ['unidades.update', $inmueble->id], 'method' => 'patch']) !!}

                        @include('unidades.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection