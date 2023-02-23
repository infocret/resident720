<table class="table table-responsive" id="fileTypes-table">
    <thead>
        <tr>
            <th>Ident</th>
        <th>Nombre</th>
        <th>Ext</th>
        <th>Mimetype</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($fileTypes as $fileType)
        <tr>
            <td>{!! $fileType->ident !!}</td>
            <td>{!! $fileType->nombre !!}</td>
            <td>{!! $fileType->ext !!}</td>
            <td>{!! $fileType->mimetype !!}</td>
            <td>
                {!! Form::open(['route' => ['fileTypes.destroy', $fileType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('fileTypes.show', [$fileType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('fileTypes.edit', [$fileType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
 {{-- Agregado por JB para poder moverse entre las paginas de la consulta, la paginacion se codifico en el metodo index del controlador --}}
 {!! $fileTypes->render() !!}



