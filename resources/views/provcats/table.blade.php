<table class="table table-responsive" id="provcats-table">
    <thead>
        <tr>
            <th>Tipo</th>
        <th>Categoria</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($provcats as $provcats)
        <tr>
            <td>{!! $provcats->tipo !!}</td>
            <td>{!! $provcats->categoria !!}</td>
            <td>
                {!! Form::open(['route' => ['provcats.destroy', $provcats->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('provcats.show', [$provcats->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('provcats.edit', [$provcats->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Seguro desea eliminar categoría?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>