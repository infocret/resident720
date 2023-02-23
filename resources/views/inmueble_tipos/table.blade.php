<table class="table table-responsive" id="inmuebleTipos-table">
    <thead>
        <tr>
            <th>Ident</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Imgfilename</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($inmuebleTipos as $inmuebleTipo)
        <tr>
            <td>{!! $inmuebleTipo->ident !!}</td>
            <td>{!! $inmuebleTipo->nombre !!}</td>
            <td>{!! $inmuebleTipo->descripcion !!}</td>
            <td>{!! $inmuebleTipo->imgfilename !!}</td>
            <td>
                {!! Form::open(['route' => ['inmuebleTipos.destroy', $inmuebleTipo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inmuebleTipos.show', [$inmuebleTipo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inmuebleTipos.edit', [$inmuebleTipo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>