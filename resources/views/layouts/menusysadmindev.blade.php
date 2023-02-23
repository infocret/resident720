
  {{-- ====================Sys admin Dev   ================================== --}}
 <li class="treeview">
          <a href="#"><i class="fa  fa-codepen"></i> 
            <span>{{ trans('operaciones.syadmdev') }}</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  
  <ul class="treeview-menu">

      <li class="{{ Request::is('inmovto*') ? 'active' : '' }}">
          <a href="{!! route('inmovto.rbackcancel',1988) !!}">
          <i class="fa fa-empire"></i><span>Roll Back Cancel</span>
          </a>
      </li>

      <li class="{{ Request::is('codegenjb*') ? 'active' : '' }}">
          <a href="{!! route('codegenjb.index') !!}">
          <i class="fa fa-empire"></i><span>Generar JSON</span>
          </a>
      </li>

      <li class="{{ Request::is('movsimport*') ? 'active' : '' }}">
          <a href="{!! route('movsimport.selfile') !!}">
          <i class="fa fa-empire"></i><span>Importar Movtos</span>
          </a>
      </li>      

      <li class="{{ Request::is('testmail.index*') ? 'active' : '' }}">
          <a href="{!! route('testmail.index') !!}">
          <i class="fa fa-empire"></i><span>Send Email</span>
          </a>
      </li>

       <li class="{{ Request::is('testmail.index2*') ? 'active' : '' }}">
          <a href="{!! route('testmail.index2') !!}">
          <i class="fa fa-empire"></i><span>Send Mailable</span>
          </a>
      </li>

       <li class="{{ Request::is('testmail.index3*') ? 'active' : '' }}">
          <a href="{!! route('testmail.index3') !!}">
          <i class="fa fa-empire"></i><span>Send Markdown</span>
          </a>
      </li>

       <li class="{{ Request::is('testmail.barcode*') ? 'active' : '' }}">
          <a href="{!! route('testmail.barcode') !!}">
          <i class="fa fa-empire"></i><span>Barcode</span>
          </a>
      </li>

       <li class="{{ Request::is('testmail.index4*') ? 'active' : '' }}">
          <a href="{!! route('testmail.index4') !!}">
          <i class="fa fa-empire"></i><span>Send Recibo</span>
          </a>
      </li>

       <li class="{{ Request::is('rootpath.clear_cache*') ? 'active' : '' }}">
          <a href="{!! route('rootpath.clear_cache') !!}">
          <i class="fa fa-empire"></i><span>Artisan - Clear Cache</span>
          </a>
      </li>      

       <li class="{{ Request::is('rootpath.index*') ? 'active' : '' }}">
          <a href="{!! route('rootpath.index') !!}">
          <i class="fa fa-empire"></i><span>Ruta (Public)</span>
          </a>
      </li>

       <li class="{{ Request::is('storagepath.index*') ? 'active' : '' }}">
          <a href="{!! route('storagepath.index') !!}">
          <i class="fa fa-empire"></i><span>Ruta (Storage)</span>
          </a>
      </li>

  </ul>
</li>