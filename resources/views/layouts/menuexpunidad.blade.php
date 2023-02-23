{{-- ======================== EXPEDIENTE CONDOMINIO ============================== --}}

@if(Session::has('unidadexpid'))   

        <div class="user-panel">
            <div class="pull-left image">
               
                <img src="{!! url(env('PATH_IMGINMU').session::get('imgunidexp') ) !!}" class="img-circle"
                     alt="img"/>
            </div>
            <div class="pull-left info">
           <p>{!! session::get('unidnomexp') !!}</p> {{-- Obtiene nombre de var de session --}}
               {{--  @if (Auth::guest())
                <p>Visitante</p>
                @else
                    <p>{{ Auth::user()->name}}</p>
                @endif --}}
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Unidad</a>
            </div>
        </div>

   {{ $unidadexpid=Session::get('unidadexpid') }} {{-- Asigna variable --}}

    <li class="treeview">
        <a href="#"><i class="fa fa-folder-open-o  text-yellow"></i> 
          <span>{{ trans('operaciones.expediente') }}</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i> 
          </span>
        </a>  
    <ul class="treeview-menu">      

    <li class="{{ Request::is('expunidad*') ? 'active' : '' }}">
        <a href="{!! route('expunidad.index',$unidadexpid) !!}">
          <i class="fa fa-archive"></i>
          <span>Datos Generales</span>
        </a>
    </li>     
   
     <li class="{{ Request::is('relinmp*') ? 'active' : '' }}">
        <a href="{!! route('relinmp.expinmuindex',$unidadexpid) !!}">
          <i class="fa fa-users"></i>
          <span>Personas Asignadas</span>
        </a>
    </li> 

  
    <li class="{{ Request::is('indivisosu*') ? 'active' : '' }}">
    <a href="{!! route('indivisosu.index',$unidadexpid) !!}">
      <i>%</i>
      <span>Indivisos</span>
    </a>
    </li>   
   
   
       <li class="{{ Request::is('expunidad*') ? 'active' : '' }}">
        <a href="{!! route('expunidad.close') !!}">
          <i class="glyphicon glyphicon-new-window"></i>
          <span>{{ trans('operaciones.cerrar') }}</span>
        </a>
    </li>  

  </ul>
  </li>
@else
@endif
