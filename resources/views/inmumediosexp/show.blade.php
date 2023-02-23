@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Medio de contacto de Inmueble
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('inmumediosexp.show_fields')
                    <a href="{!! route('inmumediosexp.index',$inmuid) !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
