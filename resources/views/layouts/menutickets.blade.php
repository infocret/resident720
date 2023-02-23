  {{-- ==================== Tickets ================================== --}}

<li class="treeview">
          <a href="#"><i class="fa fa-hand-o-up"></i> 
            <span>Ticket</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  
  <ul class="treeview-menu">

        <li class="{{ Request::is('tickets*') ? 'active' : '' }}">
            <a href="{!! route('tickets.index') !!}">
              <i class="fa fa-ticket"></i>
              <span>Tickets</span>
            </a>
        </li>

        <li class="{{ Request::is('statustickets*') ? 'active' : '' }}">
            <a href="{!! route('statustickets.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Statustickets</span>
            </a>
        </li>

        <li class="{{ Request::is('statusticketimgs*') ? 'active' : '' }}">
            <a href="{!! route('statusticketimgs.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Statusticketimgs</span>
            </a>
        </li>

  </ul>
</li>
