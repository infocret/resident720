<table class="table table-responsive" id="inmuebleImagesids-table">
    <thead>
        <tr>
            <th>Inmueble Id</th>
        <th>Link</th>
        <th>Filename</th>
        <th>Activ</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($inmuebleImagesids as $inmuebleImagesids)
        <tr>
            <td>{!! $inmuebleImagesids->inmueble_id !!}</td>
            <td>{!! $inmuebleImagesids->link !!}</td>
            <td>{!! $inmuebleImagesids->filename !!}</td>
            <td>{!! $inmuebleImagesids->activ !!}</td>
            <td>
                {!! Form::open(['route' => ['inmuebleImagesids.destroy', $inmuebleImagesids->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inmuebleImagesids.show', [$inmuebleImagesids->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inmuebleImagesids.edit', [$inmuebleImagesids->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>