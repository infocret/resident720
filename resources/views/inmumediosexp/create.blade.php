@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Medio de Contacto de Inmueble
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'inmumediosexp.store']) !!}

                        @include('inmumediosexp.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
