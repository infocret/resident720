{{-- ======================== EXPEDIENTE INMUEBLE ============================== --}}

@if(Session::has('propertyexpid'))   

        <div class="user-panel">
            <div class="pull-left image">
               
                <img src="{!! url(env('PATH_IMGINMU').session::get('imgeinmuexp') ) !!}" class="img-circle"
                     alt="img"/>
            </div>
            <div class="pull-left info">
           <p>{!! session::get('propnomexp') !!}</p> {{-- Obtiene nombre de var de session --}}
               {{--  @if (Auth::guest())
                <p>Visitante</p>
                @else
                    <p>{{ Auth::user()->name}}</p>
                @endif --}}
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Inmueble</a>
            </div>
        </div>
{{-- @endif

@if(Session::has('propertyexpid'))   --}} 

{{-- {{ dd(session::get('personaexpid')) }}  --}}
   {{ $propertyexpid=Session::get('propertyexpid') }} {{-- Asigna variable --}}
    {{-- Route::resource('expedpersonas', 'expedpersonaController');  --}}
    <li class="treeview">
        <a href="#"><i class="fa fa-folder-open-o  text-yellow"></i> 
          <span>{{ trans('operaciones.expediente') }}</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i> 
          </span>
        </a>  
    <ul class="treeview-menu">      

    <li class="{{ Request::is('propertyexp*') ? 'active' : '' }}">
        <a href="{!! route('propertyexp.index',$propertyexpid) !!}">
          <i class="fa fa-archive"></i>
          <span>Datos Generales</span>
        </a>
    </li>   

    <li class="{{ Request::is('unidades*') ? 'active' : '' }}">
        <a href="{!! route('unidades.index') !!}">
          <i class="fa fa-home"></i>
          <span>Unidades</span>
        </a>
    </li>  

    {{-- <li><a href="/personamedios/1">Medios de Contacto</a></li> --}}    
    <li class="{{ Request::is('inmumedioexp*') ? 'active' : '' }}">
        <a href="{!! route('inmumediosexp.index') !!}">
          <i class="fa fa-phone"></i>
          <span>{{ trans('operaciones.medcont') }}</span>
        </a>
    </li>

    <li class="{{ Request::is('inmubicaciones*') ? 'active' : '' }}">
        <a href="{!! route('inmubicaciones.index') !!}">
          <i class="fa fa-map-marker"></i>
          <span>{{ trans('operaciones.ubic') }}</span>
        </a>
    </li>

     <li class="{{ Request::is('relinmp*') ? 'active' : '' }}">
        <a href="{!! route('relinmp.expinmuindex',$propertyexpid) !!}">
          <i class="fa fa-users"></i>
          <span>Personas Asignadas</span>
        </a>
    </li> 

  
    <li class="{{ Request::is('indivisos*') ? 'active' : '' }}">
    <a href="{!! route('indivisos.index') !!}">
      <i>%</i>
      <span>Indivisos</span>
    </a>
    </li>
    
    <li class="{{ Request::is('propertyareas*') ? 'active' : '' }}">
      <a href="{!! route('propertyareas.index') !!}">
        <i class="fa fa-delicious"></i>
        <span>Areas</span>
      </a>
    </li>

    <li class="{{ Request::is('propaccounts*') ? 'active' : '' }}">
      <a href="{!! route('propaccounts.inmuindex',$propertyexpid) !!}">
        <i class="fa fa-cc-visa"></i>
        <span>Cuentas Bancarias</span>
      </a>
    </li>

    <li class="{{ Request::is('propertycontractservices*') ? 'active' : '' }}">
            <a href="{!! route('propertycontractservices.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Propertycontractservices</span>
            </a>
    </li>

    <li class="{{ Request::is('propertyexp*') ? 'active' : '' }}">
        <a href="{!! route('propertyexp.close') !!}">
          <i class="glyphicon glyphicon-new-window"></i>
          <span>{{ trans('operaciones.cerrar') }}</span>
        </a>
    </li>  

  </ul>
  </li>
@else
@endif
