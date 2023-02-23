<table class="table table-responsive" id="propertyareas-table">
    <thead>
        <tr>
       {{--  <th>Inmueble Id</th> --}}
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Planta</th>
        <th>Filename</th>
        <th>Filepath</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($propertyareas as $propertyareas)
        <tr>
            {{-- <td>{!! $propertyareas->inmueble_id !!}</td> --}}
            <td>{!! $propertyareas->nombre !!}</td>
            <td>{!! $propertyareas->descripcion !!}</td>
            <td>{!! $propertyareas->planta !!}</td>
            <td>{!! $propertyareas->filename !!}</td>
            <td>{!! $propertyareas->filepath !!}</td>
            <td>
                {!! Form::open(['route' => ['propertyareas.destroy', $propertyareas->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('propertyareas.show', [$propertyareas->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('propertyareas.edit', [$propertyareas->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>