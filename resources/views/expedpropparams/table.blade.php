    {{-- 
    +"id": 1
    +"parametro": "dia_corte"
    +"descripcion": "Dia corte"
    +"valor": "20"
    +"observaciones": "Dia del mes en que se aplica corte y se generan movimientos de cuotas"
     --}}

<table class="table table-responsive" id="propertyparameters-table">
    <thead>
        <tr>
        {{--  <th>Id</th>  --}}
        {{--  <th>Parametro</th> --}}
        <th>Descripcion</th>
        <th>Valor</th>
        {{--  <th>Observaciones</th>    --}}
        {{--  <th>Editar</th>   --}}  
        </tr>
    </thead>
    <tbody>
    @foreach($propertyparameters as $propertyparameter)
        <tr>
           {{-- <td>{!! $propertyparameter->id !!}</td>    --}}
           {{-- <td>{!! $propertyparameter->parametro !!}</td>    --}}
           <td  title="{!! $propertyparameter->observaciones !!}">
                {!! $propertyparameter->descripcion !!}</td>   
           <td>{!! $propertyparameter->valor !!}</td>
           {{-- <td>{!! $propertyparameter->observaciones !!}</td>    --}}
            <td>
               {{--  {!! Form::open(['route' => ['pparams.destroy', $propertyparameter->id,$condomid], 'method' => 'delete']) !!} --}}
                
                <div class='btn-group'>
                    {{-- <a href="{!! route('pparams.show', [$propertyparameter->id,$condomid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                    
                    {{-- 
                    <a href="{!! route('pparams.edit', [$propertyparameter->id,$condomid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    --}

                   {{--  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                </div>

               {{--  {!! Form::close() !!} --}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>