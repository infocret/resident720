<table class="table table-responsive" id="inmuebleDirs-table">
    <thead>
        <tr>
            <th>Inmueble Id</th>
        <th>Location Id</th>
        <th>Codpo Id</th>
        <th>Pais</th>
        <th>Calle</th>
        <th>Numext</th>
        <th>Piso</th>
        <th>Numint</th>
        <th>Referencia1</th>
        <th>Referencia2</th>
        <th>Linkmapa</th>
        <th>Imagenmapa</th>
        <th>Observaciones</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($inmuebleDirs as $inmuebleDir)
        <tr>
            <td>{!! $inmuebleDir->inmueble_id !!}</td>
            <td>{!! $inmuebleDir->location_id !!}</td>
            <td>{!! $inmuebleDir->codpo_id !!}</td>
            <td>{!! $inmuebleDir->pais !!}</td>
            <td>{!! $inmuebleDir->calle !!}</td>
            <td>{!! $inmuebleDir->numExt !!}</td>
            <td>{!! $inmuebleDir->piso !!}</td>
            <td>{!! $inmuebleDir->numInt !!}</td>
            <td>{!! $inmuebleDir->referencia1 !!}</td>
            <td>{!! $inmuebleDir->referencia2 !!}</td>
            <td>{!! $inmuebleDir->linkmapa !!}</td>
            <td>{!! $inmuebleDir->imagenMapa !!}</td>
            <td>{!! $inmuebleDir->observaciones !!}</td>
            <td>
                {!! Form::open(['route' => ['inmuebleDirs.destroy', $inmuebleDir->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inmuebleDirs.show', [$inmuebleDir->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inmuebleDirs.edit', [$inmuebleDir->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>