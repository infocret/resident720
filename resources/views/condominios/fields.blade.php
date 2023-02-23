{{-- <div class="box box-primary"> --}}
<div class="Row">

<!-- Ident Field -->
<div class="form-group col-sm-2">
    {!! Form::label('ident', 'Clave:') !!}
    {!! Form::text('ident', $condomi->cve, ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'8',
        'required' => 'required'
    ]) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-4">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre',  $condomi->nom, ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>


<!-- Numero de unidades max 300 -->
<div class="form-group col-sm-2">
    {!! Form::label('nunid', 'Num. Unidades:') !!}
    {!! Form::number('nunid',  $condomi->nunid, ['class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'500',
        'required' => 'required'
    ]) !!}
</div>

<!-- RFC -->
<div class="form-group col-sm-3">
    {!! Form::label('rfc', 'RFC:') !!}
    {!! Form::text('rfc',  $condomi->rfc, ['class' => 'form-control',
        'minlength'=>'10',
        'maxlength'=>'13',
        'required' => 'required'
    ]) !!}
</div>

</div>  {{-- Row 1 --}}

<div class="Row">
<!-- Codpo Field -->
<div class="form-group col-sm-4">
    {!! Form::label('codpo', 'Codigo Postal:') !!}
    {!! Form::text('codpo',  $condomi->cp, ['class' => 'form-control',
        'minlength'=>'5',
        'maxlength'=>'5',
        'required' => 'required'
    ]) !!}
</div>

<!-- Calle Field -->
<div class="form-group col-sm-4">
    {!! Form::label('calle', 'Calle:') !!}
    {!! Form::text('calle',  $condomi->calle, ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'150',
        'required' => 'required'
    ]) !!}
</div>

<!-- Numext Field -->
<div class="form-group col-sm-4">
    {!! Form::label('numExt', 'Numext:') !!}
    {!! Form::text('numExt',  $condomi->numext, ['class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'10',
        'required' => 'required'
    ]) !!}
</div>
</div> {{-- Row 2 --}}
{{-- </div> --}}



<div class="Row">    
    <div class="form-group col-sm-12">
        <H3> Administrador </H3>
    </div>
</div>



{{-- <div class="box box-primary"> --}}
<div class="row">
<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Nombre(s):') !!}
    {!! Form::text('namep',$condomi->adminom, 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>
<!-- Appat Field -->
<div class="form-group col-sm-4">
    {!! Form::label('appat', 'Aapellido Paterno :') !!}
    {!! Form::text('appatp', $condomi->admiapp, 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>
<!-- Apmat Field -->
<div class="form-group col-sm-4">
    {!! Form::label('apmat', 'Apellido Materno:') !!}
    {!! Form::text('apmatp',  $condomi->admiapm, 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>
</div> <!-- Row 3 -->

<div class="row">
<!-- Dato correo -->
<div class="form-group col-sm-4">
    {!! Form::label('dato', 'Correo:') !!}
    {!! Form::text('datemailp',$condomi->admiemail, [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'50',
        'required' => 'required'
        ]) !!}
</div>

<!-- Dato telefono -->
<div class="form-group col-sm-4">
    {!! Form::label('dato', 'Telefono:') !!}
    {!! Form::text('datphonep', $condomi->admitel, [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'50',
        'required' => 'required'
        ]) !!}
</div>


</div> <!-- Row 4 -->


{{-- </div> --}} <!-- Box Box Primary -->


<div class="Row">    
    <div class="form-group col-sm-12">
        <H3> Generación de Recibos </H3>
    </div>
</div>

{{-- <div class="box box-primary"> --}}
<div class="Row" >


<div class="form-group col-sm-3">


<!-- Dia vencimiento -->
<div class="form-group col-sm-12">
    {!! Form::label('dvence', 'Día de Vencimiento:') !!}
    {!! Form::number('dvence',  $condomi->diavencim, ['class' => 'form-control',
        'step' => "1", 'required' => 'required'
    ]) !!}
</div>

<!-- Taza Interes -->
<div class="form-group col-sm-12">
    {!! Form::label('interes', 'Taza Interes:') !!}
    {!! Form::number('interes',  $condomi->tzainter, ['class' => 'form-control',
        'step' => "0.01", 'required' => 'required'
    ]) !!}
</div>

<!-- Gen Centavos -->
<div class="form-group col-sm-12">   
    {!! Form::checkbox('cent','Gcent') !!}     
    {!! Form::label('cent', 'Generar Centavos:') !!}
</div>

</div>{{--  col --}}

<div class="form-group col-sm-3">

<!-- Descuento pronto pago-->
<div class="form-group col-sm-12">
    {!! Form::label('dppago', 'Descuento pronto pago:') !!}
    {!! Form::number('dppago', $condomi->descppag, ['class' => 'form-control']) !!}
</div>

<!-- Dias vencimiento -->
<div class="form-group col-sm-12">
    {!! Form::label('dsvencim', 'Días de Vencimiento:') !!}
    {!! Form::number('dsvencim',  $condomi->diasvenc, ['class' => 'form-control',
        'step' => "1", 'required' => 'required'
    ]) !!}
</div>

<!-- Taza Interes -->
<div class="form-group col-sm-12">
    {!! Form::label('interes2', 'Taza Interes:') !!}
    {!! Form::number('interes2', $condomi->tzainterv, ['class' => 'form-control',
        'step' => "0.01", 'required' => 'required'
    ]) !!}
</div>



</div>{{--  col --}}

<div class="form-group col-sm-3">
<!-- Numero de Recibo -->
<div class="form-group col-sm-12">
    {!! Form::label('nrecip', 'Numero de recibo:') !!}
    {!! Form::number('nrecip', $condomi->numrecib, ['class' => 'form-control',
        'step' => "1", 'required' => 'required'
    ]) !!}
</div>

<!-- Convenio  -->
{{-- 
<div class="form-group col-sm-12">
    {!! Form::label('lconvbanc', 'Convenio Bancario:') !!}
    {!! Form::text('convbanc',  $condomi->convenio, [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'50',
        'required' => 'required'
        ]) !!}
</div>
 --}}
</div> {{--  col --}}

</div> {{-- Row 5--}}
{{-- </div> --}} <!-- Box Box Primary -->





<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    @if (Session::has('propertyexpid'))          {{-- para Edit desde expediente--}}
    <a href="{!! route('expcondominio.index',$inmueble->id) !!}" class="btn btn-default">Cancelar</a>
    @else                                        {{-- para Edit desde condominios--}}
    <a href="{!! route('condominios.index') !!}" class="btn btn-default">Cancelar</a>
    @endif
</div>

<!-- Inmuebletipo Id Field se fija tipo 1 = condominio-->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('inmuebletipo_id', 'Inmuebletipo Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('inmuebletipo_id', 1, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>  --}}

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripción:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('descripcion', 'n/a', ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

