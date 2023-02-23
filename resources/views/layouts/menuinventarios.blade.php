{{-- ======================= Inventarios =============================== --}}
  <li class="treeview">
          <a href="#"><i class="fa fa-cubes"></i> 
            <span>Inventarios</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  
  <ul class="treeview-menu">

        <li class="{{ Request::is('storages*') ? 'active' : '' }}">
            <a href="{!! route('storages.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Almacenes</span>
            </a>
        </li>

        <li class="{{ Request::is('articlescategories*') ? 'active' : '' }}">
            <a href="{!! route('articlescategories.index') !!}">
              <i class="  fa fa-object-group"></i>
              <span>Art. Categorias</span>
            </a>
        </li>

        <li class="{{ Request::is('articles*') ? 'active' : '' }}">
            <a href="{!! route('articles.index') !!}">
              <i class="fa fa-beer"></i>
              <span>Articulos</span>
            </a>
        </li>

        <li class="{{ Request::is('stocks*') ? 'active' : '' }}">
            <a href="{!! route('stocks.index') !!}">
              <i class="fa fa-book"></i>
              <span>Existencias</span>
            </a>
        </li>

        <li class="{{ Request::is('stockmovements*') ? 'active' : '' }}">
            <a href="{!! route('stockmovements.index') !!}">
              <i class="fa fa-exchange"></i>
              <span>Movimientos Almacen</span>
            </a>
        </li>

  </ul>
</li>
