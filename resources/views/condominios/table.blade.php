<table class="table table-responsive" id="inmuebles-table">
    <thead>
        <tr>
        <th>Expediente </th>
        {{-- <th>Inmuebletipo Id</th> --}}
        <th>Ident</th>
        <th>Nombre</th>
        <th>Descripcion</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($inmuebles as $inmueble)
        <tr>            
             <td>                
                <a href="{!! route('expcondominio.index', [$inmueble->id]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-folder-open"></i></a>
            </td>
            {{-- <td>{!! $inmueble->inmuebletipo_id  !!}</td> --}}
            {{-- Us la relacion para traer la desc de tipo de inmueble --}}
           {{--  <td>{!! $inmueble->inmuebleTipo->nombre !!}</td>  --}}
            <td>{!! $inmueble->ident !!}</td>
            <td>{!! $inmueble->nombre !!}</td>
            <td>{!! $inmueble->descripcion !!}</td>
            <td>                
                <div class='btn-group'>
                    <a href="{!! route('condominios.edit', [$inmueble->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>                   
                </div>                
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $inmuebles->render() }}