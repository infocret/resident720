<table class="table table-responsive" id="personas-table">
    <thead>
        <tr>
        <th>Expediente</th>
        <th>Name</th>
        <th>Appat</th>
        <th>Apmat</th>
        <th>Lugarnac</th>
        <th>Datebirth</th>
        <th>Genero</th>
        <th>Rfc</th>
        <th>Curp</th>
        <th>Nss</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($personas as $persona)
        <tr>
            <td>                
                <a href="{!! route('personaexp.index', [$persona->id]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-folder-open"></i></a>
            </td>
            <td>{!! $persona->name !!}</td>
            <td>{!! $persona->appat !!}</td>
            <td>{!! $persona->apmat !!}</td>
            <td>{!! $persona->lugarnac !!}</td>
            <td>{!! $persona->datebirth !!}</td>
            <td>{!! $persona->genero !!}</td>
            <td>{!! $persona->rfc !!}</td>
            <td>{!! $persona->curp !!}</td>
            <td>{!! $persona->nss !!}</td>
            <td>
                {!! Form::open(['route' => ['personas.destroy', $persona->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('personas.show', [$persona->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('personas.edit', [$persona->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>