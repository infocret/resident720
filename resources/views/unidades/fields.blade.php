<div class="row">  
<div class="form-group col-sm-12">
<h5 class="pull-left" style="
color: #616161;
background: #bababa;
text-shadow: #e0e0e0 1px 1px 0;
color: #616161;
background: #ECECEC;
">
 Esta operación crea una unidad y las personas asignadas como propietario e inquilino,
 asi como los medios de contacto de ambas personas, y relaciona esta nueva unidad al condominio del expediente abierto, registra los correos a la lista de envios de noticias y/o de recibos.
</h5>
</div>
</div>
<!-- Inmuebletipo Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('inmuebletipo_id', 'Inmuebletipo Id:') !!}
    {!! Form::text('inmuebletipo_id', null, ['class' => 'form-control']) !!}
</div> --}}
 <div class="row">  
    <div class="form-group col-sm-6">   
    {!! Form::label('inmuebletipo_id', 'Tipo de Unidad:') !!} 
     <select name="inmuebletipo_id" id="inmuebletipo_id" class="form-control"  required>
     <option value="">Seleccione Tipo Unidad</option>
    @if (isset($inmutipoid)&& !empty($inmutipoid)) {{-- para Edit --}}

          @foreach($inmutipos as $inmutipo)   
            
            <option value="{{$inmutipo->id}}"
            {{$inmueble->inmuebletipo_id == $inmutipo->id ? 'selected="selected"' : '' }}
            >{{ $inmutipo->nombre }}
            </option>            

        @endforeach

    @else                                            {{-- para Create --}}

        @foreach($inmutipos as $inmutipo)            
            <option value="{{$inmutipo->id}}">{{ $inmutipo->nombre }}</option>            
        @endforeach

    @endif
    </select> 
    </div>

<!-- Ident Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ident', 'Subcuenta/Unidad:') !!}
    {!! Form::text('ident', null, ['class' => 'form-control']) !!}
</div>

</div> <!-- Row 1 -->

<div class="row">
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Unidad:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>
<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripción:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Referencia bancaria para deposito -->
<div class="form-group col-sm-6">
    {!! Form::label('lbancref', 'Referencia Bancaria:') !!}
    {!! Form::text('bancref', null, ['class' => 'form-control',
    'minlength'=>'1',
    'maxlength'=>'50',
    'required' => 'required'
    ]) !!}
</div>

</div> <!-- Row 2 -->

<section class="content-header">
<H1> Nombre del propietario</H1>
</section>
<div class="box box-primary">
<div class="row">
<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Nombre(s):') !!}
    {!! Form::text('namep', 'N/A', 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>
<!-- Appat Field -->
<div class="form-group col-sm-4">
    {!! Form::label('appat', 'Aapellido Paterno :') !!}
    {!! Form::text('appatp', 'N/A', 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>
<!-- Apmat Field -->
<div class="form-group col-sm-4">
    {!! Form::label('apmat', 'Apellido Materno:') !!}
    {!! Form::text('apmatp', 'N/A', 
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
    {!! Form::text('datemailp', 'N/A', [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'50',
        'required' => 'required'
        ]) !!}
</div>

<!-- Dato telefono -->
<div class="form-group col-sm-4">
    {!! Form::label('dato', 'Telefono Casa:') !!}
    {!! Form::text('datphonep', 'N/A', [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'50',
        'required' => 'required'
        ]) !!}
</div>

<!-- Dato telefono -->
<div class="form-group col-sm-4">
    <div>
    {!! Form::checkbox('sendnewsp','News') !!}
    {!! Form::label('lsendnewsp', 'Emitir Noticias') !!}
    </div>
    <div>
    {!! Form::checkbox('sendrecipp','Recips') !!}
    {!! Form::label('lsendrecipp', 'Emitir Recibo') !!}
    </div>
    <div>
    {!! Form::checkbox('miembroc','Miembro') !!}
    {!! Form::label('lsendrecipp', 'Miembro de Comite') !!}
    </div>
</div>


</div> <!-- Row 4 -->


</div> <!-- Box Box Primary -->


<section class="content-header">
<H1> Nombre del Inquilino</H1>
</section>
<div class="box box-primary">
<div class="row">
<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Nombre(s):') !!}
    {!! Form::text('namei', 'N/A', 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>

<!-- Appat Field -->
<div class="form-group col-sm-4">
    {!! Form::label('appat', 'Aapellido Paterno :') !!}
    {!! Form::text('appati', 'N/A', 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>

<!-- Apmat Field -->
<div class="form-group col-sm-4">
    {!! Form::label('apmat', 'Apellido Materno:') !!}
    {!! Form::text('apmati', 'N/A', 
    ['class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'25',
        'required' => 'required'
    ]) !!}
</div>
</div> <!-- Row 5 -->
</div> <!-- Box Box Primary -->

<div class="row">
<!-- Dato correo -->
<div class="form-group col-sm-4">
    {!! Form::label('dato', 'Correo:') !!}
    {!! Form::text('datemaili', 'N/A', [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'50',
        'required' => 'required'
        ]) !!}
</div>

<!-- Dato telefono -->
<div class="form-group col-sm-4">
    {!! Form::label('dato', 'Telefono:') !!}
    {!! Form::text('datphonei', 'N/A', [
        'class' => 'form-control',
        'minlength'=>'3',
        'maxlength'=>'50',
        'required' => 'required'
        ]) !!}
</div>

<!-- Dato telefono -->
<div class="form-group col-sm-4">
        <div>
        {!! Form::checkbox('sendnewsi','News') !!}
        {!! Form::label('lsendnewsi', 'Emitir Noticias') !!}
        </div>
        <div>
        {!! Form::checkbox('sendrecipi','Recips') !!}
        {!! Form::label('lsendrecipi', 'Emitir Recibo') !!}
        </div>
</div>
</div> <!-- Row 6 -->
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('unidades.index') !!}" class="btn btn-default">Cancelar</a>
</div>

