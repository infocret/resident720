<table class="table table-responsive" id="personaDocuments-table">
    <thead>
        <tr>
            <th>Persona Id</th>
        <th>Doctype Id</th>
        <th>Path</th>
        <th>Filename</th>
        <th>Link</th>
        <th>Activ</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($personaDocuments as $personaDocument)
        <tr>
            <td>{!! $personaDocument->persona_id !!}</td>
            <td>{!! $personaDocument->doctype_id !!}</td>
            <td>{!! $personaDocument->path !!}</td>
            <td>{!! $personaDocument->filename !!}</td>
            <td>{!! $personaDocument->link !!}</td>
            <td>{!! $personaDocument->activ !!}</td>
            <td>
                {!! Form::open(['route' => ['personaDocuments.destroy', $personaDocument->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('personaDocuments.show', [$personaDocument->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('personaDocuments.edit', [$personaDocument->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>