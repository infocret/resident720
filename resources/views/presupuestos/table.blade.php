<table class="table table-responsive" id="presupuestos-table">
    <thead>
        <tr>
            <th>Inmueble Id</th>
        <th>Movtipo Id</th>
        <th>Monto</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($presupuestos as $presupuesto)
        <tr>
            <td>{!! $presupuesto->inmueble_id !!}</td>
            <td>{!! $presupuesto->movtipo_id !!}</td>
            <td>{!! $presupuesto->monto !!}</td>
            <td>
                {!! Form::open(['route' => ['presupuestos.destroy', $presupuesto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('presupuestos.show', [$presupuesto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('presupuestos.edit', [$presupuesto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>