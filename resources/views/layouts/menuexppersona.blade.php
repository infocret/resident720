{{-- ======================== EXPEDIENTE PERSONA ============================== --}}

@if(Session::has('personaexpid'))   

        <div class="user-panel">
            <div class="pull-left image">
               
                <img src="{!! url(env('PATH_IMGIDS').session::get('imgeidexp') ) !!}" class="img-circle"
                     alt="img"/>
            </div>
            <div class="pull-left info">
           <p>{!! session::get('nomexp') !!}</p> {{-- Obtiene nombre de var de session --}}
               {{--  @if (Auth::guest())
                <p>Visitante</p>
                @else
                    <p>{{ Auth::user()->name}}</p>
                @endif --}}
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Exped Persona</a>
            </div>
        </div>
{{-- @endif

@if(Session::has('personaexpid'))    --}}
{{-- {{ dd(session::get('personaexpid')) }}  --}}
   {{ $personaexpid=Session::get('personaexpid') }} {{-- Asigna variable --}}
    {{-- Route::resource('expedpersonas', 'expedpersonaController');  --}}
    <li class="treeview">
        <a href="#"><i class="fa fa-folder-open-o  text-yellow"></i> 
          <span>{{ trans('operaciones.expedp') }}</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i> 
          </span>
        </a>  
    <ul class="treeview-menu">
    {{-- <li><a href="/personaexp/1">Perfil</a></li>  --}}
    <li class="{{ Request::is('personaexp*') ? 'active' : '' }}">
        <a href="{!! route('personaexp.index',$personaexpid) !!}">
          <i class="fa fa-user"></i>
          <span>{{ trans('operaciones.perfil') }}</span>
        </a>
    </li>    

    {{-- <li><a href="/personamedios/1">Medios de Contacto</a></li> --}}    
    <li class="{{ Request::is('personamedios*') ? 'active' : '' }}">
        <a href="{!! route('personamedios.index') !!}">
          <i class="fa fa-phone"></i>
          <span>{{ trans('operaciones.medcont') }}</span>
        </a>
    </li>

    {{-- --}}    
    <li class="{{ Request::is('personaubicaciones*') ? 'active' : '' }}">
        <a href="{!! route('personaubicaciones.index') !!}">
          <i class="fa fa-map-marker"></i>
          <span>{{ trans('operaciones.ubic') }}</span>
        </a>
    </li>

    <li class="{{ Request::is('RelPerInmu*') ? 'active' : '' }}">
        <a href="{!! route('relperinmu.expindex',$personaexpid) !!}">
          <i class="fa fa-home"></i>
          <span>{{ trans('operaciones.asigpinmu') }}</span>
        </a>
    </li>

{{--     Esta opercaion es la que presenta la relacion de categorias de servicio a provvedores --}}
{{-- 
<li class="{{ Request::is('proveedor*') ? 'active' : '' }}">
      <a href="{!! route('proveedor.index',$personaexpid) !!}">
        <i class="fa fa-handshake-o"></i>
        <span>Rel persona proveedor</span>
      </a>
    </li>  
--}} 

    <li class="{{ Request::is('personaexp*') ? 'active' : '' }}">
        <a href="{!! route('personaexp.close') !!}">
          <i class="glyphicon glyphicon-new-window"></i>
          <span>{{ trans('operaciones.cerrar') }}</span>
        </a>
    </li> 

  </ul>
  </li>
@else
@endif
