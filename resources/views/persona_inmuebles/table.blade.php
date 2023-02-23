<table class="table table-responsive" id="personaInmuebles-table">
    <thead>
        <tr>
            <th>Persona Id</th>
        <th>Inmueble Id</th>
        <th>Reltipo Id</th>
        <th>Asignacion</th>
        <th>Baja</th>
        <th>Observaciones</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($personaInmuebles as $personaInmueble)
        <tr>
            <td>{!! $personaInmueble->persona_id !!}</td>
            <td>{!! $personaInmueble->inmueble_id !!}</td>
            <td>{!! $personaInmueble->reltipo_id !!}</td>
            <td>{!! $personaInmueble->asignacion !!}</td>
            <td>{!! $personaInmueble->baja !!}</td>
            <td>{!! $personaInmueble->observaciones !!}</td>
            <td>
                {!! Form::open(['route' => ['personaInmuebles.destroy', $personaInmueble->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('personaInmuebles.show', [$personaInmueble->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('personaInmuebles.edit', [$personaInmueble->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>