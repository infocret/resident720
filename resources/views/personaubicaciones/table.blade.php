<table class="table table-responsive" id="personaDirs-table">
    <thead>
        <tr>   
        <th>Mapa</th>     
        <th>Ubicación</th>
        <th>Dirección</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($personaDirs as $personaDir)
        <tr>      
            <td>
            @if (is_null($personaDir->linkmapa) || $personaDir->linkmapa == "N/A" || $personaDir->linkmapa == "n/a")
                <a href="{!! env('Gmaps_Search2').$personaDir->dir !!}" class='btn btn-default btn-xs' target="_blank">
                    <i class="glyphicon fa fa-map" style="color:green"></i>
                </a> 
            @else
                <a href="{!! $personaDir->linkmapa !!}" class='btn btn-default btn-xs' target="_blank">
                    <i class="glyphicon fa fa-map" style="color:green"></i>
                </a>  
            @endif
            </td>     
            <td>{!! $personaDir->nombre !!}</td>
            <td>{!! $personaDir->dir !!}</td>
            <td>
                {!! Form::open(['route' => ['personaubicaciones.destroy', $personaDir->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('personaubicaciones.show', [$personaDir->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('personaubicaciones.pdfshow', [$personaDir->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-save-file"></i></a>
                    <a href="{!! route('personaubicaciones.edit', [$personaDir->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>