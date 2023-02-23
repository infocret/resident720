@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Aplicación de Cheque
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('checkissuances.show_fields')
                    <a href="{!!url()->previous() !!}" class="btn btn-default">Regresar</a>
                    <a href="{!! route('checkissuances.edit', [$checkissuance->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css') {{-- Carga estilos --}}
<link rel="stylesheet" href="{{ url('/css/egresos.css') }}">
@endsection