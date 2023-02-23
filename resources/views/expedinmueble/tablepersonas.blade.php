<table class="table table-responsive" id="personas-table">
    <thead>
        <tr>
        <th>Expediente</th>
        <th>Asignación</th>
        <th>Nombre</th>
        <th>Paterno</th>
        <th>Materno</th>
        <th>Teléfono</th>
        <th>Desde</th>                
        </tr>
    </thead>
    <tbody>
    @foreach($personas as $persona)
        <tr>
            <td>                
                <a href="{!! route('personaexp.index', [$persona->personaid]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-folder-open"></i></a>
            </td>
            <td>{!! $persona->asignacion !!}</td>
            <td>{!! $persona->nombre !!}</td>
            <td>{!! $persona->paterno !!}</td>
            <td>{!! $persona->materno !!}</td>
            <td>{!! $persona->telefono !!}</td>
            {{-- <td>{!! $persona->desde !!}</td>   --}}
            <td>{!!\Carbon\Carbon::createFromTimeStamp(strtotime($persona->desde))->diffForHumans() !!}                            
        </tr>
    @endforeach
    </tbody>
</table>