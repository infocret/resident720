{{-- 
        "id" => 1
        "inmueble_id" => 68
        "condominio" => "COND. PUERTA DEL RIO A.C."
        "conceptservice_id" => 1
        "conceptnom" => "Cuota de Mantenimiento"
        "catmovto_id" => 1
        "movtonom" => "Cuota Mantenimiento"
        "concept_cve" => 1100
        "movto_cve" => 1101
        "procedimiento" => "sp_insert_unidmovto_contrato_1101_CuotaMntto"
        "parametros" => "n/a"
        "execauto" => 1
        "spnom" => "Aplica Cuota Mantto"
        "desc" => "Aplica cupta de mantenimiento a unidades"
        "observ" => "Ninguna"
--}}
      
<div class="form-group col-sm-12">
    <p>- Solo se agregaran procedimientos que apliquen movimientos (conceptservices - inmumovtos) registrados en contratos (unidmovtos)</p>
    <p>- Cada movimiento debe tener su propio procedimiento que lo aplique.</p>
    <p>- Los procedimientos deben estar previamente probados en la BD.</p>
    <p>- Cada procedimiento debe estar validando fecha de aplicación en contratos.</p>
    <p>- Al ejecutar un procedimiento asegurese de que no estan siendo registrados movimientos.</p>
</div>

<table class="table table-responsive" id="procedmovtos-table">
    <thead>
        <tr>
       {{--  <th>Id</th>   --}} 
       {{--  <th>CondId</th> --}}
        <th>Condominio</th>
       {{--  <th>ConceptId</th> --}}
        <th>ConceptCve</th>
       {{--  <th>MovtoId</th>     --}}    
        <th>MovtoCve</th>
        <th>Concepto/Servicio</th>
        {{-- <th>Procedimiento</th> --}}
        {{-- <th>Parametros</th> --}}        
        <th>Nombre</th>
        <th>ExecAuto</th>
       {{--  <th>Descripción</th> --}}
       {{--  <th>Observaciones</th> --}}
            <th colspan="5">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($procedmovtos as $procedmovto)
        <tr>
           {{--  <td>{!! $procedmovto->id !!}</td> --}}
           {{--  <td>{!! $procedmovto->inmueble_id !!}</td> --}}
            <td>{!! $procedmovto->condominio !!}</td>
            {{-- <td>{!! $procedmovto->conceptservice_id !!}</td> --}}
            <td>{!! $procedmovto->concept_cve !!}</td>            
            {{-- <td>{!! $procedmovto->catmovto_id !!}</td>     --}}        
            <td>{!! $procedmovto->movto_cve !!}</td>
            <td>{!! $procedmovto->conceptnom !!}</td>
            {{-- <td>{!! $procedmovto->movtonom !!}</td> --}}
            {{-- <td>{!! $procedmovto->procedimiento !!}</td> --}}
            {{-- <td>{!! $procedmovto->parametros !!}</td> --}}
            <td title="{!! $procedmovto->procedimiento !!}">
                {!! $procedmovto->spnom !!}</td>
            <td>@if ($procedmovto->execauto == '1') SI  @else   NO  @endif</td>            
            {{-- <td>{!! $procedmovto->desc !!}</td> --}}
            {{-- <td>{!! $procedmovto->observ !!}</td> --}}
            <td>
                {!! Form::open(['route' => ['procedmovtos.destroy', $procedmovto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>

                <a href="{!! route('procedmovtos.show', [$procedmovto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('procedmovtos.edit', [$procedmovto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Seguro dese eliminar el registro?')"]) !!}

{{--                 <a href="{!! route('procedmovtos.seldate', [$procedmovto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-calendar"></i></a>
 --}}
                <a href="{!! route('procedmovtos.revisarsp',  [$procedmovto->id,'REPROG']) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-calendar"></i></a>
                
                <a href="{!! route('procedmovtos.revisarsp', [$procedmovto->id,'EXECSP']) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-play"></i></a>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>