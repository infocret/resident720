
{{-- ====================Operaciones  ================================== --}}
<li class="header">
 <i class="fa fa-list-ul"></i>{{"     " . trans('operaciones.menu') }}</li>

{{-- 
<li>
  <a href="{{ url('/dashboard') }}">
    <i class="fa fa-tachometer "></i>
    <span>{{ trans('operaciones.tablero') }}</span>
  </a>
</li> 
--}}

  {{-- ====================================================== --}}

<li class="treeview">
          <a href="#"><i class="fa  fa-cog"></i> 
            <span>{{ trans('operaciones.administracion') }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  

  <ul class="treeview-menu">

{{--         <li class="{{ Request::is('condominios*') ? 'active' : '' }}">
          <a href="{!! route('condominios.index') !!}">
            <i class="fa fa-building-o"></i>
            <span>{{ trans('operaciones.condominios') }}</span>
          </a>
        </li>   --}}  

        <li class="{{ Request::is('condominios*') ? 'active' : '' }}">
          <a href="{!! route('condominios.list',[env('CONDOMID', '0')]) !!}">
            <i class="fa fa-building-o"></i>
            <span>{{ trans('operaciones.condominios') }}</span>
          </a>
        </li>    

        <li class="{{ Request::is('personas*') ? 'active' : '' }}">
          <a href="{!! route('personas.index') !!}">
            <i class="fa fa-users"></i>
            <span>{{ trans('operaciones.personas') }}</span>
          </a>
        </li>             
        <li class="{{ Request::is('providers*') ? 'active' : '' }}">
            <a href="{!! route('providers.index') !!}">
              <i class="fa fa-handshake-o"></i>
              <span>{{ trans('operaciones.proveedores') }}</span>
            </a>
        </li>

  </ul>
</li>
