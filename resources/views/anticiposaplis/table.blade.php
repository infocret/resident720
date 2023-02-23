<div class="table-responsive">
    <table class="table" id="anticiposaplis-table">
        <thead>
            <tr>
                <th>Anticipo Id</th>
        <th>Inmucharg Id</th>
        <th>Inmumovto Id</th>
        <th>Fechareg</th>
        <th>Saldoini</th>
        <th>Monto</th>
        <th>Saldofin</th>
        <th>Status</th>
        <th>Apmode</th>
        <th>Desc</th>
        <th>Observ</th>
        <th>Userreg</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($anticiposaplis as $anticiposapli)
            <tr>
                <td>{{ $anticiposapli->anticipo_id }}</td>
            <td>{{ $anticiposapli->inmucharg_id }}</td>
            <td>{{ $anticiposapli->inmumovto_id }}</td>
            <td>{{ $anticiposapli->fechareg }}</td>
            <td>{{ $anticiposapli->saldoini }}</td>
            <td>{{ $anticiposapli->monto }}</td>
            <td>{{ $anticiposapli->saldofin }}</td>
            <td>{{ $anticiposapli->status }}</td>
            <td>{{ $anticiposapli->apmode }}</td>
            <td>{{ $anticiposapli->desc }}</td>
            <td>{{ $anticiposapli->observ }}</td>
            <td>{{ $anticiposapli->userreg }}</td>
                <td>
                    {!! Form::open(['route' => ['anticiposaplis.destroy', $anticiposapli->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('anticiposaplis.show', [$anticiposapli->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('anticiposaplis.edit', [$anticiposapli->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
