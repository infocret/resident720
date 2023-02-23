{{-- 
"presupid" => 1
"movtipid" => 1
"cve" => 101
"nombre" => " PESONAL DE SEGURIDAD "
"monto" => "0.0000" 
style='Display:none;'
--}}
<table class="table table-responsive" id="presupuestos-table">
    <thead>
        <tr>        
        <th>Cve</th>
        <th>Nombre</th>
        <th>Monto</th>        
        </tr> 
    </thead>
    <tbody>
    @foreach($presupuestos as $presupuesto)
        <tr>            
            <td> {{ $presupuesto->cve }} </td>
            <td> {{ $presupuesto->nombre }} </td> 
            <td> {{'$ '.number_format($presupuesto->monto, 2, '.', ',') }} </td>         
        </tr>
    @endforeach
    </tbody>
</table>