@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Persona Inmueble
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'personaInmuebles.store']) !!}

                        @include('persona_inmuebles.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
