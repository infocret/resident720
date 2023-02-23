<table class="table table-responsive" id="unidadmovtos-table">
    <thead>
        <tr>
            <th>Inmu Id</th>
        <th>Movto Id</th>
        <th>Periodap</th>
        <th>Validity</th>
        <th>Amount</th>
        <th>Nextap</th>
        <th>Endvalidity</th>
        <th>Observ</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($unidadmovtos as $unidadmovto)
        <tr>
            <td>{!! $unidadmovto->inmu_id !!}</td>
            <td>{!! $unidadmovto->movto_id !!}</td>
            <td>{!! $unidadmovto->periodap !!}</td>
            <td>{!! $unidadmovto->validity !!}</td>
            <td>{!! $unidadmovto->amount !!}</td>
            <td>{!! $unidadmovto->nextap !!}</td>
            <td>{!! $unidadmovto->endvalidity !!}</td>
            <td>{!! $unidadmovto->observ !!}</td>
            <td>
                {!! Form::open(['route' => ['unidadmovtos.destroy', $unidadmovto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('unidadmovtos.show', [$unidadmovto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('unidadmovtos.edit', [$unidadmovto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>