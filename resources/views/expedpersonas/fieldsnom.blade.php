<table style="width:100%">
  <tr>
    <th>
        {!! Form::label('name', 'Nombre:') !!}
         <a href="{!! route('personas.edit', [$persona->id,'expedp']) !!}" 
        class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
        </a>
        <p>{!! $persona->name !!}</p>
        <p>{!! $persona->appat. " ".$persona->apmat !!}</p>            
  </th>
</tr>  
<tr>
    <th>
    {!! Form::label('updated_at', 'Edad:') !!}
    <p>{!! $edad  !!}</p>
    </th>    
</tr>    
<tr>
    <th>
        {!! Form::label('guion', '-') !!}
    </th>
</tr> 
</table>
