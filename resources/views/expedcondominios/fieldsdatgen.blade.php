{{-- 
    // inmbueble
    // "id" => 1
    // "inmuebletipo_id" => 1
    // "ident" => "GrdStafe"
    // "nombre" => "Condominio Grand Sta Fe"
    // "descripcion" => "Condominio Grand Sta Fe"
    // "created_at" => "2018-04-21 07:30:35"
    // "updated_at" => "2018-04-21 07:30:35"
    // "deleted_at" => null       
 --}}
<table style="width:100%">
<tr>
    <th><!-- Genero Field -->
    {!! Form::label('genero', 'Genero:') !!}
    <p>{!! $inmueble->genero !!}</p>    
    </th>
    <th><!-- Datebirth Field -->
    {!! Form::label('datebirth', 'Nacio:') !!}
    {{-- <p>{!! $inmueble->datebirth->diffForHumans() !!}</p> --}}
    <p>{!! $inmueble->datebirth->format('l d, F Y') !!}</p>
    </th>
    <th><!-- Lugarnac Field -->
    {!! Form::label('lugarnac', 'Nacio en:') !!}
    <p>{!! $inmueble->lugarnac !!}</p>
    </th>    
</tr>    
<tr>
    <th><!-- Rfc Field -->
    {!! Form::label('rfc', 'RFC:') !!}
    <p>{!! $inmueble->rfc !!}</p>  
    </th>
    <th><!-- Curp Field -->
    {!! Form::label('curp', 'CURP:') !!}
    <p>{!! $inmueble->curp !!}</p>
    </th>
    <th><!-- Nss Field -->
    {!! Form::label('nss', 'NSS:') !!}
    <p>{!! $inmueble->nss !!}</p>
    </th>    
</tr>
<tr>
    <th><!-- Created At Field -->
    {!! Form::label('created_at', 'Registrado:') !!}
    <p>{!! $inmueble->created_at->format('l d, F Y') !!}</p>
    </th>
    <th><!-- Updated At Field -->
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $inmueble->updated_at->format('l d, F Y') !!}</p>
    </th>   
{{--     <th><!-- edad Field -->
    {!! Form::label('updated_at', 'Edad:') !!}
    <p>{!! $edad  !!}</p>
    </th>  --}}  
    
</tr>     
</table>