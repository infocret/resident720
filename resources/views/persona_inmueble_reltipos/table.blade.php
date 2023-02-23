<table class="table table-responsive" id="personaInmuebleReltipos-table">
    <thead>
        <tr>
            <th>Ident</th>
        <th>Nombre</th>
        <th>Descripcion</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($personaInmuebleReltipos as $personaInmuebleReltipo)
        <tr>
            <td>{!! $personaInmuebleReltipo->ident !!}</td>
            <td>{!! $personaInmuebleReltipo->nombre !!}</td>
            <td>{!! $personaInmuebleReltipo->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['personaInmuebleReltipos.destroy', $personaInmuebleReltipo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('personaInmuebleReltipos.show', [$personaInmuebleReltipo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('personaInmuebleReltipos.edit', [$personaInmuebleReltipo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>