<table class="table table-responsive" id="catmovtos-table">
    <thead>
        <tr>
            <th>Conceptserv Id</th>
        <th>Cve</th>
        <th>Tipo</th>
        <th>Shortname</th>
        <th>Name</th>
        <th>Description</th>
        <th>Observ</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($catmovtos as $catmovto)
        <tr>
            <td>{!! $catmovto->conceptserv_id !!}</td>
            <td>{!! $catmovto->cve !!}</td>
            <td>{!! $catmovto->tipo !!}</td>
            <td>{!! $catmovto->shortname !!}</td>
            <td>{!! $catmovto->name !!}</td>
            <td>{!! $catmovto->description !!}</td>
            <td>{!! $catmovto->observ !!}</td>
            <td>
                {!! Form::open(['route' => ['catmovtos.destroy', $catmovto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('catmovtos.show', [$catmovto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('catmovtos.edit', [$catmovto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>