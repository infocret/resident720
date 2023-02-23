
<div class="divTableCell"> {{--  Select Tipo de Movmiento  --}}
<select class="selpick" id="itmovto0' name="tmovto[]"
onchange = "putdescrip('0')" required>

@foreach($TiposMovtos as $TiposMovto)            
  <option value="{{ $TiposMovto["id"] }}" title="{{ $TiposMovto["nombre"] }}"
  {{$detail->movimientotipo_id == $TiposMovto["id"]  ? 'selected="selected"' : '' }}
  >{{ $TiposMovto["cve"] }}
  </option>            
@endforeach

</select> 

</div>
   
<div class="divTableCell">
<input id="icantidad0" name="cantidad[]" class="num" value="0" 
max="999999" required="required" 
onkeypress="return valida(event)" onChange="Calcular(this)" >
</div>

<div class="divTableCell">
<select class="selpick" codh += 'id="iunidad0' name="unidad[]" required>';
id="iunidad0" name="unidad[]" required>
@foreach($Unidades as $key => $value)            
  <option value="{{ $key }}" title="{{ $value }}"
  {{$detail->unidad == $key  ? 'selected="selected"' : '' }}
  >{{ $key }}
  </option>            
@endforeach
</select>


<div class="divTableCell">
<input type="text" class="desc"
placeholder="Describa el servicio / producto" 
id="idescripcion'+idetrow+'" name="descripcion[]" 
minlength="1" maxlength="150" required="required" > 
</div>

<div class="divTableCell">
<input class="num"  value="0" id="iprecio0'" name="precio[]" 
onkeypress="return valida(event)" onChange="Calcular(this)" 
max="99999999" required="required" >
</div> 


<div class="divTableCell">
<input class="num"  value="0" id="isubtotal0" name="subtotal[]" 
onkeypress="return valida(event)" max="999999999" required="required" readonly> 
<input type="hidden" id="icve0" name="icve[]" > 
<input type="hidden" id="icvedesc0" name="icvedesc[]" >
</div> 

<div class="divTableCell">
<button type="button" class="btn btn-danger btn-xs" onclick="borraritem(this)" >
  <span  title="Eliminar detalle" class="glyphicon glyphicon-trash fa-1g"></span>              
</button>           ';
</div>


