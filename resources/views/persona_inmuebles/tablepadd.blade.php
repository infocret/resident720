{{-- 
    +"id": 1
    +"nombre": "Condominio Grand Sta Fe"
    +"descripcion": "Condominio Grand Sta Fe"
 --}}
 <table class="table table-responsive" id="personaInmuebles-table">
    <thead>
        <tr>
        <th>Id</th>
        <th>Inmueble</th>        
        <th>Descripción</th>
        <th>Asignar</th>
        </tr>
    </thead>
    <tbody>
    @foreach($Inmuebles as $Inmueble)
        <tr>
            <td>{!! $Inmueble->id !!}</td>
            <td>{!! $Inmueble->nombre !!}</td>
            <td>{!! $Inmueble->descripcion !!}</td>            
            <td>
                <a href="{!! route('relperinmu.createp', [$Inmueble->id]) !!}" class='btn btn-default btn-xs'>
                    <i  class="fa fa-chain"> </i>
                </a>

               {{--  {!! Form::open(['route' => ['personaInmuebles.destroy', $personaInmueble->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('personaInmuebles.show', [$personaInmueble->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('personaInmuebles.edit', [$personaInmueble->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!} --}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>