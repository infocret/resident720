<table class="table table-responsive" id="inmuebleMedios-table">
    <thead>
        <tr>
            <th>Medio Id</th>
        <th>Inmueble Id</th>
        <th>Dato</th>
        <th>Observaciones</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($inmuebleMedios as $inmuebleMedio)
        <tr>
            <td>{!! $inmuebleMedio->medio_id !!}</td>
            <td>{!! $inmuebleMedio->inmueble_id !!}</td>
            <td>{!! $inmuebleMedio->dato !!}</td>
            <td>{!! $inmuebleMedio->observaciones !!}</td>
            <td>
                {!! Form::open(['route' => ['inmuebleMedios.destroy', $inmuebleMedio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inmuebleMedios.show', [$inmuebleMedio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inmuebleMedios.edit', [$inmuebleMedio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>