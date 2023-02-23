<table class="table table-responsive" id="inmumovtos-table">
    <thead>
        <tr>
            <th>Inmucharg Id</th>
        <th>Unidmovto Id</th>
        <th>Catmovto Cve</th>
        <th>Date</th>
        <th>Folio</th>
        <th>Quantity</th>
        <th>Measureunit Id</th>
        <th>Amount</th>
        <th>Balance</th>
        <th>Status</th>
        <th>Apmode</th>
        <th>Description</th>
        <th>Observ</th>
        <th>Filelink</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($inmumovtos as $inmumovto)
        <tr>
            <td>{!! $inmumovto->inmucharg_id !!}</td>
            <td>{!! $inmumovto->unidmovto_id !!}</td>
            <td>{!! $inmumovto->catmovto_cve !!}</td>
            <td>{!! $inmumovto->date !!}</td>
            <td>{!! $inmumovto->folio !!}</td>
            <td>{!! $inmumovto->quantity !!}</td>
            <td>{!! $inmumovto->measureunit_id !!}</td>
            <td>{!! $inmumovto->amount !!}</td>
            <td>{!! $inmumovto->balance !!}</td>
            <td>{!! $inmumovto->status !!}</td>
            <td>{!! $inmumovto->apmode !!}</td>
            <td>{!! $inmumovto->description !!}</td>
            <td>{!! $inmumovto->observ !!}</td>
            <td>{!! $inmumovto->filelink !!}</td>
            <td>
                {!! Form::open(['route' => ['inmumovtos.destroy', $inmumovto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inmumovtos.show', [$inmumovto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inmumovtos.edit', [$inmumovto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>