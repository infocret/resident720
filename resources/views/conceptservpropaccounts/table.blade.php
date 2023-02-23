<table class="table table-responsive" id="conceptservpropaccounts-table">
    <thead>
        <tr>
            <th>Conceptservices Id</th>
        <th>Propaccounts Id</th>
        <th>T Use</th>
        <th>Bank Agreement</th>
        <th>Bank Reference</th>
        <th>Reciptext</th>
        <th>Description</th>
        <th>Observ</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($conceptservpropaccounts as $conceptservpropaccount)
        <tr>
            <td>{!! $conceptservpropaccount->conceptservices_id !!}</td>
            <td>{!! $conceptservpropaccount->propaccounts_id !!}</td>
            <td>{!! $conceptservpropaccount->t_use !!}</td>
            <td>{!! $conceptservpropaccount->bank_agreement !!}</td>
            <td>{!! $conceptservpropaccount->bank_reference !!}</td>
            <td>{!! $conceptservpropaccount->reciptext !!}</td>
            <td>{!! $conceptservpropaccount->description !!}</td>
            <td>{!! $conceptservpropaccount->observ !!}</td>
            <td>
                {!! Form::open(['route' => ['conceptservpropaccounts.destroy', $conceptservpropaccount->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('conceptservpropaccounts.show', [$conceptservpropaccount->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('conceptservpropaccounts.edit', [$conceptservpropaccount->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>