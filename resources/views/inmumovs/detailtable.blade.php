   
<table class="table table-responsive" id="detailmovs-table">
    <thead>
        <tr>
        {{-- <th>Headmov Id</th>  --}}
        <th style="text-align:center;"><span style="font-size:9pt">Concepto</span></th>
        <th style="text-align:center;"><span style="font-size:9pt">Cantidad</span></th> 
        <th style="text-align:center;"><span style="font-size:9pt">Unidad</span></th>
        <th style="text-align:center;"><span style="font-size:9pt">Descripcion</span></th>
        <th style="text-align:center;"><span style="font-size:9pt">P.Unitario</span></th>
        <th style="text-align:center;"><span style="font-size:9pt">Subtotal</span></th>
        <th>
         <button type="button" class="btn btn-info btn-xs" onclick="AddItem();">
            <span title="Agregar detalle" class="glyphicon glyphicon-plus"></span>
         </button>                                    
        </th>
        </tr>
    </thead>
    <tbody>
        {{-- Si esta definido la coleccion de detalles , se esta editando--}}
        @if (isset($details)&& !empty($details)) 
            @include('inmumovs.detailrow')   
        @endif
    </tbody>
        {{-- Si esta definido la coleccion de detalles , se esta editando--}}
        @if (isset($details)&& !empty($details)) 
            @include('inmumovs.detailtablefootedit')   
        @else
            @include('inmumovs.detailtablefoot')   
        @endif
  
</table>

{{-- 
     pattern="[0-9]+([\.,][0-9]+)?"     step="0.01"
--}}