{{-- 
    "propvalid" => 1
    "unidid" => 2
    "cve" => "vj-c"
    "nombre" => "101"
    "indiv1" => "86.00000000"
    "cuota" => "2.0000"
    "parent" => 1
    "son" => 2  
 --}}
<div class="form-group col-sm-4">
    <div>
    {!! Form::label('lnunid', 'Presupuesto: $ '.$presupuesto,
    ['name'=>'lnunid','id' => 'lnunid']) !!}
     {!! Form::label('lsuma', 'Sumatoria: $ '.$tcuotas,
    ['name'=>'lsuma','id' => 'lsuma']) !!}
    </div>    
</div>

<div class="form-group col-sm-2">        
{!! Form::label('leditable', 'Editable:') !!}
{!! Form::checkbox('editable',1,$cuotedit) !!} 
</div>
<div class="form-group col-sm-2">
    <button type="button" class="btn btn-info btn-xs" onclick="validar();">
        <span title="Sumatoria" class="glyphicon glyphicon-ok"></span>
    </button> 
    <button type="button" class="btn btn-info btn-xs" onclick="generar();">
        <span title="Generar" class="glyphicon glyphicon-triangle-right"></span>
    </button>        
</div>
<div class="form-group col-sm-2">
    {!! Form::submit('Guardar', ['name'=>'bsave','id'=>'bsave','class' => 'btn btn-primary']) !!} 
</div>

<div class="form-group col-sm-2">
    <a href="{!! route('indivisos.cuotasidx',$inmuid) !!}" class="btn btn-default pull-left">Cancelar</a>
</div>  

<table class="table table-responsive" id="propertyvalues-table">
    <thead>
        <tr>
        <th style='Display:none;'>PropVal Id</th>  
        {{-- <th style='Display:none;'>Uidad Id</th>   --}}
        <th>Unidad</th>
        <th>Nombre</th>
        <th>Indiviso1</th>       
        <th>Cuota</th>     
        </tr>
    </thead>
    <tbody>
    @foreach($cuotas as $propertyvalue)
        <tr>
            {{-- <td>{!! $propertyvalue->propvalid !!}</td> --}}
            <td style='Display:none;'>
                {!! Form::text('propval_id[]', $propertyvalue->propvalid, 
                ['class' => 'form-control','readonly'=>'readonly']) !!}               
            </td> 
            {{-- <td style='Display:none;'>
                {!! Form::text('unidad_id[]', $propertyvalue->unidid, 
                ['class' => 'form-control','readonly'=>'readonly']) !!}               
            </td>        --}}      
            <td>{!! $propertyvalue->cve !!}</td>
            <td>{!! $propertyvalue->nombre !!}</td>
            <td>
                <input style="font-size:10pt;width:90px;height:25px;text-align:right" 
                id="{{ "i".$propertyvalue->propvalid }}" name="idiv1[]" 
                class="form-control input-sm" value="{{  $propertyvalue->indiv1 }}"
                readonly="readonly"
                 > 
                {{-- {!! $propertyvalue->indiv1 !!} --}}
            </td>
            <td>
            <input style="font-size:10pt;width:90px;height:25px;text-align:right" 
            type="number" id="{{ $propertyvalue->propvalid }}" name="cuota[]" 
            class="form-control input-sm" value="{{ $propertyvalue->cuota }}" 
            step="any" min="0" max="999999" onChange="validar();"  > 
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! Form::text('totcuotas', $tcuotas,
['class' => 'form-control','style'=>'visibility:hidden','id' => 'totcuotas']) !!} 
{!! Form::text('condominioid', $inmuid, 
['class' => 'form-control','style'=>'visibility:hidden']) !!}