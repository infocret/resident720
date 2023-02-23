{{-- ================= Parametros ===================================== --}}
 <li class="treeview">
          <a href="#"><i class="fa  fa-wrench"></i> 
            <span>{{ trans('operaciones.syadmparam') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  
  <ul class="treeview-menu">
   

        <li class="{{ Request::is('provcats*') ? 'active' : '' }}">
            <a href="{!! route('provcats.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Categorias Proveedor</span>
            </a>
        </li>  
  
        <li class="{{ Request::is('bankaccounts*') ? 'active' : '' }}">
            <a href="{!! route('bankaccounts.indexb') !!}">
              <i class="fa fa-edit"></i>
              <span>Cuentas Bancarias</span>
            </a>
        </li>

{{-- ************************************************************************* --}}

  </ul>
</li>