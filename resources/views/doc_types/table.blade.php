<table class="table table-responsive" id="docTypes-table">
    <thead>
        <tr>           
           {{--  <th>Filetype Id</th>            --}} 
            <th>Nombre</th>
            <th>Sizemin</th>
            <th>Sizemax</th>
            <th>Tipo Archivo</th>
            <th>MimeType</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($docTypes as $docType)
        <tr>           
            {{-- <td>{!! $docType->filetype_id !!}</td> --}}
            <td>{!! $docType->nombre !!}</td>
            <td>{!! $docType->sizemin !!}</td>
            <td>{!! $docType->sizemax !!}</td>
            <td>{!! $docType->ident !!}</td>
            <td>{!! $docType->mime !!}</td>
            <td>
                {!! Form::open(['route' => ['docTypes.destroy', $docType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('docTypes.show', [$docType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('docTypes.edit', [$docType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>