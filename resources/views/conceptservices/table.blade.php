<table class="table table-responsive" id="conceptservices-table">
    <thead>
        <tr>
            <th>Cve</th>
        <th>Shortname</th>
        <th>Name</th>
        <th>Description</th>
        <th>Observ</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($conceptservices as $conceptservice)
        <tr>
            <td>{!! $conceptservice->cve !!}</td>
            <td>{!! $conceptservice->shortname !!}</td>
            <td>{!! $conceptservice->name !!}</td>
            <td>{!! $conceptservice->description !!}</td>
            <td>{!! $conceptservice->observ !!}</td>
            <td>
                {!! Form::open(['route' => ['conceptservices.destroy', $conceptservice->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('conceptservices.show', [$conceptservice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('conceptservices.edit', [$conceptservice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>