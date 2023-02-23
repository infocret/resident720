<table class="table table-responsive" id="propertyparameters-table">
    <thead>
        <tr>
        {{-- <th>Inmueble</th> --}}
        <th>Indiviso</th>
        <th>Valor</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($propertyparameters as $propertyparameter)
        <tr>
            {{-- <td>{!! $propertyparameter->inmueble_id !!}</td> --}}
            <td>{!! $propertyparameter->parametro !!}</td>
            <td>{!! $propertyparameter->valor !!}</td>
            <td>
                {!! Form::open(['route' => ['indivisos.destroy', $propertyparameter->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('indivisos.show', [$propertyparameter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('indivisos.edit', [$propertyparameter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>