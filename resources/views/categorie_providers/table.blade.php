<table class="table table-responsive" id="categorieProviders-table">
    <thead>
        <tr>
            <th>Provcat Id</th>
        <th>Provider Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categorieProviders as $categorieProviders)
        <tr>
            <td>{!! $categorieProviders->provcat_id !!}</td>
            <td>{!! $categorieProviders->provider_id !!}</td>
            <td>
                {!! Form::open(['route' => ['categorieProviders.destroy', $categorieProviders->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('categorieProviders.show', [$categorieProviders->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('categorieProviders.edit', [$categorieProviders->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>