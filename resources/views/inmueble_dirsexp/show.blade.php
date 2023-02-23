@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ubicación - {!! $inmuDir->pais !!} - {!! $inmuDir->nombre !!}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('inmueble_dirsexp.show_fields')
                    <a href="{!! route('inmubicaciones.index',$inmuid) !!}" class="btn btn-default">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ url('/css/personaubicshow.css') }}">
@endsection