{{-- ============= Admin Movimientos ========================================= --}}
<li class="treeview">
          <a href="#"><i class="fa fa-btc"></i> 
            <span>Admin-Movtos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  
  <ul class="treeview-menu">



        <li class="{{ Request::is('checkissuances*') ? 'active' : '' }}">
            <a href="{!! route('checkissuances.index') !!}">
              <i class="fa fa-sticky-note-o"></i>
              <span>Cheques</span></a>
        </li>

        <li class="{{ Request::is('inmovtos*') ? 'active' : '' }}">
            <a href="{!! route('inmovtos.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Inmueble movtos Egr</span>
            </a>
        </li>     

        <li class="{{ Request::is('movtoheads*') ? 'active' : '' }}">
            <a href="{!! route('movtoheads.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Movtoheads</span>
            </a>
        </li>

        <li class="{{ Request::is('movtodetails*') ? 'active' : '' }}">
            <a href="{!! route('movtodetails.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Movtodetails</span>
            </a>
        </li>

        <li class="{{ Request::is('movtobankaccounts*') ? 'active' : '' }}">
            <a href="{!! route('movtobankaccounts.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Movtobankaccounts</span>
            </a>
        </li>

        <li class="{{ Request::is('movdetailapplies*') ? 'active' : '' }}">
            <a href="{!! route('movdetailapplies.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Movdetailapplies</span>
            </a>
        </li>

        <li class="{{ Request::is('activitytrackings*') ? 'active' : '' }}">
            <a href="{!! route('activitytrackings.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Activitytrackings</span>
            </a>
        </li>       


        <li class="{{ Request::is('headmovs*') ? 'active' : '' }}">
            <a href="{!! route('headmovs.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Headmovs-orig</span>
            </a>
        </li>

        <li class="{{ Request::is('detailmovs*') ? 'active' : '' }}">
            <a href="{!! route('detailmovs.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Detailmovs-orig</span>
            </a>
        </li>      

       
  </ul>
</li>
