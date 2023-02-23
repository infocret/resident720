<table class="table table-responsive" id="medioPersonas-table">
    <thead>
        <tr>
        <th>ico</th>   
        <th>Contacto</th>        
        <th>Dato</th>
        <th>Observaciones</th>
       {{--  <th colspan="3">Action</th> --}}
        </tr>
    </thead>
    <tbody>
    {{-- {{ $personaexpid=session::get('personaexpid') }} Asinva variable --}}
    @foreach($inmumedios as $inmumedio)
        <tr>
            <td>
             <i class="{!! $inmumedio->imgfilename !!}" style="color:grey"></i>
            </td>
            <td title="{!! $inmumedio->id !!}">{!! $inmumedio->nombre !!}</td>
            <td>{!! $inmumedio->dato !!}</td>
            <td>{!! $inmumedio->observaciones !!}</td>
           {{--  <td>
                {!! Form::open(['route' => ['inmumediosexp.destroy',$inmumedio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    
                <a href="{!! route('inmumediosexp.show', [$inmumedio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>

                  <a href="{!! route('inmumediosexp.edit', 
                  [$inmumedio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> 

                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Esta seguro de eliminar el registro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td> --}}
        </tr>
    @endforeach
    </tbody>
</table>