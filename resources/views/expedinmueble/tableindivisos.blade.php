<table class="table table-responsive" id="personaDirs-table">
    <thead>
        <tr>   
        <th>Indiviso</th>     
        <th>Valor</th>        
        </tr>
    </thead>
    <tbody>
    @foreach($indivisos as $indiviso)
        <tr>                 
            <td>{!! $indiviso->parametro !!}</td>
            <td>{!! $indiviso->valor !!}</td>           
        </tr>
    @endforeach
    </tbody>
</table>