<table class="table table-responsive" id="providers-table">
    <thead>
        <tr>                            
        <th>Ofrece</th>
        <th>Razon Social</th>      
        <th>RFC</th>
        <th>Categorias</th>        
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($providers as $providers)
        <tr>
            <td>{!! $providers->ofrece !!}</td>            
            <td>{!! $providers->rsocial !!}</td>          
            <td>{!! $providers->rfcmoral !!}</td>
            <td>{!! $providers->categorias !!}</td>
            <td>
                {!! Form::open(['route' => ['proveedor.destroy', 
                $providers->provider_id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('proveedor.show', [$providers->provider_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('proveedor.edit', [$providers->provider_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{-- 
    +"persona_id": 3
    +"provider_id": 24
    +"tipo": "SE"
    +"ofrece": "Servicios"
    +"nombre": "Buendia González Jose Hemilo"
    +"rsocial": "otra-otra prueba"
    +"rfcmoral": "123456789123"
    +"categorias": "Acabados - Administración - Albañileria - Aluminio - Camaras DVR"
    <td>{!! $providers->persona_id !!}</td>
    <td>{!! $providers->provider_id !!}</td>  
    <td>{!! $providers->nombre !!}</td>          
 --}}