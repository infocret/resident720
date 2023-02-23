@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Guardar imagen de perfil
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'personaImagesids.storeupload']) !!}

                       @include('persona_imagesids.fieldsup') 
  

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
