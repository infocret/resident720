<table class="table table-responsive" id="propaccounts-table">
    <thead>
        <tr>
            <th>Inmueble Id</th>
        <th>Bankaccount Id</th>
        <th>Checkbook Id</th>
        <th>Bank Agreement</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($propaccounts as $propaccount)
        <tr>
            <td>{!! $propaccount->inmueble_id !!}</td>
            <td>{!! $propaccount->bankaccount_id !!}</td>
            <td>{!! $propaccount->checkbook_id !!}</td>
            <td>{!! $propaccount->bank_agreement !!}</td>
            <td>
                {!! Form::open(['route' => ['propaccounts.destroy', $propaccount->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('propaccounts.show', [$propaccount->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('propaccounts.edit', [$propaccount->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>