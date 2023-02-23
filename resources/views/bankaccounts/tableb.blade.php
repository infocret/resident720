   {{-- "id" => 1
        "shortname" => "BANAMEX"
        "square" => "Nuevo Vallarta"
        "ident" => "138001"
        "name" => "Banamex 5024"
        "account" => "1409615024"
        "clabe" => "012180014096150240"
        "description" => "Cta de recepción de pagos"
        "account_type" => "ING"
        "accounting" => "CtaContable"
        "allow_overdrafts" => 1 --}}
<table class="table table-responsive" id="catmovtos-table">
    <thead>
        <tr>
        <th>Id</th>
        <th>Banco</th>
        <th>Sucursal</th>
        <th>Nombre</th>
        <th>CLABE</th>
        <th>Cuenta</th>        
       {{--  <th>Descripción</th> --}}

            <th colspan="3">Acción</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bankaccounts as $bankaccount)
        <tr>
            <td title="{!! $bankaccount->description !!}">{!! $bankaccount->id !!}</td>
            <td>{!! $bankaccount->shortname !!}</td>
            <td>{!! $bankaccount->square !!}</td>
            <td title="{!! $bankaccount->name !!}">{!! $bankaccount->ident !!}</td>
            <td>{!! $bankaccount->clabe !!}</td>
            <td>{!! $bankaccount->account !!}</td>
           {{--  <td>{!! $bankaccount->description !!}</td> --}}
            <td>
                {!! Form::open(['route' => ['bankaccounts.destroy', $bankaccount->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('bankaccounts.show', [$bankaccount->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('bankaccounts.edit', [$bankaccount->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>