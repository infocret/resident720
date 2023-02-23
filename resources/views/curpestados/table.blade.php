<table class="table table-responsive" id="curpestados-table">
    <thead>
        <tr>
            <th>Estado</th>
        <th>Renapo</th>
        <th>Abrev</th>
        <th>Dosdig</th>
        <th>Iso</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($curpestados as $curpestados)
        <tr>
            <td>{!! $curpestados->estado !!}</td>
            <td>{!! $curpestados->renapo !!}</td>
            <td>{!! $curpestados->abrev !!}</td>
            <td>{!! $curpestados->dosdig !!}</td>
            <td>{!! $curpestados->iso !!}</td>
            <td>
                {!! Form::open(['route' => ['curpestados.destroy', $curpestados->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('curpestados.show', [$curpestados->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('curpestados.edit', [$curpestados->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>