<table class="table table-responsive" id="headmovs-table">
    <thead>
        <tr>
            <th>Inmueble Id</th>
        <th>Movimientotipo Id</th>
        <th>Propertyarea Id</th>
        <th>Provider Id</th>
        <th>Fecharegistro</th>
        <th>Fechafactura</th>
        <th>Folio</th>
        <th>Doc</th>
        <th>Stotal</th>
        <th>Iva</th>
        <th>Gtotal</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($headmovs as $headmov)
        <tr>
            <td>{!! $headmov->inmueble_id !!}</td>
            <td>{!! $headmov->movimientotipo_id !!}</td>
            <td>{!! $headmov->propertyarea_id !!}</td>
            <td>{!! $headmov->provider_id !!}</td>
            <td>{!! $headmov->fecharegistro !!}</td>
            <td>{!! $headmov->fechafactura !!}</td>
            <td>{!! $headmov->folio !!}</td>
            <td>{!! $headmov->doc !!}</td>
            <td>{!! $headmov->stotal !!}</td>
            <td>{!! $headmov->iva !!}</td>
            <td>{!! $headmov->gtotal !!}</td>
            <td>
                {!! Form::open(['route' => ['inmovtos.destroy', $headmov->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inmovtos.show', [$headmov->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inmovtos.edit', [$headmov->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>