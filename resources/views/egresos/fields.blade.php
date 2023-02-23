{{-- **************************   Columna de 2 ******* --}}
<div class="col-md-2" style="background-color: #e6faff"> 

{{-- Fecha de aplicación --}}    
<label class="tlabel" name="ldate" id="ldate">{{ 'Fecha Aplicación: '.$fechareg }}</label>
<br><br>
{{-- Inmueble --}}    
<label class="tlabel" name="linmu_id" id="linmu_id">Inmueble:</label>         

{{-- Select Inmueble style="font-size:8pt;width:150px;height:26px" --}}
<select name="inmu_id" id="inmu_id"  class="selpick" required>
<option value="">Seleccione inmueble</option>
<option value="{{ $condomid }}" selected="selected">{{ $condomname }}</option>
{{-- @if (isset($inmuDir)&& !empty($inmuDir)) --}}
@foreach($inmuebles as $inmueble)            
    <option value="{{$inmueble->id}}"       
    title="{{ $inmueble->descripcion }}">
    {{ $inmueble->ident.'-'.$inmueble->nombre }}
    </option>            
@endforeach
</select>            
<br><br>
{{-- Area --}}            
<label class="tlabel" name="lproparea_id" id="lproparea_id">Area de aplicación:</label>  
{{-- Select Areas style="font-size:9pt;width:150px;height:26px" --}}
<select name="proparea_id" id="proparea_id" class="selpick" required>
<option value="">Seleccione Area</option>                
@foreach($PropertyAreas as $PropertyArea)            
<option value="{{$PropertyArea->id}}"
{{$PropertyArea->id == 2 ? 'selected="selected"' : '' }}    
>
{{ $PropertyArea->descripcion }}
</option>            
@endforeach
</select>
<br><br>
{{-- UPLOAD archivo PDF accept="application/pdf, application/vnd.ms-excel"--}}
<label class="tlabel" name="larchivo" id="larchivo">Subir doc/nota/factura PDF</label>  
<input class="tlabel" type="file" id="ifileup" name="Archivo" accept="application/pdf">
<br><br>
{{-- Fecha documento nota / factura --}}
<label class="tlabel" name="fechafactura" id="ilfechafactura">Fecha nota/factura:</label>  
{!! Form::date('fechafactura', $fechareg, 
    ['style' => 'font-size:8pt;width:150px;height:20px', 'id'=>'ifechafactura',
'min'=>'2000-01-01',
'max'=>'2050-12-31',            
'required' => 'required']) !!}
<br><br>
</div> {{-- Fin columna de 2 --}}

<div class="col-md-10"> {{-- *******************************   Columna de 10 ******* --}}

<div class="row" style="background-color: #e6faff">   {{--  row 2   --}}
<div class="col-md-6" align="left">  {{-- Select Proveedor --}}
<label class="tlabel" id="lprovider" name="lprovider" >Proveedor: </label>        
<select name="provider_id" id="provider_id" class="selpick"  required>
<option value="">Seleccione proveedor</option>                
@foreach($Providers as $Provider)            
    <option value="{{$Provider->id}}"
      title="{{ $Provider->rfcmoral }}">
    {{ $Provider->nomcorto.'-'.$Provider->razonsocial }}
    </option>            
@endforeach
</select>
</div>

<div class="col-md-6" align="left"> {{-- Select Concepto --}}
<label class="tlabel" id="lconceptserv" name="lconceptserv" >Concepto: </label>        
<select name="conceptserv_id" id="conceptserv_id" class="selpick" required>
<option value="">Seleccione concepto</option>               
@foreach($Concepts as $Concept)            
    <option value="{{$Concept->id}}" 
    {{$Concept->id == 6 ? 'selected="selected"' : '' }}        
    >
    {{ $Concept->cve.'-'.$Concept->name }}
    </option>            
@endforeach
</select>
</div>
<br>
<br>
</div>          {{-- fin row 2 --}}


<div class="row" style="background-color: #e6faff">  {{--  row 1   --}}
<div class="col-md-6" align="left"> {{-- Descripción --}}
<label class="tlabel" id="ldesc" name="ldesc" >Descripción: </label>
<input class="tlabel" id="description" name="description" type="text" maxlength="150" required>
</div>
<div class="col-md-6" align="left"> {{-- Observaciones --}}
<label class="tlabel" id="lobserv" name="lobserv" >Observaciones: </label>    
<input class="tlabel" id="observ" name="observ" type="text" maxlength="250" required>
</div>   
<br>
<br>
</div>                   {{-- fin row 1 --}}


<div class="Row" align="center">   {{-- row 3  --}}
 @include('egresos.detailtable')   {{-- Agrega tabla de detalle  --}}  
</div>              {{-- fin row 3 --}}  

</div>      {{-- fin columna de 10 --}}



            
{{-- ************************* campos ocultos ************************************* --}}
{{-- fecha registro --}}
<input type="hidden" value="{{ $fechareg }}" id="idate" name="date" > 
{{-- Folio --}}
<input type="hidden" value="0000000000000000000000000000" id="ifolio" name="folio" > 
<!-- Balance Field -->
<input type="hidden" value="0" id="balance" name="balance" > 
<!-- Status Field -->
<input type="hidden" value="Generado" id="status" name="status" > 
<!-- Filelink Field -->
<input type="hidden" value="N/A" id="filelink" name="filelink" > 
{{-- Sub Total --}}
<input type="hidden" value="0" id="idstotal" name="stotal" > 
{{-- IVA --}}
<input type="hidden" value="0" id="iiva" name="iva" > 
{{-- Gran Total --}}
<input type="hidden" value="0" id="igtotal" name="gtotal" > 
