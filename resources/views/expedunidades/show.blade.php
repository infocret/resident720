@extends('layouts.app')

@section('content')


    <section class="content-header">
      <h1>
        Expediente Unidad
      </h1>     
    </section>

<!-- Main content -->
<section class="content">
@include('adminlte-templates::common.errors')

  <div class="row"> {{-- Renglon principal --}}

  <div class="col-md-3"> {{-- Columna izquierda  --}}
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <a href="{!! route('imginmu.add',[$inmueble->id]) !!}" class='btn btn-default btn-xs pull-right' id='newimgid' >
          <i class="fa fa-camera"></i>
        </a>
        <a href="{!! route('imginmu.showimgids',[$inmueble->id]) !!}" class='btn btn-default btn-xs pull-left' id='newimgid' >
          <i class="fa fa-folder"></i>
        </a>
        <img class="profile-user-img img-responsive img-circle" 
        src="{!! url(env('PATH_IMGINMU').$imgfilenam) !!}" 
        alt="{!! url(env('PATH_IMGINMU').$imgfilenam) !!}"
        >       
        <div class="form-group col-sm-4">              
        </div>          
        {{-- JB: se agrego esto para traer datos de la persona --}}
        <div class="row" style="padding-left: 20px">
          @include('expedunidades.fieldsnom') 
          {{-- <a href="{!! route('condominios.index') !!}" class="btn btn-default">Otra Unidad</a> --}}
        </div>               
      </div>  <!-- /.box-body -->
    </div> <!-- /.box -->  
  </div>  {{-- Columna izquierda --}}

      
  <div class="col-md-9">  {{-- Columna Tabs  --}}

    <div class="nav-tabs-custom"> {{-- Tabs --}}

      <ul class="nav nav-tabs"> {{-- Lista de tabs --}}
        <li>
          <a href="#contacto" data-toggle="tab">
             <i class="fa fa-address-card-o"></i>
            <span>Contacto</span>             
          </a>
        </li> 

        <li> 
          <a href="#indivisos" data-toggle="tab">
            <i>%</i>
            <span>Indivisos</span>
          </a>
        </li>       
            
      </ul>

      <div class="tab-content">  {{--  Div Tabs --}}

        <div class="active tab-pane" id="contacto"> {{-- Tab  contacto --}}
          <!-- Post -->
         <div class="post">
                    <div class="clearfix"></div>

                    @include('flash::message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">  
                          @include('expedunidades.tablepersonas')
                        </div>
                    </div>
                    <div class="text-center">
                    
                    </div>
          </div>
        </div>  {{-- Tab contacto --}}

        <div class="tab-pane" id="indivisos"> {{-- Tab indivisos --}}
          <!-- Post -->
         <div class="post">
                    <div class="clearfix"></div>

                    @include('flash::message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">
                              @include('expedunidades.tableindivisos')
                        </div>
                    </div>
                    <div class="text-center">
                    
                    </div>
          </div>
        </div> {{-- Tab indivisos --}}

      </div>  {{--  Div Tabs --}}

    </div> {{-- Tabs --}}
  </div> {{-- Columna Tabs  --}}

   
  </div>  <!-- /.row --> {{-- Renglon principal --}}
     
</section>      <!-- Main content -->
 
@endsection


@section('css')
<link rel="stylesheet" href="{{ url('/css/expedperfil.css') }}">
@endsection
