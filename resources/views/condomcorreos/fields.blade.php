
@if (isset($unidades)==true)  {{--CREATE: True si se declaro --}}
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    {!!Form::select('inmueble_id',
 		$unidades,null,
        ['placeholder'=>'Seleccione Unidad','id'=>'inmueble_id',
        'class' => 'form-control','required' => 'required'])!!}  
</div>		
@endif

<!-- Listtype Field -->
<div class="form-group col-sm-6">
    {!! Form::label('listtype', 'Lista de Envio:') !!}
 	{!!Form::select('listtype',
 		['SendNews'=>'Noticias','SendReci'=>'Recibos'],null,
        ['placeholder'=>'Seleccione Tipo de envio','id'=>'listtype',
        'class' => 'form-control','required' => 'required'])!!}      
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Correo:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('correolist.index',$inmuid) !!}" class="btn btn-default">Cancelar</a>
</div>

{{-- EDIT: False si no se ha declarado --}}
@if (isset($unidades)==false)  
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>
@endif 
<div class="form-group col-sm-6">
    {!! Form::label('condom_id', 'Condominio Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('condom_id', $inmuid, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>