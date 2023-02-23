 {{-- "egreso_id" => 943
        "bankname" => "SANTANDER"
        "acconame" => "Santander 210 Puerta Rio"
        "account" => "65506816316"
        "checkbook" => "Pago a Proveedores"
        "nom" => "Human Devolpment Services Arguello S. A. DE C. V."
        "amount" => "19140.04"
        "numcheck" => "0"
        "estatus" => "Registrado" --}}
<table class="table table-responsive" id="checkissuances-table">
    <thead>
        <tr>
        <th>Mov</th>
        <th>Banco</th>
        <th>NomCta</th>
        <th>Cuenta</th>
        <th>Chequera</th>        
        <th>A nombre de</th>
        <th>Cantidad</th>
        <th>No.Cheque</th>
        <th>Estatus</th>
        
        
            <th colspan="2">Acción</th>
        </tr>
    </thead>
    <tbody>
    @foreach($checkissuances as $checkissuance)
        <tr>
            <td>{!! $checkissuance->egreso_id !!}</td>
            <td>{!! $checkissuance->bankname !!}</td>
            <td>{!! $checkissuance->acconame !!}</td>
            <td>{!! $checkissuance->account !!}</td>
            <td>{!! $checkissuance->checkbook !!}</td>
            <td>{!! $checkissuance->nom !!}</td>
            <td>{!! '$ '.round($checkissuance->amount,2) !!}</td>
            <td>{!! $checkissuance->numcheck !!}</td>
            <td>{!! $checkissuance->estatus !!}</td>
            <td>
                {{-- {!! Form::open(['route' => ['checkissuances.destroy', $checkissuance->id], 'method' => 'delete']) !!}
                 --}}
                <div class='btn-group'>
                   
                    <a href="{!! route('checkissuances.show', [$checkissuance->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                   
                    <a href="{!! route('checkissuances.edit', [$checkissuance->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>

                    <a href="{!! route('checkissuances.chprint', [$checkissuance->id]) !!}" 
                        class='btn btn-default btn-xs' target="_blank"><i class="glyphicon glyphicon-print"></i></a>
                
                {{-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                </div>                
                {{--    {!! Form::close() !!} --}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>