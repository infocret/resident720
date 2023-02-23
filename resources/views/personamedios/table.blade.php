<table class="table table-responsive" id="medioPersonas-table">
    <thead>
        <tr>
        <th>ico</th>   
        <th>Contacto</th>        
        <th>Dato</th>
        <th>Observaciones</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    {{-- {{ $personaexpid=session::get('personaexpid') }} Asinva variable --}}
    @foreach($medioPersonas as $medioPersona)
        <tr>
            <td>
             <i class="{!! $medioPersona->imgfilename !!}" style="color:grey"></i>
            </td>
            <td title="{!! $medioPersona->id !!}">{!! $medioPersona->nombre !!}</td>
            <td>{!! $medioPersona->dato !!}</td>
            <td>{!! $medioPersona->observaciones !!}</td>
            <td>
                {!! Form::open(['route' => ['personamedios.destroy',$medioPersona->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    
                <a href="{!! route('personamedios.show', [$medioPersona->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>

                  <a href="{!! route('personamedios.edit', 
                  [$medioPersona->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> 

                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Esta seguro de eliminar el registro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>