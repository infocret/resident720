<table class="table table-responsive" id="inmucharges-table">
    <thead>
        <tr>
            <th>Inmu Id</th>
        <th>Conceptserv Id</th>
        <th>Proparea Id</th>
        <th>Provider Id</th>
        <th>Date</th>
        <th>Folio</th>
        <th>Stotal</th>
        <th>Iva</th>
        <th>Balance</th>
        <th>Status</th>
        <th>Description</th>
        <th>Observ</th>
        <th>Filelink</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($inmucharges as $inmucharge)
        <tr>
            <td>{!! $inmucharge->inmu_id !!}</td>
            <td>{!! $inmucharge->conceptserv_id !!}</td>
            <td>{!! $inmucharge->proparea_id !!}</td>
            <td>{!! $inmucharge->provider_id !!}</td>
            <td>{!! $inmucharge->date !!}</td>
            <td>{!! $inmucharge->folio !!}</td>
            <td>{!! $inmucharge->stotal !!}</td>
            <td>{!! $inmucharge->iva !!}</td>
            <td>{!! $inmucharge->balance !!}</td>
            <td>{!! $inmucharge->status !!}</td>
            <td>{!! $inmucharge->description !!}</td>
            <td>{!! $inmucharge->observ !!}</td>
            <td>{!! $inmucharge->filelink !!}</td>
            <td>
                {!! Form::open(['route' => ['inmucharges.destroy', $inmucharge->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inmucharges.show', [$inmucharge->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inmucharges.edit', [$inmucharge->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>