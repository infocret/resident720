<!--provider id -->
<div class="form-group">
   {!! Form::label('proveedorid', 'Proveedor id:') !!}
    <p>{!! $providers->provider_id !!}</p>
</div>

<!--razon social -->
<div class="form-group">
   {!! Form::label('rsocial', 'Raxon Social:') !!}
    <p>{!! $providers->rsocial !!}</p>
</div>

<!--ofrece -->
<div class="form-group">
   {!! Form::label('ofrece', 'Ofrece:') !!}
    <p>{!! $providers->ofrece !!}</p>
</div>

<!-- Categorias -->
<div class="form-group">
    {!! Form::label('cats', 'Categorias:') !!}
    <p>{!! $providers->categorias !!}</p>
</div>

<!--Persona id -->
<div class="form-group">
   {!! Form::label('personaid', 'Prsona id:') !!}
    <p>{!! $providers->persona_id !!}</p>
</div>

<!--nombre -->
<div class="form-group">
   {!! Form::label('nombre', 'Nombe:') !!}
    <p>{!! $providers->nombre !!}</p>
</div>


<!-- Rfcmoral Field -->
<div class="form-group">
    {!! Form::label('rfcmoral', 'RFC:') !!}
    <p>{!! $providers->rfcmoral !!}</p>
</div>



{{--
    +"persona_id": 3
    +"provider_id": 25
    +"tipo": "SE"
    +"ofrece": "Servicios"
    +"nombre": "Buendia González Jose Hemilo"
    +"rsocial": "una-una mas"
    +"rfcmoral": "bugj710113hp0"
    +"categorias": "Papeleria y Oficina - Señalización - Tablaroca"
     --}}