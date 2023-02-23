<table class="table table-responsive" id="gasconsumptions-table">
    <thead>
        <tr>
        <th>Inmueble Id</th>
        <th>Inmucharge Id</th>
        <th>Reading Date</th>
        <th>Last Reading</th>
        <th>Current Reading</th>
        <th>Quantity</th>
        <th>Gas Price</th>
        <th>Amount</th>
        <th>Application Date</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($gasconsumptions as $gasconsumption)
        <tr>
            <td>{!! $gasconsumption->inmueble_id !!}</td>
            <td>{!! $gasconsumption->inmucharge_id !!}</td>
            <td>{!! $gasconsumption->reading_date !!}</td>
            <td>{!! $gasconsumption->last_reading !!}</td>
            <td>{!! $gasconsumption->current_reading !!}</td>
            <td>{!! $gasconsumption->quantity !!}</td>
            <td>{!! $gasconsumption->gas_price !!}</td>
            <td>{!! $gasconsumption->amount !!}</td>
            <td>{!! $gasconsumption->application_date !!}</td>
            <td>
                {!! Form::open(['route' => ['gasconsumptions.destroy', $gasconsumption->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('gasconsumptions.show', [$gasconsumption->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('gasconsumptions.edit', [$gasconsumption->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>