<table class="table table-responsive" id="cuentastable">
    <thead>
        <tr>   
        <th>Banco</th>     
        <th>Nombre Cta</th>
        <th>Numero Cta</th>
        <th>Descripción</th>
        <th>Num.Convenio</th>
        <th>Chequera</th>
        <th>Cheque Inicial</th>
        <th>Cheque Final</th>
        <th colspan="3">Desligar</th>        
        </tr>
    </thead>
    <tbody>
    @foreach($cuentas as $cuenta)
        <tr>                
            <td>{!! $cuenta->banco !!}</td>
            <td>{!! $cuenta->ctanom !!}</td>
            <td>{!! $cuenta->ctanum !!}</td>
            <td>{!! $cuenta->ctadesc !!}</td>
            <td>{!! $cuenta->convenio !!}</td>
            <td>{!! $cuenta->checkdesc !!}</td>
            <td>{!! $cuenta->checkini !!}</td>
            <td>{!! $cuenta->checkfin !!}</td>
            <td>
            {!! Form::open(['route' => ['condomaccounts.destroy', $cuenta->id], 
            'method' => 'delete']) !!}

            <div class='btn-group'> 
            <a href="{!! route('condomaccounts.show', [$cuenta->id,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>

            <a href="{!! route('condomaccounts.edit', [$cuenta->id,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> 

            {!! Form::button('<i class="fa fa-chain-broken"></i>', 
            ['type' => 'submit', 'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('¿Seguro desea desligar esta cuenta?')"]) !!}
            </div>

            {!! Form::close() !!}
            </td>   

        </tr>
    @endforeach
    </tbody>
</table>