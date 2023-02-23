<table style="width:100%">
  <tr>
    {{-- <th><!-- Id Field -->       
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $persona->id !!}</p>       
    </th> --}}
    <th><!-- Name Field -->
        {!! Form::label('name', 'Name:') !!}
        <p>{!! $persona->name !!}</p>
    </th> 
    <th><!-- Appat Field --> 
        {!! Form::label('appat', 'Appat:') !!}
        <p>{!! $persona->appat !!}</p></th>

  <th> <!-- Apmat Field -->
    {!! Form::label('apmat', 'Apmat:') !!}
    <p>{!! $persona->apmat !!}</p>    
  </th>
</tr>  
<tr>
    <th><!-- Genero Field -->
    {!! Form::label('genero', 'Genero:') !!}
    <p>{!! $persona->genero !!}</p>    
    </th>
    <th><!-- Datebirth Field -->
    {!! Form::label('datebirth', 'Datebirth:') !!}
    <p>{!! $persona->datebirth !!}</p>
    </th>
    <th><!-- Lugarnac Field -->
    {!! Form::label('lugarnac', 'Lugarnac:') !!}
    <p>{!! $persona->lugarnac !!}</p>
    </th>    
</tr>    
<tr>
    <th><!-- Rfc Field -->
    {!! Form::label('rfc', 'Rfc:') !!}
    <p>{!! $persona->rfc !!}</p>  
    </th>
    <th><!-- Curp Field -->
    {!! Form::label('curp', 'Curp:') !!}
    <p>{!! $persona->curp !!}</p>
    </th>
    <th><!-- Nss Field -->
    {!! Form::label('nss', 'Nss:') !!}
    <p>{!! $persona->nss !!}</p>
    </th>    
</tr>
<tr>
    <th><!-- Created At Field -->
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $persona->created_at !!}</p>
    </th>
    <th><!-- Updated At Field -->
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $persona->updated_at !!}</p>
    </th>   
{{--     <th><!-- edad Field -->
    {!! Form::label('updated_at', 'Edad:') !!}
    <p>{!! $edad  !!}</p>
    </th>  --}}  
    
</tr>     
</table>
{{-- <div class="form-group">
</div>
 --}}