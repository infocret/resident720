<table class="table table-responsive" id="medioPersonas-table">
    <thead>
        <tr>
            <th>Medio Id</th>
        <th>Persona Id</th>
        <th>Dato</th>
        <th>Observaciones</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($medioPersonas as $medioPersona)
        <tr>
            <td>{!! $medioPersona->medio_id !!}</td>
            <td>{!! $medioPersona->persona_id !!}</td>
            <td>{!! $medioPersona->dato !!}</td>
            <td>{!! $medioPersona->observaciones !!}</td>
            <td>
                {!! Form::open(['route' => ['medioPersonas.destroy', $medioPersona->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('medioPersonas.show', [$medioPersona->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('medioPersonas.edit', [$medioPersona->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>