{{-- ######################## Table ########################################### --}}
<div class="divTable BlueRows">
{{-- ######################## Head ############################################ --}}
<div class="divTableHeading">

<div class="divTableRow">
<div class="divTableHead">Concepto</div>
<div class="divTableHead">Cantidad</div>
<div class="divTableHead">Unidad</div>
<div class="divTableHead">Descripcion</div>
<div class="divTableHead">P.Unitario</div>
<div class="divTableHead">Subtotal</div>
<div class="divTableHead">
<button type="button" class="btn btn-info btn-xs" onclick="AddItem();">
<span title="Agregar detalle" class="glyphicon glyphicon-plus"></span>
</button>
</div>
</div> {{-- row --}}

</div> {{-- heading --}}

{{-- ###################### Body ############################################## --}}
<div class="divTableBody" id="body">

</div> {{-- body --}}
{{-- ###################### Foot ############################################## --}}  
<div class="divTableFoot tableFootStyle">

<div class="divTableRow">
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">SubTotal</div>
<div class="divTableCell">
<label class="textpie" name="ilstotal" id="ilstotal">$ 0.00</label>
</div>
<div class="divTableCell">
<button type="button" class="btn btn-danger btn-xs" onclick="ClearAll();">
    <span title="Reiniciar" class="glyphicon glyphicon-refresh "></span>
</button>                                       
</div>
</div> {{-- row --}}

<div class="divTableRow">
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">
  <input type="checkbox" id="ichiva"  
  onclick="alteriva()" checked="true">IVA   
</div>  
<div class="divTableCell">
  <label class="textpie" name="iliiva" id="iliiva">$ 0.00</label>
</div>  
<div class="divTableCell">&nbsp;</div>
</div> {{-- row --}}  

<div class="divTableRow">
<div class="divTableCell">
{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!} 
</div>
<div class="divTableCell">
<a href="{!! route('egresos.selperiod',[$condomid]) !!}" class="btn btn-default">Cancelar</a> 
</div>
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">Total</div>
<div class="divTableCell">

<label class="textpie" name="ilgtotal" id="ilgtotal">$ 1.00</label>

<input class="num" value="0.00" name="nuevotot"  id="nuevotot" 
 max="99999999" maxlength="9" required="required"
 onkeypress="return valida(event)" > 


</div>
<div class="divTableCell">
<button type="button" class="btn btn-info btn-xs" onclick="recalc();">
<span title="Recalcular" class=" glyphicon glyphicon-play "></span>
</button>
</div>
</div> {{-- row --}} 

</div> {{-- foot --}}

</div> {{-- table --}}

<div id='pmode1'>
<p>Está trabajando en modo de un solo concepto, el campo [Total] es editable y los campos [Subtotal], [IVA] y [Precio unitario] se calculan a partir de ese dato, el campo [Cantidad] de fija a 1, y puede modificarlo si gusta.</p>
<p>1.- Escriba el monto del campo [Total]</p>
<p>2.- Modifique si es necesario el campo [Cantidad]</p>
</div>

<div id='pmode0'>
<p>Está trabajando en modo de varios conceptos, el campo [Total] NO es editable y los campos [Subtotal], [IVA] y [Precio unitario] se calculan a partir de la sumatoria de subtotales, y cada fila se calcula independientemente.</p>
<p>En cada fila de concepto:</p>
<p>1.- Seleccione [Concepto]</p>
<p>2.- Escriba [Cantidad]</p> 
<p>3.- Seleccione [Unidad de medida]</p>
<p>4.- Modifique si desea [Descripción]</p>
<p>5.- Escriba [Precio unitario]</p>
<p>6.- El [Subtotal] se calculara automáticamente, así como el [IVA] y [Total]</p>
</div>	