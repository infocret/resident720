@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Asignar Nueva persona
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => ['relinmp.nstore',$propertyid]]) !!}

                        @include('persona_inmuebles.fieldspn')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
