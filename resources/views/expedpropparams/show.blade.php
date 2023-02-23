@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Propertyparameter
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('propertyparameters.show_fields')
                    <a href="{!! route('pparams.index') !!}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
