{{-- 
 array:11 [▼
        "propvalid" => 1
        "unidid" => 9
        "cve" => "189101"
        "nombre" => "101"
        "indiv1" => "0.0000"
        "indiv2" => "0.0000"
        "indiv3" => "0.0000"
        "indiv4" => "0.0000"
        "indiv5" => "0.0000"
        "parent" => 7
        "son" => 9
      ]
 --}}
<div class="form-group col-sm-4">
    <div>
    {!! Form::label('lnunid', 'Unidades: '.$numunids.' declaradas.',['name'=>'lnunid','id' => 'lnunid']) !!}
    </div>
    <div>
    {!! Form::label('lindiv', 'Suma indiviso1: ',['name'=>'lindiv','id' => 'lindiv']) !!} 

    </div>
</div>
<div class="form-group col-sm-2">        
{!! Form::label('leditable', 'Editable:') !!}
{!! Form::checkbox('editable',1,$indivedit) !!} 
</div>
<div class="form-group col-sm-2">
    <button type="button" class="btn btn-info btn-xs" onclick="validar();">
        <span title="Validar" class="glyphicon glyphicon-ok"></span>
    </button>      
</div>
<div class="form-group col-sm-2">
    {!! Form::submit('Guardar', ['name'=>'bsave','id'=>'bsave','class' => 'btn btn-primary']) !!} 
</div>
<div class="form-group col-sm-2">
    <a href="{!! route('indivisos.index',$inmuid) !!}" class="btn btn-default pull-left">Cancelar</a>
</div>    

<table class="table table-responsive" id="propertyvalues-table">
    <thead>
        <tr>
        <th style='Display:none;'>PropVal Id</th>  
        {{-- <th style='Display:none;'>Uidad Id</th>   --}}
        <th>Unidad</th>
        <th>Nombre</th>
        <th>Indiviso1</th>       
        </tr>
    </thead>
    <tbody>
    @foreach($indivisos as $propertyvalue)
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
            <input style="font-size:10pt;width:90px;height:25px;text-align:right" type="number"
            id="{{ $propertyvalue->propvalid }}" name="indiv[]" 
            class="form-control input-sm" value="{{ $propertyvalue->indiv1 }}" step="any"
            min="0" max="999999" onChange="validar();" > 
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
 {!! Form::text('totindiv', 0,
  ['class' => 'form-control','style'=>'visibility:hidden','id' => 'totindiv']) !!}    
 {!! Form::text('condominioid', $inmuid, 
 ['class' => 'form-control','style'=>'visibility:hidden']) !!}