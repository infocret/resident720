
  {{-- ====================Operaciones originales del sistema   ================================== --}}
 <li class="treeview">
          <a href="#"><i class="fa  fa-codepen"></i> 
            <span>Oper Originales</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  
  <ul class="treeview-menu">
        <li class="{{ Request::is('inmuebles*') ? 'active' : '' }}">
          <a href="{!! route('inmuebles.index') !!}">
            <i class="fa fa-building-o"></i>
            <span>{{ trans('operaciones.condominio') }}</span>
          </a>
        </li>

        <li class="{{ Request::is('inmuebleImagesids*') ? 'active' : '' }}">
        <a href="{!! route('inmuebleImagesids.index') !!}"><i class="fa fa-building-o"></i>
            <span>Inmueble Imagenes ids</span></a>
        </li>

        <li class="{{ Request::is('inmuebleDirs*') ? 'active' : '' }}">
        <a href="{!! route('inmuebleDirs.index') !!}">
        <i class="fa fa-phone"></i>
        <span>{{ trans('operaciones.inmusmedcont') }}</span>
        </a>
        </li>

        <li class="{{ Request::is('inmuebleMedios*') ? 'active' : '' }}">
        <a href="{!! route('inmuebleMedios.index') !!}">
        <i class="fa fa-location-arrow"></i>
        <span>{{ trans('operaciones.inmusubic') }}</span>
        </a>
        </li>

  

        <li class="{{ Request::is('propertyparameters*') ? 'active' : '' }}">
        <a href="{!! route('propertyparameters.index') !!}"><i class="fa fa-edit"></i>
            <span>propertyparameters</span></a>
        </li>

        <li class="{{ Request::is('relationshipProperties*') ? 'active' : '' }}">
        <a href="{!! route('relationshipProperties.index') !!}">
        <i class="fa fa-edit"></i>
        <span>Relationship Properties</span>  
        {{-- <span>{{Auth::user()->name}}</span>  --}}
        </a>
        </li>   

        <li class="{{ Request::is('propertyareas*') ? 'active' : '' }}">
        <a href="{!! route('propertyareas.index') !!}">
        <i class="fa fa-edit"></i>
        <span>Propertyareas</span>
        </a>
        </li>

        <li class="{{ Request::is('propaccounts*') ? 'active' : '' }}">
        <a href="{!! route('propaccounts.index') !!}">
        <i class="fa fa-bars"></i>
        <span>Propaccounts</span>
        </a>
        </li>

        {{-- <li class="{{ Request::is('propaccounts*') ? 'active' : '' }}">
            <a href="{!! route('propaccounts.index') !!}"><i class="fa fa-edit"></i><span>Propaccounts</span></a>
        </li> --}}

        <li class="{{ Request::is('propertycontractservices*') ? 'active' : '' }}">
        <a href="{!! route('propertycontractservices.index') !!}">
        <i class="fa fa-edit"></i>
        <span>Propertycontractservices</span>
        </a>
        </li>
        
       {{-- Relacionar persona a propiedad --}}
        <li class="{{ Request::is('personaInmuebles*') ? 'active' : '' }}">
        <a href="{!! route('personaInmuebles.index') !!}">
        <i class="fa fa-code-fork"></i>
        <span>{{ trans('operaciones.relpersinmu') }} </span>
        </a>
        </li>

        <li class="{{ Request::is('personaImagesids*') ? 'active' : '' }}">
        <a href="{!! route('personaImagesids.index') !!}">
        <i class="fa fa-smile-o"></i>
        <span>{{ trans('operaciones.persimg') }}</span>
        </a>
        </li>

        <li class="{{ Request::is('personaDirs*') ? 'active' : '' }}">
        <a href="{!! route('personaDirs.index') !!}">          
        <i class="fa fa-location-arrow"></i>
        <span>{{ trans('operaciones.persubic') }}</span>
        </a>
        </li>

        <li class="{{ Request::is('medioPersonas*') ? 'active' : '' }}">
        <a href="{!! route('medioPersonas.index') !!}">
        <i class="fa fa-phone"></i>
        <span>{{ trans('operaciones.persmedcont') }}</span>
        </a>
        </li>

        <li class="{{ Request::is('personaccounts*') ? 'active' : '' }}">
        <a href="{!! route('personaccounts.index') !!}">
        <i class="fa fa-bars"></i>
        <span>Personaccounts</span>
        </a>
        </li>
 
        {{-- Persona Documentos  --}}
        <li class="{{ Request::is('personaDocuments*') ? 'active' : '' }}">
        <a href="{!! route('personaDocuments.index') !!}">
        <i class="fa fa-file-pdf-o"></i>
        <span>{{ trans('operaciones.persdocs') }}</span>
        </a>
        </li>  

        <li class="{{ Request::is('providers*') ? 'active' : '' }}">
            <a href="{!! route('providers.index') !!}">
              <i class="fa fa-handshake-o"></i>
              <span>{{ trans('operaciones.proveedores') }}</span>
            </a>
        </li>

