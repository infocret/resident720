
<div class="row">  
<div class="form-group col-sm-12">
<h5 class="pull-left" style="
color: #616161;
background: #bababa;
text-shadow: #e0e0e0 1px 1px 0;
color: #616161;
background: #ECECEC;
">
 Esta operación permite editar  clave, nombre y descripción del condominio. 
 Si desea cambiar datos de su unidades,propietario o inquilino, telefonos o correos ingrese al expediente de unidad, o persona desde la pantalla de datos generales.
</h5>
</div>
</div><!-- Inmuebletipo Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('inmuebletipo_id', 'Inmuebletipo Id:') !!}
    {!! Form::text('inmuebletipo_id', null, ['class' => 'form-control']) !!}
</div> --}}



<!-- Ident Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ident', 'Clave:') !!}
    {!! Form::text('ident', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripción:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('condominios.index',$inmueble->id) !!}" class="btn btn-default">Cancelar</a>
   {{--  @if (Session::has('propertyexpid'))      para Edit desde expediente
    <a href="{!! route('unidades.index',$inmueble->id) !!}" class="btn btn-default">Cancelar</a>
    @else                                         para Edit desde inmuebles
    <a href="{!! route('inmuebles.index') !!}" class="btn btn-default">Cancelar</a>
    @endif --}}
</div>
