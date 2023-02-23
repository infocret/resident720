
<table  class="table table-responsive" id="headmovs-table">
    <thead>
        <tr>
        <th>Inmueble / Area</th>        
        <th>Proveedor / Documento </th>
        <th>Cantidades</th>
            <th colspan="3">Acción</th>
        </tr>
    </thead>
    <tbody>
    @foreach($headmovs as $headmov)
        <tr>
            <td>          {{--  Inmueble --}}
            @if ($ver["cve"]==1) 
                <div class="form-group col-sm-12">
                {!! Form::label('lcve', 'Clave: '.$headmov->cve,
                ['style' => 'font-size:10pt']) !!} 
                </div>
            @endif
            @if ($ver["inmunombre"]==1) 
                <div class="form-group col-sm-12">
                {!! Form::label('linmu', 'Inmueble: '.$headmov->inmunombre,
                ['style' => 'font-size:10pt']) !!}                            
                </div>
            @endif
            @if ($ver["area"]==1) 
                <div class="form-group col-sm-12">
                {!! Form::label('larea', 'Area: '.$headmov->area,
                ['style' => 'font-size:10pt']) !!} 
                </div>
            @endif
            </td>
            <td>
            @if ($ver["provider"]==1) 
                <div class="form-group col-sm-12">
                {!! Form::label('lprovider', 'Poveedor: '.$headmov->provider,
                ['style' => 'font-size:10pt']) !!} 
                </div>
            @endif
            @if ($ver["fechaplica"]==1) 
                <div class="form-group col-sm-12">
                {!! Form::label('lfechaplica', 'Aplicación: '.$headmov->fechaplica,
                ['style' => 'font-size:10pt']) !!}                                            
                </div>
            @endif
            @if ($ver["fechafact"]==1) 
                <div class="form-group col-sm-12">
                {!! Form::label('lfechafact', 'Facturado: '.$headmov->fechafact,
                ['style' => 'font-size:10pt']) !!}                            
                </div>
            @endif
                @if ($ver["folio"]==1) 
                <div class="form-group col-sm-12">
                {!! Form::label('lfolio', 'Folio: '.$headmov->folio,
                ['style' => 'font-size:10pt']) !!}                            
                </div>
            @endif
            </td>
            <td>
            @if ($ver["subtotal"]==1) 
                <div class="form-group col-sm-12">
                {!! Form::label('lsubtotal', 'Subtotal: '.round($headmov->subtotal,2),
                ['style' => 'font-size:10pt']) !!} 
                </div>
            @endif                
            @if ($ver["iva"]==1) 
                <div class="form-group col-sm-12">
                {!! Form::label('liva', 'IVA: '.round($headmov->iva,2),
                ['style' => 'font-size:10pt']) !!}                            
                </div>
            @endif                
            @if ($ver["gtotal"]==1) 
                <div class="form-group col-sm-12">
                {!! Form::label('lgtotal', 'Gran Total: '.round($headmov->gtotal,2),
                ['style' => 'font-size:10pt']) !!}                            
                </div>
            @endif
            </td>
            <td>
                {!! Form::open(['route' => ['inmovtos.destroy', $headmov->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                <a href="{!! $headmov->doc !!}" class='btn btn-default btn-xs' target="_blank"><i class="glyphicon glyphicon-save-file"></i></a>
                <a href="{!! route('inmovtos.show', [$headmov->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('inmovtos.edit', [$headmov->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>