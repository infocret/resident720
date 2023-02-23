{{-- 
        "propvalid" => 1
        "unidid" => 2
        "cve" => "vj-c"
        "nombre" => "101"
        "indiv1" => "86.00000000"
        "cuota" => "1500.0000"
        "parent" => 1
        "son" => 2
 --}}
<table class="table table-responsive" id="propertyvalues-table">
    <thead>
        <tr>
        <th>Unidad</th>
        <th>Nombre</th>
        <th>Indiviso1</th>
        <th>Cuota
            @if ($cuotedit == "1") 
            <a href="{!! route('indivisos.ccreate',$inmuid) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-edit"></i>
            </a> 
            @endif
        </th>        
        {{-- <th>Editar</th> --}}
        </tr>
    </thead>
    <tbody>
    @foreach($cuotas as $propertyvalue)
        <tr>
            <td>{!! $propertyvalue->cve !!}</td>
            <td>{!! $propertyvalue->nombre !!}</td>
            <td>{!! $propertyvalue->indiv1 !!}</td>
            <td>{!! $propertyvalue->cuota !!}</td>            
            {{-- <td>              
                <div class='btn-group'>                   
                    <a href="{!! route('indivisos.edit', [$propertyvalue->propvalid,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>              
                </div>
            </td> --}}
        </tr>
    @endforeach
    </tbody>
</table>