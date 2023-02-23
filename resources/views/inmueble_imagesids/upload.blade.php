@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
             Subir imagen de identificacion de Inmueble
             
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">                   
                    {!! Form::open(['route' => 'imginmu.upload',
                    'method'=>'post','files'=>'true','enctype'=>'multipart/form-data']) !!}  
                        {{-- @include('persona_imagesids.fields') --}}
                         @include('inmueble_imagesids.fieldsupload')

                     {!! Form::close() !!}    
                </div>
            </div>
        </div>
    </div>
@endsection