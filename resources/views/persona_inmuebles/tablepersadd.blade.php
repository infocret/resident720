<table class="table table-responsive" id="personas-table">
    <thead>
        <tr>
        <th>Id</th>        
        <th>Nombre</th>
        <th>Paterno</th>             
        <th>Materno</th>.
        <th>Asignar</th>                
        </tr>
    </thead>
    <tbody>
    @foreach($personas as $persona)
        <tr>
           {{--  <td>                
                <a href="{!! route('personaexp.index', [$persona->personaid]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-folder-open"></i></a>
            </td>      --}}   
            <td>{!! $persona->personaid !!}</td>   
            <td>{!! $persona->nombre !!}</td>
            <td>{!! $persona->paterno !!}</td>
            <td>{!! $persona->materno !!}</td>    
             <td>
                <a href="{{ route('relinmp.fromperscreate',
                 [$propertyid,$persona->personaid,
                 str_replace('/','',$persona->nombre)." ".
                 str_replace('/','',$persona->paterno)." ". 
                 str_replace('/','',$persona->materno)
                 ]) }}" 
                class='btn btn-default btn-xs'>
                    <i class="fa fa-chain"></i>
                </a>

            </td>        
        </tr>
    @endforeach
    </tbody>
</table>