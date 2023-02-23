<table style="width:100%">
  <tr>
    <th>
      {{--   {!! Form::label('ident', 'Clave:') !!}
        <p>{!! $inmueble->ident !!}</p> --}}
        {!! Form::label('name', 'Cve-Nombre:') !!}
        {{-- <a href="{!! route('condominios.edit', [$inmueble->id]) !!}"  --}}
       {{--  <a href="{!! route('unidades.edit', [$inmueble->id]) !!}" 
        class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
        </a> --}}
        <p>{!!$inmueble->ident." - ".$inmueble->nombre !!}</p>
         {!! Form::label('desc', 'Descripción:') !!}
        <p>{!! $inmueble->descripcion !!}</p> 
        {!! Form::label('lndiv1', 'Indiviso1:') !!}
        <p>{!! number_format($indiv1, 4, '.', ',') !!}</p>     
        {!! Form::label('lcuota', 'Cuota:') !!}
        <p>{!! '$ '.number_format($cuota, 2, '.', ',') !!}</p>                                
  </th>
</tr>  
{{-- <tr>
    <th>
    {!! Form::label('created_at', 'Desde:') !!}    
    <p>{!! $inmueble->created_at->format('l d, F Y') !!}</p>
    </th>    
</tr>     --}}
<tr>
    <th>
        {!! Form::label('guion', '-') !!}
    </th>
</tr> 
</table>
