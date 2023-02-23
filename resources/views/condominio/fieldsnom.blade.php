<table style="width:100%">
  <tr>
    <th>
        {!! Form::label('name', 'Inmueble:') !!}
        <p>{!! $inmueble->nombre !!}</p>
         {!! Form::label('desc', 'Descripción:') !!}
        <p>{!! $inmueble->descripcion !!}</p>            
  </th>
</tr>  
<tr>
    <th>
    {!! Form::label('updated_at', 'Registrado:') !!}
    <p>{!! $edad  !!}</p>
    </th>    
</tr>    
<tr>
    <th>
        {!! Form::label('guion', '-') !!}
    </th>
</tr> 
</table>
