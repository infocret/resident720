<table class="table table-responsive" id="persInmuReltipoReqDocs-table">
    <thead>
        <tr>
            <th>Rel Id</th>
            <th>Tipo de Relación</th>
            <th>Doc Id</th>
            <th>Tipo de Documento</th>
            <th>Ext</th>
            <th>Mime Type</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($persInmuReltipoReqDocs as $persInmuReltipoReqDoc)
        <tr>
            <td>{!! $persInmuReltipoReqDoc->reltipo_id !!}</td>
            <td>{!! $persInmuReltipoReqDoc->trel !!}</td>            
            <td>{!! $persInmuReltipoReqDoc->doctype_id !!}</td>
            <td>{!! $persInmuReltipoReqDoc->tdoc !!}</td>   
            <td>{!! $persInmuReltipoReqDoc->ident !!}</td>   
            <td>{!! $persInmuReltipoReqDoc->tafile !!}</td>               
            <td>
                {!! Form::open(['route' => ['persInmuReltipoReqDocs.destroy', $persInmuReltipoReqDoc->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('persInmuReltipoReqDocs.show', [$persInmuReltipoReqDoc->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('persInmuReltipoReqDocs.edit', [$persInmuReltipoReqDoc->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>