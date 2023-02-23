{{-- 
array:1 [▼
  0 => array:14 [▼
    "propvalid" => 1
    "unidid" => 9
    "cve" => "189101"
    "nombre" => "101"
    "dimencion" => "200.0000"
    "porcentaje" => "1.0000"
    "valor" => "800000.0000"
    "presupuesto" => "0.0000"
    "cuota" => "1200.0000"
    "p1" => "2"
    "p2" => "0"
    "p3" => "0"
    "parent" => 7
    "son" => 9
  ]
]
 --}}
<table class="table table-responsive" id="propertyvalues-table">
    <thead>
        <tr>
        <th>Unidad</th>
        <th>Nombre</th>
        <th>M2</th>
        <th>%</th>
        <th>$</th>
        <th>Presupuesto</th>
        <th>Cuota</th>       
        <th>P1</th>
        <th>P2</th>
        <th>P3</th>
        <th>Editar</th>
        </tr>
    </thead>
    <tbody>
    @foreach($propertyvalues as $propertyvalue)
        <tr>
            <td>{!! $propertyvalue->cve !!}</td>
            <td>{!! $propertyvalue->nombre !!}</td>
            <td>{!! $propertyvalue->dimencion !!}</td>
            <td>{!! $propertyvalue->porcentaje !!}</td>
            <td>{!! $propertyvalue->valor !!}</td>
            <td>{!! $propertyvalue->presupuesto !!}</td>
            <td>{!! $propertyvalue->cuota !!}</td>           
            <td>{!! $propertyvalue->p1 !!}</td>
            <td>{!! $propertyvalue->p2 !!}</td>
            <td>{!! $propertyvalue->p3 !!}</td>
            <td>              
                <div class='btn-group'>                   
                    <a href="{!! route('ivalues.edit', [$propertyvalue->propvalid,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>              
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>