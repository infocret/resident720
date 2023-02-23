
{{-- 
// 0 => {#1425 ▼
// +"clave": "unidades"
// +"descripcion": "Numero de Unidades"
// +"observaciones": "Numero de unidades limite para un condominio"
// +"tipo": "integer"
// +"default": "0"
// +"id": 2 
--}}


<!-- Valor Field -->
<div class="form-group col-sm-6">
  {!! Form::label('desc', $paraminfo[0]->descripcion.":") !!} 
    @switch($paraminfo[0]->tipo)    
    @case('string')
        {!! Form::text('valor', null, ['class' => 'form-control']) !!}
        @break
    @case('integer')
        {!! Form::number('valor', null, ['class' => 'form-control', 'step'=>'1']) !!}
        @break
    @case('float')
        {!! Form::number('valor', null, ['class' => 'form-control', 'step'=>'0.1']) !!}
        @break
    @case('long')
        {!! Form::number('valor', null, ['class' => 'form-control', 'step'=>'any']) !!}
        @break
    @case('bolean')
        {!! Form::checkbox('valor',1,null) !!} 
        @break
    @default
    {!! Form::text('valor', null, ['class' => 'form-control']) !!}
    @endswitch
</div>

<div class="form-group col-sm-12">
 {!! Form::label('desc2', $paraminfo[0]->observaciones) !!}
 {!! Form::label('desc3', ' - Tipo: '.$paraminfo[0]->tipo) !!}    
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pparams.index', $condomid) !!}" class="btn btn-default">Cancelar</a>
</div>

<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Parametro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parametro', 'Parametro:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('parametro', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}  
</div> 

