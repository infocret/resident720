<table class="table table-responsive" id="providers-table">
    <thead>
        <tr>
        <th>Persona Id</th>
        <th>Tipo</th>
        <th>Nomcorto</th>
        <th>Razonsocial</th>
        <th>Rfcmoral</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($providers as $providers)
        <tr>
            <td>{!! $providers->persona_id !!}</td>
            <td>{!! $providers->tipo !!}</td>
            <td>{!! $providers->nomcorto !!}</td>
            <td>{!! $providers->razonsocial !!}</td>
            <td>{!! $providers->rfcmoral !!}</td>
            <td>
                {!! Form::open(['route' => ['providers.destroy', $providers->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('providers.show', [$providers->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('providers.edit', [$providers->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>