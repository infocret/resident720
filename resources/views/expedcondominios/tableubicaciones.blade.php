<table class="table table-responsive" id="personaDirs-table">
    <thead>
        <tr>   
        <th>Mapa</th>     
        <th>Ubicación</th>
        <th>Dirección</th>
        {{-- <th colspan="3">Action</th> --}}
        </tr>
    </thead>
    <tbody>
    @foreach($inmuDirs as $inmuDir)
        <tr>      
            <td>              
             @if (is_null($inmuDir->linkmapa) || $inmuDir->linkmapa == "N/A" || $inmuDir->linkmapa == "n/a")
                 <a href="{!! env('Gmaps_Search2').$inmuDir->calle."+".$inmuDir->numExt."+".$inmuDir->asentamiento."+".$inmuDir->municipio."+".$inmuDir->estado !!}" class='btn btn-default btn-xs' target="_blank">
                <i class="glyphicon fa fa-map" style="color:green"></i>
                </a>    
             @else
                <a href="{!! $inmuDir->linkmapa !!}" class='btn btn-default btn-xs' target="_blank">
                <i class="glyphicon fa fa-map" style="color:green"></i>
                </a>    
             @endif                             
            </td>     
            <td>{!! $inmuDir->nombre !!}</td>
            <td>
                {{-- {!! $inmuDir->dir !!} --}}
                {!! 
                    $inmuDir->calle.
                    ' Num. '.$inmuDir->numExt.
                    ' Int. '.$inmuDir->numInt.
                    ' Piso '.$inmuDir->piso.
                    ' '.$inmuDir->tipo.
                    ' '.$inmuDir->asentamiento.
                    ' '.$inmuDir->municipio.
                    ' '.$inmuDir->estado.
                    ' CP '.$inmuDir->cp
                !!}
            </td>           
        </tr>
    @endforeach
    </tbody>
</table>