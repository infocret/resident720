@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Proveedores
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'proveedor.store']) !!}

                        @include('proveedores.tablecats')

                        @include('proveedores.fields')                      
                    
                    {!! Form::close() !!}
                   
                </div>
            </div>
        </div>
    </div>
@endsection


@section('css')
<link rel="stylesheet" href="{{ url('/css/tablescroll.css') }}">
@endsection


@section('scripts')
    {{-- Carga el java script de checkbox --}}
    <script src="{{ url('/js/checkbox.js') }}"></script>
@endsection



