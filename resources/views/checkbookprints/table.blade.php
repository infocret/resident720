<table class="table table-responsive" id="checkbookprints-table">
    <thead>
        <tr>
            <th>Checkbook Id</th>
        <th>Desc</th>
        <th>Imgsample</th>
        <th>Cssfile</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($checkbookprints as $checkbookprint)
        <tr>
            <td>{!! $checkbookprint->checkbook_id !!}</td>
            <td>{!! $checkbookprint->desc !!}</td>
            <td>{!! $checkbookprint->imgsample !!}</td>
            <td>{!! $checkbookprint->cssfile !!}</td>
            <td>
                {!! Form::open(['route' => ['checkbookprints.destroy', $checkbookprint->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('checkbookprints.show', [$checkbookprint->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('checkbookprints.edit', [$checkbookprint->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>