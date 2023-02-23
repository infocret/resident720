{{-- 
        "mailistid" => 1
        "condid" => 7
        "unidid" => 10
        "unidcve" => "18902"
        "uninom" => "102"
        "listipo" => "SendNews"
        "correo" => "alfred@coreeo.com" 
--}}
<table class="table table-responsive" id="maillists-table">
    <thead>
        <tr>
        <th>Cve</th>
        <th>Unidad</th>
        <th>Tipo</th>
        <th>Email</th>
        <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($maillists as $maillist)
        <tr>
            <td>{!! $maillist->unidcve !!}</td>
            <td>{!! $maillist->uninom !!}</td>            
            <td>
                @if ($maillist->listipo == "SendNews")
                    Noticias
                @else
                    Recibos
                @endif                
            </td>
            <td>{!! $maillist->correo !!}</td>
            <td>
                {!! Form::open(['route' => ['correolist.destroy', $maillist->mailistid,$inmuid], 'method' => 'delete']) !!}
                <div class='btn-group'>
                  {{--   <a href="{!! route('correolist.show', [$maillist->mailistid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                    <a href="{!! route('correolist.edit', [$maillist->mailistid,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Desea eliminar este correo de la lista?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>