  {{-- ==================== Eventos ================================== --}}

<li class="treeview">
          <a href="#"><i class="fa fa-hand-o-up"></i> 
            <span>Eventos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  
  <ul class="treeview-menu">

        <li class="{{ Request::is('events*') ? 'active' : '' }}">
          <a href="{!! route('events.index') !!}">
            <i class="fa fa-edit"></i>
            <span>Events</span>
          </a>
        </li>

        <li class="{{ Request::is('events*') ? 'active' : '' }}">
          <a href="{!! route('event.showcalendar') !!}">
            <i class="fa fa-edit"></i>
            <span>Calendar Demo</span>
          </a>
        </li>

        <li class="{{ Request::is('periods*') ? 'active' : '' }}">
            <a href="{!! route('periods.index') !!}">
              <i class="fa fa-calendar"></i>
              <span>Periods</span>
            </a>
        </li>

        <li class="{{ Request::is('perioddates*') ? 'active' : '' }}">
            <a href="{!! route('perioddates.index') !!}">
              <i class="fa fa-calendar-check-o"></i>
              <span>Perioddates</span>
            </a>
        </li>


  </ul>
</li>
