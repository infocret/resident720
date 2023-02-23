{{-- 
"presupid" => 1
"movtipid" => 1
"cve" => 101
"nombre" => " PESONAL DE SEGURIDAD "
"monto" => "0.0000" 
style='Display:none;'
--}}
<!-- Submit Field -->
<table class="table table-responsive" id="presupuestos-table">
    <thead>
        <tr>        
        <th>Cve</th>
        <th>Nombre</th>
        <th>Monto</th>
        {{-- <th colspan="3">Action</th>  --}}
        </tr> 
    </thead>
    <tbody>
    @foreach($presupuestos as $presupuesto)
        <tr>
            
            <td> {{ $presupuesto->cve }} </td>
            <td> {{ $presupuesto->nombre }} </td> 
            <td> {{'$ '.number_format($presupuesto->monto, 2, '.', ',') }} </td>
           {{-- 
            <td>
                {!! Form::open(['route' => ['presup.destroy', $presupuesto->id,$inmuid], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('presup.show', [$presupuesto->id,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('presup.edit', [$presupuesto->id,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
            --}}
        </tr>
    @endforeach
    </tbody>
</table>