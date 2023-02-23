@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ficha de Proveedor
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">                   
                    @include('providers.show_fields')
                    <a href="{!! route('providers.index') !!}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('css') {{-- Carga estilos --}}
<link rel="stylesheet" href="{{ url('/css/egresos.css') }}">
@endsection