{{-- 
    +"freg": ""
    +"fapp": ""
    +"cve": "2103"
    +"unid": "A-201"
    +"lant": "0.0000"
    +"lact": "0.0000"
    +"lts": "0.0000"
    +"price": "0.0000"
    +"cost": "0.0000"
    +"estatus": "Pendiente"

    <th>Cuota
            @if ($cuotedit == "1") 
            <a href="{!! route('indivisos.ccreate',$inmuid) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-edit"></i>
            </a> 
            @endif
        </th>        
        
 --}}
<table class="table table-responsive" id="propertyvalues-table">
    <thead>
        <tr>
        <th>Registro</th>
        <th>Aplicacion</th>
        <th>Unidad</th>
        <th>Lect.Anter.</th>
        <th>Lect.Actual</th>
        <th>Cant.Lts.</th>
        <th>Precio x Lt.</th>
        <th>Monto</th>
        <th>Estatus</th>        
        <th>Acción</th>
        </tr>
        </tr>
    </thead>
    <tbody>
    @foreach($gasconsums as $gasc)
        <tr>
            <td>{!! $gasc->freg !!}</td>
            <td>{!! $gasc->fapp !!}</td>
            <td>{!! $gasc->cve.' - '. $gasc->unid !!}</td> 
            <td>
                @if (is_null($gasc->lant))
                {{ number_format(0.00, 2, '.', ',') }}               
                @else
                {{ number_format($gasc->lant, 2, '.', ',') }}               
                @endif                
            </td>                
            <td> {{ number_format( $gasc->lact, 2, '.', ',') }} </td>    
            <td> {{ number_format( $gasc->lts, 2, '.', ',') }}</td>    
            <td> {{ '$ '.number_format( $gasc->price, 2, '.', ',') }}</td>
            <td> {{ '$ '.number_format( $gasc->cost, 2, '.', ',') }}</td>
            <td> {{ $gasc->estatus }}</td>
            <td>
                {{-- 
            {!! Form::open(['route' => ['catmovtos.destroy', 0], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('catmovtos.show', [0]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                 --}}
                 @if ($gasc->estatus == 'Pendiente')
                    <a href="{!! route('gasconsum.gcreate', $gasc->unidid) !!}" 
                        class='btn btn-default btn-xs'>
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                @else
                    <a href="{!! route('edoscta.indexd',
                    [$gasc->inmchid,$gasc->freg,$gasc->freg]) !!}" class='btn btn-default btn-xs'>
                        <i class="glyphicon glyphicon-list-alt"></i>
                    </a>                
                @endif
                {{-- 
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                 --}}
                
                </div>
                {!! Form::close() !!}
            </td>

        </tr>
    @endforeach
    </tbody>
</table>