@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
             Subir imagen de perfil
             
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {{-- {!! Form::open(['route' => 'personaImagesids.storeup']) !!} --}}
                    {!! Form::open(['route' => 'personaImagesids.upload',
                    'method'=>'post','files'=>'true','enctype'=>'multipart/form-data']) !!}  
                        {{-- @include('persona_imagesids.fields') --}}
                         @include('persona_imagesids.fieldsupload')

                     {!! Form::close() !!}    
                </div>
            </div>
        </div>
    </div>
@endsection
