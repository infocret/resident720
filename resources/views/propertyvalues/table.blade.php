<table class="table table-responsive" id="propertyvalues-table">
    <thead>
        <tr>
            <th>Inmueble Id</th>
        <th>Area</th>
        <th>Porcentaje</th>
        <th>Valor</th>
        <th>Presupuesto</th>
        <th>Cuota</th>
        <th>Indiv1</th>
        <th>Indiv2</th>
        <th>Indiv3</th>
        <th>Indiv4</th>
        <th>Indiv5</th>
        <th>Param1</th>
        <th>Param2</th>
        <th>Param3</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($propertyvalues as $propertyvalue)
        <tr>
            <td>{!! $propertyvalue->inmueble_id !!}</td>
            <td>{!! $propertyvalue->area !!}</td>
            <td>{!! $propertyvalue->porcentaje !!}</td>
            <td>{!! $propertyvalue->valor !!}</td>
            <td>{!! $propertyvalue->presupuesto !!}</td>
            <td>{!! $propertyvalue->cuota !!}</td>
            <td>{!! $propertyvalue->indiv1 !!}</td>
            <td>{!! $propertyvalue->indiv2 !!}</td>
            <td>{!! $propertyvalue->indiv3 !!}</td>
            <td>{!! $propertyvalue->indiv4 !!}</td>
            <td>{!! $propertyvalue->indiv5 !!}</td>
            <td>{!! $propertyvalue->param1 !!}</td>
            <td>{!! $propertyvalue->param2 !!}</td>
            <td>{!! $propertyvalue->param3 !!}</td>
            <td>
                {!! Form::open(['route' => ['propertyvalues.destroy', $propertyvalue->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('propertyvalues.show', [$propertyvalue->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('propertyvalues.edit', [$propertyvalue->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>