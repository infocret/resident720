<table class="table table-responsive" id="inmuebles-table">
    <thead>
        <tr>
        <th>Expediente </th>
        {{-- <th>Inmuebletipo Id</th> --}}
        <th>Ident</th>
        <th>Nombre</th>
       <th>Descripcion</th>
       <th>Editar</th>
        {{-- <th colspan="3">Action</th> --}}
       </tr>
    </thead>
    <tbody>
    @foreach($unidades as $inmueble)
        <tr>
             <td>                
                <a href="{!! route('expunidad.index', [$inmueble->id]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-folder-open"></i></a>
            </td>
           {{--  <td>{!! $inmueble->inmuebletipo_id !!}</td> --}}
            <td>{!! $inmueble->ident !!}</td>
            <td>{!! $inmueble->nombre !!}</td>
            <td>{!! $inmueble->descripcion !!}</td>
            <td>
                 <a href="{!! route('unidades.edit', [$inmueble->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            </td>
                {{--            
                {!! Form::open(['route' => ['inmuebles.destroy', $inmueble->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inmuebles.show', [$inmueble->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inmuebles.edit', [$inmueble->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td> --}}
        </tr>
    @endforeach
    </tbody>
</table>