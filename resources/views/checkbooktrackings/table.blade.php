<table class="table table-responsive" id="checkbooktrackings-table">
    <thead>
        <tr>
            <th>Checkissuance Id</th>
        <th>User Id</th>
        <th>Datereg</th>
        <th>Status</th>
        <th>Observ</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($checkbooktrackings as $checkbooktracking)
        <tr>
            <td>{!! $checkbooktracking->checkissuance_id !!}</td>
            <td>{!! $checkbooktracking->user_id !!}</td>
            <td>{!! $checkbooktracking->datereg !!}</td>
            <td>{!! $checkbooktracking->status !!}</td>
            <td>{!! $checkbooktracking->observ !!}</td>
            <td>
                {!! Form::open(['route' => ['checkbooktrackings.destroy', $checkbooktracking->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('checkbooktrackings.show', [$checkbooktracking->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('checkbooktrackings.edit', [$checkbooktracking->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>