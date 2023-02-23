@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Guardar imagen de inmueble
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'imginmu.storeupload']) !!}

                       @include('inmueble_imagesids.fieldsup') 
  

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection