<table class="table table-responsive" id="personas-table">
    <thead>
        <tr>
        <th>Expediente</th>
        <th>Asignacion</th>
        <th>Nombre</th>
        <th>Paterno</th>
        <th>Materno</th>
        <th>Teléfono</th>
        <th>Desde</th>  
        <th>Desligar</th>                 
        </tr>
    </thead>
    <tbody>
    @foreach($personas as $persona)
        <tr>
            <td>                
                <a href="{!! route('personaexp.index', [$persona->personaid]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-folder-open"></i></a>
            </td>
            <td>{!! $persona->asignacion !!}</td>
            <td>{!! $persona->nombre !!}</td>
            <td>{!! $persona->paterno !!}</td>
            <td>{!! $persona->materno !!}</td>
            <td>{!! $persona->telefono !!}</td>
            <td>{!! $persona->desde !!}</td> 
            <td>
                {!! Form::open(['route' => ['relinmp.expdestroy', $persona->relid,$inmuid], 
                'method' => 'delete']) !!}
                <div class='btn-group'>  
                    <a href="{!! route('relinmpd.expedit', [$persona->relid,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="fa fa-chain-broken"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 
                        'onclick' => "return confirm('¿Seguro desea desligar a esta persona?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>                     
        </tr>
    @endforeach
    @foreach($comite as $persona)
        <tr>
            <td>                
                <a href="{!! route('personaexp.index', [$persona->personaid]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-folder-open"></i></a>
            </td>
            <td>{!! $persona->asignacion !!}</td>
            <td>{!! $persona->nombre !!}</td>
            <td>{!! $persona->paterno !!}</td>
            <td>{!! $persona->materno !!}</td>
            <td>{!! $persona->telefono !!}</td>
            <td>{!! $persona->desde !!}</td> 
            <td>
                {!! Form::open(['route' => ['relinmp.expdestroy', $persona->relid,$inmuid], 
                'method' => 'delete']) !!}
                <div class='btn-group'>    
                    <a href="{!! route('relinmpd.expedit', [$persona->relid,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>                
                    {!! Form::button('<i class="fa fa-chain-broken"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 
                        'onclick' => "return confirm('¿Seguro desea desligar a esta persona?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>                     
        </tr>
    @endforeach
    </tbody>
</table>