<table class="table table-responsive" id="maillists-table">
    <thead>
        <tr>
            <th>Inmueble Id</th>
        <th>Listtype</th>
        <th>Email</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($maillists as $maillist)
        <tr>
            <td>{!! $maillist->inmueble_id !!}</td>
            <td>{!! $maillist->listtype !!}</td>
            <td>{!! $maillist->email !!}</td>
            <td>
                {!! Form::open(['route' => ['maillists.destroy', $maillist->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('maillists.show', [$maillist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('maillists.edit', [$maillist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>