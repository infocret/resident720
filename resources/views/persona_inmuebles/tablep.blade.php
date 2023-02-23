{{-- 
    +"inmutipo_id": 2
    +"inmutipo_name": "Departamento"
    +"inmueble_id": 2
    +"inmu_name": "Departamento 101"
    +"reltipo_id": 1
    +"reltipo_name": "Propietario"
    +"reltipo_desc": "Propietario de un inmueble"
    +"pinmu_id": 1
    +"persona_id": 1
    +"observaciones": "Ninguna"
    +"asignacion": "2018-04-21 00:00:00"
    +"baja": null
    +"Asignado": "1"
 --}}
<table class="table table-responsive" id="personaInmuebles-table">
    <thead>
        <tr>
        <th>Tipo Inmueble</th>
        <th>Inmueble</th>
        <th>Relación</th>   
        <th>Observaciones</th>     
        <th>Asignacion</th>
        <th>Desligar</th>
        </tr>
    </thead>
    <tbody>
    @foreach($personaInmuebles as $personaInmueble)
        <tr>
            <td>{!! $personaInmueble->inmutipo_name !!}</td>
            <td>{!! $personaInmueble->inmu_name !!}</td>
            <td title="{!! $personaInmueble->reltipo_desc !!}">
                {!! $personaInmueble->reltipo_name !!}</td>
            <td>{!! $personaInmueble->observaciones !!}</td>
            <td>{!! $personaInmueble->asignacion !!}</td> 
            <td>
                {!! Form::open(['route' => ['relperinmu.destroy', $personaInmueble->pinmu_id], 
                'method' => 'delete']) !!}
                <div class='btn-group'>                    
                    {!! Form::button('<i class="fa fa-chain-broken"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 
                        'onclick' => "return confirm('¿Seguro desea desligar este inmueble?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>            

                {{-- <td>
                {!! Form::open(['route' => ['relperinmu.destroy', $personaInmueble->pinmu_id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                  <a href="{!! route('relperinmu.show', [$personaInmueble->pinmu_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('relperinmu.edit', [$personaInmueble->pinmu_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> 
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td> --}}
        </tr>
    @endforeach
    </tbody>
</table>