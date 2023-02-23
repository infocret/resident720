<table class="table table-responsive" id="personaImagesids-table">
    <thead>
        <tr>
        <th>ImgID</th>
        <th>Persona Id</th>
        <th>Link</th>
        <th>Filename</th>
        <th>Activ</th>
        <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($personaImagesids as $personaImagesids)
        <tr>
            <td>
                <img width="40px" src="{!!  env('PATH_IMGIDS').$personaImagesids->filename !!}"  
                class="img-rounded" alt="{!! env('PATH_IMGIDS').$personaImagesids->filename !!}">
            </td>
            <td>{!! $personaImagesids->persona_id !!}</td>
            <td>{!! $personaImagesids->link !!}</td>
            <td>{!! $personaImagesids->filename !!}</td>
            <td>{!! $personaImagesids->activ !!}</td>
            <td>
                {!! Form::open(['route' => ['personaImagesids.destroy', $personaImagesids->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('personaImagesids.show', [$personaImagesids->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('personaImagesids.edit', [$personaImagesids->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>