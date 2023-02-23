<table style="width:100%">
<tr>
    <th><!-- Genero Field -->
    {!! Form::label('genero', 'Genero:') !!}
    <p>{!! $persona->genero !!}</p>    
    </th>
    <th><!-- Datebirth Field -->
    {!! Form::label('datebirth', 'Nacio:') !!}
    {{-- <p>{!! $persona->datebirth->diffForHumans() !!}</p> --}}
    <p>{!! $persona->datebirth->format('l d, F Y') !!}</p>
    </th>
    <th><!-- Lugarnac Field -->
    {!! Form::label('lugarnac', 'Nacio en:') !!}
    <p>{!! $persona->lugarnac !!}</p>
    </th>    
</tr>    
<tr>
    <th><!-- Rfc Field -->
    {!! Form::label('rfc', 'RFC:') !!}
    <p>{!! $persona->rfc !!}</p>  
    </th>
    <th><!-- Curp Field -->
    {!! Form::label('curp', 'CURP:') !!}
    <p>{!! $persona->curp !!}</p>
    </th>
    <th><!-- Nss Field -->
    {!! Form::label('nss', 'NSS:') !!}
    <p>{!! $persona->nss !!}</p>
    </th>    
</tr>
<tr>
    <th><!-- Created At Field -->
    {!! Form::label('created_at', 'Registrado:') !!}
    <p>{!! $persona->created_at->format('l d, F Y') !!}</p>
    </th>
    <th><!-- Updated At Field -->
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $persona->updated_at->format('l d, F Y') !!}</p>
    </th>   
{{--     <th><!-- edad Field -->
    {!! Form::label('updated_at', 'Edad:') !!}
    <p>{!! $edad  !!}</p>
    </th>  --}}  
    
</tr>     
</table>