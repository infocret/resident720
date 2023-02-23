@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Cambiar Imagen de perfil
        </h1>
        <h1 class="pull-right">
          <a class="btn btn-primary pull-right" style="margin-top: -25px;margin-bottom: 5px"
          href="{!! route('personaexp.index', Session::get('personaexpid')) !!}">Cancelar</a>
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                {{--  @include('persona_imagesids.show_fields')     --}}
                
        @foreach($personaImagesids as $imagen)
          <div class="form-group col-sm-2 col-lg-2">
        <a href="{!! route('personaImagesids.selimgids',$imagen->id) !!}" class="btn btn-default">
            <img class="profile-user-img img-responsive " 
            src="{!! url(env('PATH_IMGIDS').$imagen->filename )!!}" 
            alt="{!! $imagen->filename!!}" >
        </a>
          </div>
        @endforeach
      
     
                </div>
            </div>
        </div>
    </div>
@endsection