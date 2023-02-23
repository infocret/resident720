
@foreach($details as $detail) 

<tr >  

<td style="text-align:center;" width="30" nowrap > {{-- Tipo de Movimientos --}}
<select 
class="selectpicker" style="font-size:8pt" 
id="{{ "itmovto".$detail->id }}" name="tmovto[]" 
required>

@foreach($TiposMovtos as $TiposMovto)            
  <option value="{{ $TiposMovto["id"] }}" title="{{ $TiposMovto["nombre"] }}"
  {{$detail->movimientotipo_id == $TiposMovto["id"]  ? 'selected="selected"' : '' }}
  >{{ $TiposMovto["cve"] }}
  </option>            
@endforeach

</select>     
</td>        

<td style="text-align:center;" width="20" nowrap >      {{-- Cantidad --}}

<input ';
style="font-size:9pt;width:70px;height:18px;text-align:right" type="number"
id="{{ "icantidad".$detail->id }}" name="cantidad[]" 
class="form-control input-sm" value="{{ round($detail->cantidad,2) }}" step="any"
min="0.1" max="999999" required="required" 
onkeypress="return valida(event)" onChange="Calcular(this)" > 

</td>          

<td style="text-align:center;" width="30" nowrap >      {{-- Unidades --}}     
<select class="selectpicker" style="font-size:8pt"
id="{{ "iunidad".$detail->id }}" name="unidad[]" required>

@foreach($Unidades as $key => $value)            
  <option value="{{ $key }}" title="{{ $value }}"
  {{$detail->unidad == $key  ? 'selected="selected"' : '' }}
  >{{ $key }}
  </option>            
@endforeach

</select>
</td> 

<td style="text-align:center;" width="200" nowrap >               {{-- Descripción --}} 
<input style="font-size:9pt;width:200px;height:18px;text-align:left" type="text" 
class="form-control input-sm" value="{{ $detail->descripcion }}"
id="{{ "idescripcion".$detail->id }}" name="descripcion[]" 
minlength="1" maxlength="150" required="required" > 
</td>  

<td style="text-align:center;" width="30" nowrap >                {{-- Precio --}} 
<input style="font-size:9pt;width:70px;height:18px;text-align:right" type="number" 
class="form-control input-sm" step="any" value="{{ round($detail->preciounit,2) }}" 
id="{{ "iprecio".$detail->id }}" 
name="precio[]" onkeypress="return valida(event)" onChange="Calcular(this)" 
min="0.1" max="99999999" required="required" > 
</td> 

<td style="text-align:center;" width="40" nowrap >                {{-- Subtotal --}}  
<input style="font-size:9pt;width:80px;height:18px;text-align:right" type="number" 
class="form-control input-sm" step="any" value="{{ round($detail->subtot,2) }}" 
id="{{ "isubtotal".$detail->id }}" 
name="subtotal[]" onkeypress="return valida(event)" 
min="0.1" max="999999999" required="required" > 
</td>        

<td style="text-align:left;" width="20" nowrap >                 {{-- Boton Eliminar --}} 
<button type="button" class="btn btn-danger btn-xs" onclick="borraritem(this);" >
<span  title="Eliminar detalle"
class="glyphicon glyphicon-trash fa-1g"></span>
</button> 

</td>
</tr>

@endforeach

