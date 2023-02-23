{{-- 
"presupid" => 1
"movtipid" => 1
"cve" => 101
"nombre" => " PESONAL DE SEGURIDAD "
"monto" => "0.0000" 
style='Display:none;'
--}}
<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-group col-sm-4" style="text-align:right; ">           
        <a class="btn btn-default pull-left" onclick="validar();">Total: $</a>        
        {!! Form::text('total', 0,['id'=>'total','class' => 'pull-left','readonly'=>'readonly']) !!}  
    </div>
    
    <div class="form-group col-sm-2">        
        {!! Form::label('leditable', 'Editable:') !!}
        {!! Form::checkbox('editable',1,$editpre) !!} 
    </div>
    <div class="form-group col-sm-2">       
        <a href="{!! route('presup.inicializa',$inmuid) !!}" class="btn btn-default pull-left">Reiniciar</a>
    </div>
    <div class="form-group col-sm-2">       
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary pull-right']) !!}
    </div>
    <div class="form-group col-sm-2">       
        <a href="{!! route('presup.index',$inmuid) !!}" class="btn btn-default pull-right">Cancelar</a>
    </div>    
</div>
<table class="table table-responsive" id="presupuestos-table">
    <thead>
        <tr>
        <th style='Display:none;'>Presup Id</th> 
        <th style='Display:none;'>Condom Id</th> 
        <th style='Display:none;'>Movtipo Id</th>
        <th>Cve</th>
        <th style="min-width: 0px; max-width: 100px;">Nombre</th>
        <th style="min-width: 0px; max-width: 100px;text-align: center;">Monto</th>
        {{-- <th colspan="3">Action</th>  --}}
        </tr> 
    </thead>
    <tbody>
    @foreach($presupuestos as $presupuesto)
        <tr>
            <td style='Display:none;'>
                {!! Form::text('presup_id[]', $presupuesto->presupid, 
                ['class' => 'form-control','readonly'=>'readonly']) !!}               
            </td> 
            <td style='Display:none;'>
                {!! Form::text('inmueble_id[]', $inmuid, 
                ['class' => 'form-control','readonly'=>'readonly']) !!} </td>
            <td style='Display:none;'>
                {!! Form::text('movtipo_id[]', $presupuesto->movtipid, 
                ['class' => 'form-control','readonly'=>'readonly']) !!}</td> 
            <td>
                {{-- {!! Form::text('cve[]', $presupuesto->cve, 
                ['class' => 'form-control','readonly'=>'readonly']) !!} --}}
                 {{ $presupuesto->cve }}
            </td>
            <td style="min-width: 0px; max-width: 100px;">
                {{-- {!! Form::text('nombre[]', $presupuesto->nombre, 
                ['class' => 'form-control','readonly'=>'readonly']) !!} --}}
                {{ $presupuesto->nombre }}
            </td> 
            <td style="min-width: 0px; max-width: 80px;">    
            <div class="form-group col-sm-2" style="text-align:left; ">
                <label >$</label>
            </div>    
            <div class="form-group col-sm-10" > 
            <input ';
            style="font-size:10pt;width:105px;height:25px;text-align:right;" type="number"
            id="{{$presupuesto->presupid  }}" name="monto[]" 
            class="form-control input-sm" value="{{ $presupuesto->monto }}" step="any"
            min="0" max="999999.999" width="20" onChange="validar();"> 
            </div>          
            </td>
           {{-- 
            <td>
                {!! Form::open(['route' => ['presup.destroy', $presupuesto->id,$inmuid], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('presup.show', [$presupuesto->id,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('presup.edit', [$presupuesto->id,$inmuid]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
            --}}
        </tr>
    @endforeach
    </tbody>
</table>