{{--         <li class="{{ Request::is('proveedor*') ? 'active' : '' }}">
            <a href="{!! route('proveedor.index',$personaexpid) !!}">
            <i class="fa fa-handshake-o"></i>
            <span>Rel persona proveedor</span>
            </a>
        </li>  --}}
        
        <li class="{{ Request::is('categorieProviders*') ? 'active' : '' }}">
        <a href="{!! route('categorieProviders.index') !!}">
        <i class="fa fa-edit"></i>
        <span>Rel Categ  Proveedor</span>
        </a>
        </li>

        <li class="{{ Request::is('provideraccounts*') ? 'active' : '' }}">
        <a href="{!! route('provideraccounts.index') !!}">
        <i class="fa fa-bars"></i>
        <span>Provideraccounts</span>
        </a>
        </li>

        <li class="{{ Request::is('headmovs*') ? 'active' : '' }}">
        <a href="{!! route('headmovs.index') !!}">
        <i class="fa fa-edit"></i>
        <span>Headmovs</span>
        </a>
        </li>

        <li class="{{ Request::is('detailmovs*') ? 'active' : '' }}">
        <a href="{!! route('detailmovs.index') !!}">
        <i class="fa fa-edit"></i>
        <span>Detailmovs</span>
        </a>
        </li>  

        <li class="{{ Request::is('maillists*') ? 'active' : '' }}">
            <a href="{!! route('maillists.index') !!}">
                <i class="fa fa-edit"></i><span>Listas de Correo</span>
            </a>
        </li>

        <li class="{{ Request::is('propertyvalues*') ? 'active' : '' }}">
            <a href="{!! route('propertyvalues.index') !!}">
                <i class="fa fa-edit"></i><span>Valores de Inmueble</span>
            </a>
        </li>      

        <li class="{{ Request::is('presupuestos*') ? 'active' : '' }}">
            <a href="{!! route('presupuestos.index') !!}">
                <i class="fa fa-edit"></i><span>Presupuestos</span>
            </a>
        </li>


        <li class="{{ Request::is('conceptservices*') ? 'active' : '' }}">
            <a href="{!! route('conceptservices.index') !!}">
                <i class="fa fa-edit"></i><span>Conceptservices</span>
            </a>
        </li>

        <li class="{{ Request::is('catmovtos*') ? 'active' : '' }}">
            <a href="{!! route('catmovtos.index') !!}">
                <i class="fa fa-edit"></i><span>Catmovtos</span>
            </a>
        </li>

        <li class="{{ Request::is('unidadmovtos*') ? 'active' : '' }}">
            <a href="{!! route('unidadmovtos.index') !!}">
                <i class="fa fa-edit"></i><span>Unidadmovtos</span>
            </a>
        </li>

        <li class="{{ Request::is('inmucharges*') ? 'active' : '' }}">
            <a href="{!! route('inmucharges.index') !!}">
                <i class="fa fa-edit"></i><span>Inmucharges</span>
            </a>
        </li>

        <li class="{{ Request::is('inmumovtos*') ? 'active' : '' }}">
            <a href="{!! route('inmumovtos.index') !!}">
                <i class="fa fa-edit"></i><span>Inmumovtos</span>
            </a>
        </li>

        <li class="{{ Request::is('gasconsumptions*') ? 'active' : '' }}">
            <a href="{!! route('gasconsumptions.index') !!}">
                <i class="fa fa-edit"></i><span>Gasconsumptions</span>
            </a>
        </li>


        <li class="{{ Request::is('conceptservpropaccounts*') ? 'active' : '' }}">
            <a href="{!! route('conceptservpropaccounts.index') !!}">
                <i class="fa fa-edit"></i><span>Conceptservpropaccounts</span>
            </a>
        </li>
        
        <li class="{{ Request::is('checkbooktrackings*') ? 'active' : '' }}">
            <a href="{!! route('checkbooktrackings.index') !!}"><i class="fa fa-edit"></i><span>Checkbooktrackings</span></a>
        </li>

        <li class="{{ Request::is('checkbookprints*') ? 'active' : '' }}">
            <a href="{!! route('checkbookprints.index') !!}"><i class="fa fa-edit"></i><span>Checkbookprints</span></a>
        </li>


  </ul>
</li>