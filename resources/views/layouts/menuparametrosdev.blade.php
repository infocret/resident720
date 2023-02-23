{{-- ================= Parametros ===================================== --}}
 <li class="treeview">
          <a href="#"><i class="fa  fa-wrench"></i> 
            <span>{{ trans('operaciones.syadmparam').'-Dev' }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  
  <ul class="treeview-menu">
      
        <li class="{{ Request::is('inmuebleTipos*') ? 'active' : '' }}">
          <a href="{!! route('inmuebleTipos.index') !!}">
            <i class="fa fa-home"></i>
            <span>{{ trans('operaciones.tinmu') }}</span>
          </a>
        </li>

        <li class="{{ Request::is('locations*') ? 'active' : '' }}">
          <a href="{!! route('locations.index') !!}">
            <i class="fa fa-location-arrow"></i> 
            <span>{{ trans('operaciones.tubic') }}</span>
          </a>
        </li>

        <li class="{{ Request::is('medios*') ? 'active' : '' }}">
          <a href="{!! route('medios.index') !!}">
            <i class="fa fa-phone"></i>
            <span>{{ trans('operaciones.tmed') }}</span>
          </a>
        </li>

        {{-- Tipo de relación / persona a una propiedad --}}
        <li class="{{ Request::is('personaInmuebleReltipos*') ? 'active' : '' }}">
          <a href="{!! route('personaInmuebleReltipos.index') !!}">
            <i class="fa fa-flask"></i>
            <span>{{ trans('operaciones.trelpersinmu') }}</span>
          </a>
        </li>

        {{-- Tipos de Documentos --}}
        <li class="{{ Request::is('docTypes*') ? 'active' : '' }}">
          <a href="{!! route('docTypes.index') !!}">
            <i class="fa fa-credit-card"></i>
            <span>{{ trans('operaciones.tdocs') }}</span>
          </a>
        </li>

        {{-- Documentos requeridos / propiedad  --}}
        <li class="{{ Request::is('persInmuReltipoReqDocs*') ? 'active' : '' }}">
          <a href="{!! route('persInmuReltipoReqDocs.index') !!}">
            <i class="fa fa-check-square-o"></i>
            <span>{{ trans('operaciones.docreqprop') }}</span>
          </a>
        </li>

        {{-- Tipos de Movimientos   --}}
        <li class="{{ Request::is('movimientoTipos*') ? 'active' : '' }}">
          <a href="{!! route('movimientoTipos.index') !!}">
            <i class="fa fa-edit"></i>
            <span>Tipos de Movimientos</span>
          </a>
        </li>

        <li class="{{ Request::is('provcats*') ? 'active' : '' }}">
            <a href="{!! route('provcats.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Categorias Proveedor</span>
            </a>
        </li>  
  
        <li class="{{ Request::is('bankaccounts*') ? 'active' : '' }}">
            <a href="{!! route('bankaccounts.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Bankaccounts</span>
            </a>
        </li>

        <li class="{{ Request::is('checkbooks*') ? 'active' : '' }}">
            <a href="{!! route('checkbooks.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Checkbooks</span>
            </a>
        </li>

        <li class="{{ Request::is('contracts*') ? 'active' : '' }}">
            <a href="{!! route('contracts.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Contracts</span>
            </a>
        </li>
      
        <li class="{{ Request::is('services*') ? 'active' : '' }}">
            <a href="{!! route('services.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Services</span>
            </a>
        </li>

        <li class="{{ Request::is('propertyservices*') ? 'active' : '' }}">
            <a href="{!! route('propertyservices.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Propertyservices</span>
            </a>
        </li>

        <li class="{{ Request::is('procedmovtos*') ? 'active' : '' }}">
            <a href="{!! route('procedmovtos.index') !!}">
              <i class="fa fa-edit"></i>
              <span>StorePoceds de Movtos</span></a>
        </li>

{{-- ************************************************************************* --}}

  </ul>
</li>