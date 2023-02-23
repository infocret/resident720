{{-- 
 array:11 [▼
        "propvalid" => 1
        "unidid" => 9
        "cve" => "189101"
        "nombre" => "101"
        "indiv1" => "0.0000"
        "indiv2" => "0.0000"
        "indiv3" => "0.0000"
        "indiv4" => "0.0000"
        "indiv5" => "0.0000"
        "parent" => 7
        "son" => 9
      ]
 --}}
<table class="table table-responsive" id="propertyvalues-table">
    <thead>
        <tr>
        <th>Unidad</th>
        <th>Nombre</th>
        <th>Indiviso1
            @if ($indivedit == "1") 
            <a href="{!! route('indivisos.create',$inmuid) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-edit"></i>
            </a>    
            @endif             
        </th>
        <th>Indiviso2</th>
        <th>Indiviso3</th>
        <th>Indiviso4</th>
        <th>Indiviso5</th>       
        {{-- <th>Editar</th> --}}
        </tr>
    </thead>
    <tbody>
    @foreach($indivisos as $propertyvalue)
        <tr>
            <td>{!! $propertyvalue->cve !!}</td>
            <td>{!! $propertyvalue->nombre !!}</td>
            <td>{!! $propertyvalue->indiv1 !!}</td>
            <td>{!! $propertyvalue->indiv2 !!}</td>
            <td>{!! $propertyvalue->indiv3 !!}</td>
            <td>{!! $propertyvalue->indiv4 !!}</td>
            <td>{!! $propertyvalue->indiv5 !!}</td>           
            {{-- <td>              
                <div class='btn-group'>                   
                    <a href="{!! route('indivisos.edit', [$propertyvalue->propvalid,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>              
                </div>
            </td> --}}
        </tr>
    @endforeach
    </tbody>
</table>