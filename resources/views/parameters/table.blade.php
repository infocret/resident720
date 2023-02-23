<table class="table table-responsive" id="parameters-table">
    <thead>
        <tr>
            <th>Clave</th>
        <th>Descripcion</th>
        <th>Tipo</th>
        <th>Default</th>
        <th>Observaciones</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($parameters as $parameter)
        <tr>
            <td>{!! $parameter->clave !!}</td>
            <td>{!! $parameter->descripcion !!}</td>
            <td>{!! $parameter->tipo !!}</td>
            <td>{!! $parameter->default !!}</td>
            <td>{!! $parameter->observaciones !!}</td>
            <td>
                {!! Form::open(['route' => ['parameters.destroy', $parameter->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('parameters.show', [$parameter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('parameters.edit', [$parameter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>