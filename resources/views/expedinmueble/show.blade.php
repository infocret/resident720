@extends('layouts.app')

@section('content')


    <section class="content-header">
      <h1>
        Expediente Inmueble
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
          @include('expedinmueble.fieldsnom') 
          <a href="{!! route('inmuebles.index') !!}" class="btn btn-default">Buscar Otro Inmueble</a>
        </div>               
      </div>  <!-- /.box-body -->
    </div> <!-- /.box -->  
  </div>  {{-- Columna izquierda --}}

      
  <div class="col-md-9">  {{-- Columna Tabs  --}}

    <div class="nav-tabs-custom"> {{-- Tabs --}}

      <ul class="nav nav-tabs"> {{-- Lista de tabs --}}
        <li class="active">
           <a href="#unidades" data-toggle="tab">
            <i class="fa fa-home"></i>
            <span>Unidades</span>
          </a>
         </li>
        <li> 
          <a href="#condominos" data-toggle="tab">
            <i class="fa fa-users"></i>
            <span>Condominos</span>
          </a>
        </li>   
        <li> 
          <a href="#indivisos" data-toggle="tab">
            <i>%</i>
            <span>Indivisos</span>
          </a>
        </li>
        <li>
          <a href="#contacto" data-toggle="tab">
             <i class="fa fa-address-card-o"></i>
            <span>Contacto</span>             
          </a>
        </li> 
        <li>
          <a href="#comite" data-toggle="tab">
             <i class="fa fa-black-tie"></i>
            <span>Comite</span>   
          </a>
        </li> 

        {{-- <li><a href="#medcont" data-toggle="tab">Medios de contacto</a></li>  --}}
      </ul>

      <div class="tab-content">  {{--  Div Tabs --}}
        
        <div class="active tab-pane" id="unidades"> {{-- Tab Datos Unidades --}}
          <!-- Post -->
         <div class="post">
                    <div class="clearfix"></div>

                    @include('flash::message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">                           
                             @include('expedinmueble.tableunidades')
                        </div>
                    </div>
                    <div class="text-center">
                    
                    </div>
          </div>
        </div>  {{-- Tab Datos Unidades --}}

           <div class="tab-pane" id="condominos"> {{-- Tab Condominos --}}
          <!-- Post -->
         <div class="post">
                    <div class="clearfix"></div>

                    @include('flash::message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">                           
                             @include('expedinmueble.tablecondominos')
                        </div>
                    </div>
                    <div class="text-center">
                    
                    </div>
          </div>
        </div>  {{-- Tab Condominos --}}

        <div class="tab-pane" id="indivisos"> {{-- Tab indivisos --}}
          <!-- Post -->
         <div class="post">
                    <div class="clearfix"></div>

                    @include('flash::message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">
                              @include('expedinmueble.tableindivisos')
                        </div>
                    </div>
                    <div class="text-center">
                    
                    </div>
          </div>
        </div> {{-- Tab indivisos --}}


        <div class="tab-pane" id="contacto"> {{-- Tab  contacto --}}
          <!-- Post -->
         <div class="post">
                    <div class="clearfix"></div>

                    @include('flash::message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">                            
                          @include('expedinmueble.tableubicaciones')
                          @include('expedinmueble.tablemedcontacto')
                          @include('expedinmueble.tablepersonas')
                        </div>
                    </div>
                    <div class="text-center">
                    
                    </div>
          </div>
        </div>  {{-- Tab contacto --}}

        <div class="tab-pane" id="comite"> {{-- Tab  comite --}}
          <!-- Post -->
         <div class="post">
                    <div class="clearfix"></div>

                    @include('flash::message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">  
                          @include('expedinmueble.tablecomite')
                        </div>
                    </div>
                    <div class="text-center">
                    
                    </div>
          </div>
        </div>  {{-- Tab comite --}}   

         
      </div>  {{--  Div Tabs --}}

    </div> {{-- Tabs --}}
  </div> {{-- Columna Tabs  --}}

   
  </div>  <!-- /.row --> {{-- Renglon principal --}}
     
</section>      <!-- Main content -->
 
@endsection


@section('css')
<link rel="stylesheet" href="{{ url('/css/expedperfil.css') }}">
@endsection
