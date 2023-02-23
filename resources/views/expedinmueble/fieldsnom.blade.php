<table style="width:100%">
  <tr>
    <th>
      {{--   {!! Form::label('ident', 'Clave:') !!}
        <p>{!! $inmueble->ident !!}</p> --}}

        {!! Form::label('name', 'Inmueble:') !!}
        <a href="{!! route('inmuebles.edit', [$inmueble->id]) !!}" 
        class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
        </a>
        <p>{!!$inmueble->ident." - ".$inmueble->nombre !!}</p>
         {!! Form::label('desc', 'Descripción:') !!}
        <p>{!! $inmueble->descripcion !!}</p>            
  </th>
</tr>  
<tr>
    <th>
    {!! Form::label('created_at', 'Desde:') !!}    
    <p>{!! $inmueble->created_at->format('l d, F Y') !!}</p>
    </th>    
</tr>    
<tr>
    <th>
        {!! Form::label('guion', '-') !!}
    </th>
</tr> 
</table>
