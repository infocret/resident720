@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Area
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('condomareas.show_fields')
                    <a href="{!! route('condomareas.index',$inmuid) !!}" class="btn btn-default">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
