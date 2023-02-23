@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Propertycontractservice
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'propertycontractservices.store']) !!}

                        @include('propertycontractservices.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
