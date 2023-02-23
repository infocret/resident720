<table class="table table-responsive" id="personaDirs-table">
    <thead>
        <tr>
            <th>Persona Id</th>
        <th>Location Id</th>
        <th>Codpo Id</th>
        <th>Pais</th>
        <th>Calle</th>
        <th>Numext</th>
        <th>Piso</th>
        <th>Numint</th>
        <th>Referencia1</th>
        <th>Referencia2</th>
        <th>Linkmapa</th>
        <th>Imagenmapa</th>
        <th>Observaciones</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($personaDirs as $personaDir)
        <tr>
            <td>{!! $personaDir->persona_id !!}</td>
            <td>{!! $personaDir->location_id !!}</td>
            <td>{!! $personaDir->codpo_id !!}</td>
            <td>{!! $personaDir->pais !!}</td>
            <td>{!! $personaDir->calle !!}</td>
            <td>{!! $personaDir->numExt !!}</td>
            <td>{!! $personaDir->piso !!}</td>
            <td>{!! $personaDir->numInt !!}</td>
            <td>{!! $personaDir->referencia1 !!}</td>
            <td>{!! $personaDir->referencia2 !!}</td>
            <td>{!! $personaDir->linkmapa !!}</td>
            <td>{!! $personaDir->imagenMapa !!}</td>
            <td>{!! $personaDir->observaciones !!}</td>
            <td>
                {!! Form::open(['route' => ['personaDirs.destroy', $personaDir->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('personaDirs.show', [$personaDir->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('personaDirs.edit', [$personaDir->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>