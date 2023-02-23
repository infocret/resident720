
 {{-- ====================== Catalogos ================================ --}}
 <li class="treeview">
          <a href="#"><i class="fa  fa-database"></i> 
            <span>{{ trans('operaciones.syadmcat') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  
  <ul class="treeview-menu">

        <li class="{{ Request::is('countries*') ? 'active' : '' }}">
          <a href="{!! route('countries.index') !!}">
            <i class="fa fa-map-pin"></i>
            <span>{{ trans('operaciones.paises') }}</span>
          </a>
        </li>

        <li class="{{ Request::is('codPos*') ? 'active' : '' }}">
          <a href="{!! route('codPos.index') !!}">
            <i class="fa fa-envelope-o"></i>
            <span>{{ trans('operaciones.codpos') }}</span>
          </a>
        </li>

        <li class="{{ Request::is('curpestados*') ? 'active' : '' }}">
          <a href="{!! route('curpestados.index') !!}">
            <i class="fa fa-circle-o"></i>
            <span>{{ trans('operaciones.edoscurp') }}</span>
          </a>
        </li>
        {{-- Tipos de Archivos   --}}
        <li class="{{ Request::is('fileTypes*') ? 'active' : '' }}">
          <a href="{!! route('fileTypes.index') !!}">
            <i class="fa fa-file-archive-o"></i>
            <span>{{ trans('operaciones.tfiles') }}</span>
          </a>
        </li>
        {{-- Unidades de medida   --}}
        <li class="{{ Request::is('measurunits*') ? 'active' : '' }}">
            <a href="{!! route('measurunits.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Measurunits</span>
            </a>
        </li>      

        <li class="{{ Request::is('banks*') ? 'active' : '' }}">
            <a href="{!! route('banks.index') !!}">
              <i class="fa fa-bank"></i>
              <span>Bancos</span>
            </a>
        </li>

        <li class="{{ Request::is('banksquares*') ? 'active' : '' }}">
            <a href="{!! route('banksquares.index') !!}">
              <i class="fa fa-map-marker"></i>
              <span>Sucursales</span>
            </a>
        </li>

        <li class="{{ Request::is('currencytypes*') ? 'active' : '' }}">
            <a href="{!! route('currencytypes.index') !!}">
              <i class="fa fa-euro"></i>
              <span>Tipos de Moneda</span>
            </a>
        </li>  

        <li class="{{ Request::is('parameters*') ? 'active' : '' }}">
            <a href="{!! route('parameters.index') !!}">
                <i class="fa fa-edit"></i>
                <span>Inmu Parametros</span>
            </a>
        </li>    

  </ul>
</li>
