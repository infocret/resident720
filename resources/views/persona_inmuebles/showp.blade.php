@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Persona Inmueble
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('persona_inmuebles.showp_fields')
                    <a href="{!! route('relperinmu.expindex',$personaexpid) !!}" class="btn btn-default">Atras</a>
                </div>
            </div>
        </div>
    </div>
@endsection
