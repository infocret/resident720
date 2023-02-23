@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Datos de Cuenta
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('condomaccounts.show_fields')
                    <a href="{!! route('condomaccounts.index',$inmuid) !!}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ url('/css/personaubicshow.css') }}">
@endsection