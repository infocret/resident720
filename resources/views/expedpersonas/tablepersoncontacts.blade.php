<table class="table table-responsive" id="personaContactos-table">
    <thead>
        <tr>
            <th>Medio</th>
            <th>Dato</th>        
            <th>Observaciones</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($personaContactos as $personaContacto)
        <tr>
            <td>{!! $personaContacto->nombre !!}</td>
            <td>{!! $personaContacto->valor !!}</td>            
            <td>{!! $personaContacto->observaciones !!}</td>
            <td>
                {!! Form::open(['route' => ['personaContactos.destroy', $personaContacto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('personaContactos.show', [$personaContacto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('personaContactos.edit', [$personaContacto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>