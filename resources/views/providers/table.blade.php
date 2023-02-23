<table class="table table-responsive" id="providers-table">
    <thead>
        <tr>
        <th>Exp.</th>    
        <th>Contacto</th>
        <th>Tipo</th>
        <th>Categoria</th>
        <th>Nom.corto</th>
        <th>Razonsocial</th>
        <th>RFC</th>
            <th colspan="3">Acción</th>
        </tr>
    </thead>
    <tbody>
    @foreach($providers as $providers)
        <tr>
            <td>
                <a href="{!! route('personaexp.index', [$providers->pid]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-folder-open"></i>
                </a>
            </td>
            <td>{{$providers->appat.' '.$providers->name}}</td>
            <td>{!! $providers->tipo !!}</td>
            <td>{!! $providers->categoria !!}</td>
            <td>{!! $providers->nomcorto !!}</td>
            <td>{!! $providers->razonsocial !!}</td>
            <td>{!! $providers->rfcmoral !!}</td>
            <td>
                {!! Form::open(['route' => ['providers.destroy', $providers->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('providers.show', [$providers->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('providers.edit', [$providers->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Seguro desea borrar?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>