
<!-- Tipo Field -->
<div class="form-group col-sm-8">
    {!! Form::label('tipo', 'Tipo de proveedor:') !!}
    <label class="radio-inline">
        {!! Form::radio('tipo', "SE", null) !!} Servicios
    </label>

    <label class="radio-inline">
        {!! Form::radio('tipo', "VP", null) !!} Venta productos y/o materiales
    </label>

    <label class="radio-inline">
        {!! Form::radio('tipo', "SV", null) !!} Servcios y Venta
    </label>

</div>

<!-- Nomcorto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nomcorto', 'Nombre corto:') !!}
    {!! Form::text('nomcorto', null, [
    'class' => 'form-control',
    'minlength'=>'2',
    'maxlength'=>'10',
    'required' => 'required'
    ]) !!}
</div>

<!-- Razonsocial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('razonsocial', 'Razon social:') !!}
    {!! Form::text('razonsocial', null, [    
    'class' => 'form-control',
    'minlength'=>'2',
    'maxlength'=>'40',
    'required' => 'required'
    ]) !!}
</div>

<!-- Rfcmoral Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rfcmoral', 'RFC:') !!}
    {!! Form::text('rfcmoral', null, [     
    'class' => 'form-control',
    'minlength'=>'12',
    'maxlength'=>'13',
    'required' => 'required'
    ]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-4">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('proveedor.index',Session::get('personaexpid')) !!}" 
    class="btn btn-default">Cancelar</a>
</div>

<!-- Persona Id Field -->
{{-- <div class="form-group col-sm-4">  --}}
    {{-- {!! Form::label('persona_id', 'Persona Id:') !!}  --}}
    {!! Form::text('persona_id', Session::get('personaexpid'), 
    ['class' => 'form-control','style'=>'visibility:hidden']) !!}
{{-- </div>  --}}
