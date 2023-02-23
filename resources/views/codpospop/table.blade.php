<table class="table table-responsive" id="codPos-table">
    <thead>
               {{-- Filtros  Valor por cada campo - Codigo agregado por JB--}}
    <tr>
    {!! Form::open(['route' => ['codPos.index'], 'method' => 'get']) !!}
                      
        <th>{!! Form::text('cp', null, ['class' => 'form-control', 'placeholder'=>'CodPostal']) !!}</th>
        <th>{!! Form::text('ciudad', null, ['class' => 'form-control', 'placeholder'=>'ciudad']) !!}</th>
        <th>{!! Form::text('estado', null, ['class' => 'form-control', 'placeholder'=>'estado']) !!}</th>
        <th>{!! Form::text('municipio', null, ['class' => 'form-control', 'placeholder'=>'municipio']) !!}</th>
        <th>{!! Form::text('tipo', null, ['class' => 'form-control', 'placeholder'=>'tipo']) !!}</th>
        <th>{!! Form::text('asentamiento', null, ['class' => 'form-control', 'placeholder'=>'asentamiento']) !!}</th>  
        {{-- <th>{!! Form::text('search2', null, ['class' => 'form-control', 'placeholder'=>'Buscar...']) !!} --}}
        </th>  
        <th>
        <button type='sunmit' id='search-btn' class="btn btn-flat">
            <i class="fa fa-search"></i></button>             
        </th>    
    {!! Form::close() !!} 
    </tr> 
        {{-- Fin  Filtros  Valor por cada campo--}}
            
            {{-- Cabecera --}}
        <tr>
            <th>Cp</th>
        <th>Ciudad</th>
        <th>Estado</th>
        <th>Municipio</th>
        <th>Tipo</th>
        <th>Asentamiento</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($codPos as $codPo)
        <tr>
            <td>{!! $codPo->cp !!}</td>
            <td>{!! $codPo->ciudad !!}</td>
            <td>{!! $codPo->estado !!}</td>
            <td>{!! $codPo->municipio !!}</td>
            <td>{!! $codPo->tipo !!}</td>
            <td>{!! $codPo->asentamiento !!}</td>
            <td>
                {!! Form::open(['route' => ['codPos.destroy', $codPo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('codPos.show', [$codPo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('codPos.edit', [$codPo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{-- Agregado por JB para poder moverse entre las paginas de la consulta, la paginacion se codifico en el metodo index del controlador --}}
 {!! $codPos->render() !!}