@include('layouts.menuexppersona')

@include('layouts.menuexpcondominio')

@include('layouts.menuexpunidad')

@include('layouts.menuexpinmueble')

@include('layouts.menuoperaciones')

@include('layouts.menuparametros')

@if (Auth::user()->name == "Julio buendia")

@include('layouts.menuadminmovtos')

@include('layouts.menutickets')

@include('layouts.menueventos')

@include('layouts.menuparametrosdev')

@include('layouts.menucatalogos')

@include('layouts.menuinventarios')

@include('layouts.menusysoperorig')

@include('layouts.menusysadmindev')

@endif
{{-- 
<li class="treeview">
          <a href="#"><i class="fa  fa-cogs"></i> <span>Pruebas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  
        <ul class="treeview-menu">  
          <li><a href="/select">SelectCodPo</a></li>
          <li><a href="/upload">Sube Archivo</a></li>
        </ul>
</li> 
--}}






