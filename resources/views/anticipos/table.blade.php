<!--    "fechareg" => "2022-04-15 00:00:00"
        "ident" => "2101"
        "nombre" => "A-101"
        "cve" => 1100
        "shortname" => "CuotaMntto"
        "cobertura" => "Un año"
        "observ" => "Prueba"
        "folio" => "0000000000000000000000000000"
        "status" => "Generado"
        "userreg" => "user:1-Julio buendia"
        "desc" => "1100 - Cuota de Mantenimiento"
        "docto" => "n/a"
        "montoini" => "11000.0000"
        "saldo" => "11000.0000"
        "condom_id" => 116 
    -->

<div class="table-responsive">
    <table class="table" id="anticipos-table">
        <thead>
            <tr>
        <th>Registro</th>
        <th>Unidad</th>
        <th>Concepto</th>
        <th>Cobertura</th>
        <th>Estatus</th>
        <th>Monto</th>
        <th>Saldo</th>
        <th colspan="3">Acción</th>
            </tr>
        </thead>
        <tbody>
        @foreach($anticipos as $anticipo)
            <tr>
            <td>{{ \Carbon\Carbon::parse( $anticipo->fechareg)->format('d/m/Y') }}</td>
             <td>{{ $anticipo->ident.'-'.$anticipo->nombre }}</td>
            <td title="{{ $anticipo->folio }}">{{ $anticipo->desc }}</td>
            <td title="{{ $anticipo->observ }}">{{ $anticipo->cobertura }}</td>
            <td>{{ $anticipo->status }}</td>
            <td>{{ '$ '.number_format( $anticipo->montoini, 2, '.', ',') }}</td>
            <td>{{ '$ '.number_format( $anticipo->saldo, 2, '.', ',') }}</td>
                <td>
                    {!! Form::open(['route' => ['anticipos.destroy', $anticipo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                      <!--   <a href="{{ route('anticipos.show', [$anticipo->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                        <a href="{{ route('anticipos.edit', [$anticipo->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                      <!--   {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Seguro?')"]) !!} -->
                    </div>
                  <!--   {!! Form::close() !!} -->
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
