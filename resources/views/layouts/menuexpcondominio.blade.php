{{-- ======================== EXPEDIENTE CONDOMINIO ============================== --}}

@if(Session::has('condominioexpid'))   

        <div class="user-panel">
            <div class="pull-left image">
               
                <img src="{!! url(env('PATH_IMGINMU').session::get('imgcondomexp') ) !!}" class="img-circle"
                     alt="img"/>
            </div>
            <div class="pull-left info">
           <p>{!! session::get('condonomexp') !!}</p> {{-- Obtiene nombre de var de session --}}
               {{--  @if (Auth::guest())
                <p>Visitante</p>
                @else
                    <p>{{ Auth::user()->name}}</p>
                @endif --}}
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Condominio</a>
            </div>
        </div>

   {{ $condominioexpid=Session::get('condominioexpid') }} {{-- Asigna variable --}}

    <li class="treeview">
        <a href="#"><i class="fa fa-folder-open-o  text-yellow"></i> 
          <span>{{ trans('operaciones.expediente') }}</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i> 
          </span>
        </a>  
    <ul class="treeview-menu">      

    <li class="{{ Request::is('expcondominio*') ? 'active' : '' }}">
        <a href="{!! route('expcondominio.index',$condominioexpid) !!}">
          <i class="fa fa-archive"></i>
          <span>Datos Generales</span>
        </a>
    </li>   

    <li class="{{ Request::is('inmumedioexp*') ? 'active' : '' }}">
        <a href="{!! route('inmumediosexp.index',$condominioexpid) !!}">
          <i class="fa fa-phone"></i>
          <span>{{ trans('operaciones.medcont') }}</span>
        </a>
    </li>

    <li class="{{ Request::is('inmubicaciones*') ? 'active' : '' }}">
        <a href="{!! route('inmubicaciones.index',$condominioexpid) !!}">
          <i class="fa fa-map-marker"></i>
          <span>{{ trans('operaciones.ubic') }}</span>
        </a>
    </li>

     <li class="{{ Request::is('relinmp*') ? 'active' : '' }}">
        <a href="{!! route('relinmp.expinmuindex',$condominioexpid) !!}">
          <i class="fa fa-users"></i>
          <span>Personas Asignadas</span>
        </a>
    </li> 

    <li class="{{ Request::is('condomareas*') ? 'active' : '' }}">
      <a href="{!! route('condomareas.index',$condominioexpid) !!}">
        <i class="fa fa-delicious"></i>
        <span>Areas</span>
      </a>
    </li>

    <li class="{{ Request::is('condomaccounts*') ? 'active' : '' }}">
      <a href="{!! route('condomaccounts.index',$condominioexpid) !!}">
        <i class="fa fa-cc-visa"></i>
        <span>Cuentas Bancarias</span>
      </a>
    </li>

    <li class="{{ Request::is('unidades*') ? 'active' : '' }}">
        <a href="{!! route('unidades.index') !!}">
          <i class="fa fa-home"></i>
          <span>Unidades</span>
        </a>
    </li>  

    <li class="{{ Request::is('indivisos*') ? 'active' : '' }}">
    <a href="{!! route('indivisos.index',$condominioexpid) !!}">
      <i>%</i>
      <span>Indivisos de unidades</span>
    </a>
    </li>

    <li class="{{ Request::is('presup*') ? 'active' : '' }}">
    <a href="{!! route('presup.index',$condominioexpid) !!}">
      <i>$</i>
      <span>Presupuesto</span>
    </a>
    </li>

    <li class="{{ Request::is('indivisos*') ? 'active' : '' }}">
    <a href="{!! route('indivisos.cuotasidx',$condominioexpid) !!}">
      <i>$=></i>
      <span>Cuotas</span>
    </a>
    </li>

    <li class="{{ Request::is('edoscta*') ? 'active' : '' }}">
    <a href="{!! route('edoscta.selperiod',$condominioexpid) !!}">    
      <i>-$+</i>
      <span>Movimientos</span>
    </a>
    </li>    

    <li class="{{ Request::is('gasconsum*') ? 'active' : '' }}">
    <a href="{!! route('gasconsum.showgas',[$condominioexpid,0,0]) !!}">    
      <i class="glyphicon glyphicon-fire"></i>      
      <span>Consumos de Gas</span>
    </a>
    </li> 

    <li class="{{ Request::is('egresos*') ? 'active' : '' }}">
    <a href="{!! route('egresos.selperiod',[$condominioexpid]) !!}">    
      <i>-$</i>      
      <span>Egresos</span>
    </a>
    </li> 
    <li class="{{ Request::is('checkissuances*') ? 'active' : '' }}">
    <a href="{!! route('checkissuances.index') !!}">    
      <i>[$]</i>      
      <span>Cheques Aplicados</span>
    </a>
    </li> 
{{--     <li class="{{ Request::is('edoscta*') ? 'active' : '' }}">
    <a href="{!! route('edoscta.egresos',[$condominioexpid]) !!}">    
      <i>-$</i>      
      <span>Egresos todo</span>
    </a>
    </li>  --}}


{{--     <li class="{{ Request::is('edoscta*') ? 'active' : '' }}">
    <a href="{!! route('egreso.create',[$condominioexpid]) !!}">    
      <i>+$</i>      
      <span>Gastos</span>
    </a>
    </li>  --}}





    {{--
     <li class="{{ Request::is('edoscta*') ? 'active' : '' }}">
    <a href="{!! route('edoscta.index',$condominioexpid) !!}">    
      <i>+$</i>
      <span>Cargos Aplicados</span>
    </a>
    </li>


  <li class="{{ Request::is('cpay*') ? 'active' : '' }}">
    <a href="{!! route('cpay.index') !!}">      
      <i>-$</i>
      <span>Consulta Pagos</span>
    </a>
    </li> 
    --}}

    <li class="{{ Request::is('pparams*') ? 'active' : '' }}">
        <a href="{!! route('pparams.index',$condominioexpid) !!}">
            <i class="fa fa-edit"></i><span>Parametros</span>
        </a>
    </li>  

     
    {{-- <li class="{{ Request::is('ivalues*') ? 'active' : '' }}">
        <a href="{!! route('ivalues.index',$condominioexpid) !!}">
            <i class="fa fa-edit"></i><span>Datos de unidades</span>
        </a>
    </li>  --}}    

   {{-- <li class="{{ Request::is('propertycontractservices*') ? 'active' : '' }}">
            <a href="{!! route('propertycontractservices.index') !!}">
              <i class="fa fa-edit"></i>
              <span>Propertycontractservices</span>
            </a>
    </li> --}}

    <li class="{{ Request::is('correolist*') ? 'active' : '' }}">
        <a href="{!! route('correolist.index',$condominioexpid) !!}">
          <i class="fa fa-envelope-o"></i><span>Lista de Correos</span>
        </a>
    </li>

    <li class="{{ Request::is('expcondominio*') ? 'active' : '' }}">
        <a href="{!! route('expcondominio.close') !!}">
          <i class="glyphicon glyphicon-new-window"></i>
          <span>{{ trans('operaciones.cerrar') }}</span>
        </a>
    </li>  
    
    <li class="{{ Request::is('anticipos*') ? 'active' : '' }}">
        <a href="{{ route('anticipos.index') }}">
        <i class="fa fa-edit"></i><span>Anticipos</span></a>
    </li>

    <li class="{{ Request::is('anticiposaplis*') ? 'active' : '' }}">
        <a href="{{ route('anticiposaplis.index') }}">
        <i class="fa fa-edit"></i><span>Anticiposaplis</span></a>
    </li>

  </ul>
  </li>
@else
@endif
