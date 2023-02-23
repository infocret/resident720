<table class="table table-responsive" id="propertyparameters-table">
    <thead>
        <tr>       
        <th>Parametro</th>
        <th>Valor</th>       
        </tr>
    </thead>
    <tbody>
    @foreach($propertyparameters as $propertyparameter)
        <tr>            
            @switch($propertyparameter->parametro)
            @case('rfc')
                <td>RFC</td>               
                @break
            @case('unidades')
                <td>Núm. Unidades</td>
                @break
            @case('diasvencim_a')
                <td>Días Vencimiento</td>
                @break    
            @case('taza_a')
                <td>Taza de Interes</td>
                @break       
            @case('gen_cent')
                <td>Generar Centavos</td>
                @break
            @case('desc_ppago')
                <td>Desc Pronto Pago</td>
                @break                            
            @case('diasvencim_b')
                <td>Dias Vencimiento</td>
                @break 
            @case('taza_b')
                <td>Taza de Interes</td>
                @break         
            @case('num_recip')
                <td>Número de Recibo</td>
                @break                                                            
            @default               
                {{ $paramname = $propertyparameter->parametro }}
            @endswitch
            <td>{!! $propertyparameter->valor !!}</td>
           
        </tr>
    @endforeach
    </tbody>
</table>