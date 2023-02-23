{{-- 
	array:8 [▼
        "did" => 1
        "dcant" => 1
        "duni" => "serv"
        "dmtype" => 304
        "dmname" => " HONORARIOS ADMINISTRATIVOS "
        "ddesc" => "Cuota Administración"
        "dpunit" => "6252.0000"
        "dsubt" => "6252.0000"
      ]	
	--}}


<div class="divTable blueTable"> 	{{-- Table --}}

<div class="divTableHeading">
<div class="divTableRow">
<div class="divTableHead">Cantidad</div>
<div class="divTableHead">Uni</div>
<div class="divTableHead">Cve</div>
<div class="divTableHead">Tipo</div>
<div class="divTableHead">Descripción</div>
<div class="divTableHead">P.Unitario</div>
<div class="divTableHead">Subtotal</div>
</div>
</div>

<div class="divTableBody"> 			{{-- Body --}}

@foreach($details as $detail)

<div class="divTableRow">
<div class="divTableCell">{{ $detail->dcant}}</div>
<div class="divTableCell">{{ $detail->duni}}</div>
<div class="divTableCell">{{ $detail->dmtype}}</div>
<div class="divTableCell">{{ $detail->dmname}}</div>
<div class="divTableCell">{{ $detail->ddesc}}</div>
<div class="divTableCell">{{ $detail->dpunit}}</div>
<div class="divTableCell">{{ $detail->dsubt}}</div>
</div>

@endforeach


</div>								{{-- Body --}}

</div>   							{{-- Table --}}

<div class="blueTable outerTableFooter">
<div class="tableFootStyle">
{{-- <div class="links"><a href="#">&laquo;</a> <a class="active" href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">&raquo;</a></div> --}}
</div>
</div>

<div style="clear:both; margin:10px" > </div> {{-- Separador --}}



<div class="divTable blueTable">    {{-- Table --}}
<div class="divTableBody">          {{-- Body --}}

<div class="divTableRow">           {{-- ROW --}}

<div class="divTableCell col-xs-12 text-center" >
    {!! '<img src="data:image/png;base64,' . 
    DNS1D::getBarcodePNG($mhead->folio, "C39",2,35,array(0,0,0),true) . '" 
    alt="FolioBbarCode" style="margin-left: auto;margin-right: auto;display: block;"  />'  !!}
</div>
<div class="divTableCell col-xs-12 text-center"  >
     {!! Form::label('ltcodb', 'Folio. '.$mhead->folio,["style"=>"margin-left: auto;margin-right: auto;display: block;" ]) !!}    
</div>

</div>                              {{-- ROW --}}
</div>                              {{-- Body --}}
</div>                              {{-- Table --}}