@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Registrar ( Pago / Abono )
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'inmovto.storepay']) !!} 

                        @include('inmumovtos.fieldspay')

                    {!! Form::close() !!} 
                </div> 
            </div>
        </div>
    </div>
@endsection


@section('css')
<link rel="stylesheet" href="{{ url('/css/pdfrecipb.css') }}">
@endsection

