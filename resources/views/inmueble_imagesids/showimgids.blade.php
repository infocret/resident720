@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Cambiar Imagen de perfil
        </h1>
        <h1 class="pull-right">
          <a class="btn btn-primary pull-right" style="margin-top: -25px;margin-bottom: 5px"
          href="{!! route('propertyexp.index', Session::get('propertyexpid')) !!}">Cancelar</a>
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
               
                
        @foreach($inmuebleImagesids as $imagen)
          <div class="form-group col-sm-2 col-lg-2">
            {{--  {!! Form::open(['route' => ['personamedios.destroy',$inmumedio->id], 'method' => 'delete']) !!}
            <div class='btn-group'> --}}

            <a href="{!! route('imginmu.selimgids',$imagen->id) !!}" class="btn btn-default">
            <img class="profile-user-img img-responsive " 
            src="{!! url(env('PATH_IMGINMU').$imagen->filename )!!}" 
            alt="{!! $imagen->filename!!}" >
            </a>

            {{--  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Esta seguro de eliminar el registro?')"]) !!} --}}
          </div>
        @endforeach
      
     
                </div>
            </div>
        </div>
    </div>
@endsection