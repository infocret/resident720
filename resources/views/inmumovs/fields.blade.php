<div class="row"> {{-- Primer Fila / ROW  --}}
<div class="col-md-9" style="overflow:auto">  {{-- Columna de 9  --}}
 <table class="table table-responsive" id="tableup"> {{-- Tabla superior --}}
    <thead>       
    </thead>
    <tbody>
        <tr>
            <td>
                {!! Form::label('linmueble_id', 'Inmueble:',
                ['style' => 'font-size:10pt']) !!}              {{-- Select Inmueble --}}

                {!!Form::select('inmueble_id',$Inmuebles,null,
                ['placeholder'=>'Seleccione inmueble','id'=>'inmueble', 
                'class' => 'form-control','style' => 'font-size:9pt;width:200px;height:26px',
                'required' => 'required'])!!}
            </td>
            <td>
                {!! Form::label('lpropertyarea_id', 'Area de aplicación:',
                ['style' => 'font-size:10pt']) !!}             {{-- Select Area --}}

                {!!Form::select('propertyarea_id',
                  ['placeholder'=>'Seleccione Area'],null,['id'=>'proparea',
                'class' => 'form-control','style' => 'font-size:9pt;width:200px;height:26px',
                'required' => 'required'])!!} 
              
            </td>
            <td>
                {!! Form::label('lprovider_id', 'Proveedor:',
                ['style' => 'font-size:10pt']) !!}              {{-- Select Proveedor --}}

                {!!Form::select('provider_id',$Providers,null,
                ['placeholder'=>'Seleccione Proveedor','id'=>'provider', 
                'class' => 'form-control', 'style' => 'font-size:9pt;width:200px;height:26px',
                'required' => 'required'])!!}      
            </td>
        </tr>
    </tbody>
</table>
{{-- ********************************************************************** --}}
            @include('inmumovs.detailtable')  {{-- Agrega tabla de detalle  --}}
{{-- ********************************************************************** --}} 
  <table class="table table-responsive" id="tablefileup">   {{--  Tabla inferior --}}
    <thead>
    </thead>
    <tbody>      
        <tr>
            <td>                                    {{-- UPLOAD archivo PDF --}}
            <div id="idivfile" class="form-group col-sm-12"> 
            {!! Form::label('archivo','Subir documento de nota/factura en formato PDF',
            ['id' => 'ilfileup']) !!}    
            {!! Form::file('Archivo', null,['class' => 'form-control','id' => 'ifileup','accept'=>'.pdf']) !!}
            </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </tbody>
</table>
</div> {{-- Fin Columna de 9  --}}
{{-- ********************************************************************* --}}
<div class="col-md-3"> {{-- Columna lateral izquierda de 3  --}}

<div class="form-group col-sm-12">                {{-- Folio --}}
    {!! Form::label('folio', 'Folio:',['style' => 'font-size:10pt']) !!}
    {!! Form::text('folio', "000", ['class' => 'form-control', 
    'style' => 'font-size:9pt;width:200px;height:26px', 'id'=>'ifolio',
    'minlength'=>'1',
    'maxlength'=>'25', 
    'required' => 'required']) !!}
</div>    

<!-- Fechafactura Field -->
<div class="form-group col-sm-12">              {{-- Fecha documento nota / factura --}}
    {!! Form::label('fechafactura', 'Fecha nota/factura:',['style' => 'font-size:10pt']) !!}
    {!! Form::date('fechafactura', $fechareg, ['class' => 'form-control',
    'style' => 'font-size:9pt;width:200px;height:26px', 'id'=>'ifechafactura',
    'min'=>'2000-01-01',
    'max'=>'2050-12-31',            
    'required' => 'required']) !!}
</div>

<!-- Fecharegistro Field -->
<div class="form-group col-sm-12">              {{-- Fecha de aplicación --}}
    {!! Form::label('fecharegistro', 'Fecha Aplicación:',['style' => 'font-size:10pt']) !!}
    {!! Form::date('fecharegistro', $fechareg, ['class' => 'form-control',
    'style' => 'font-size:9pt;width:200px;height:26px', 'id'=>'ifecharegistro', 
    'min'=>'2000-01-01',
    'max'=>'2050-12-31',     
    'required' => 'required']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">            {{-- Boton  Guardar / cancelar --}}
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inmovtos.index') !!}" class="btn btn-default">Cancel</a>
</div>

</div> {{-- Fin de Columna lateral izquierda de 3  --}}
                        
 {!! Form::text('doc', 'N/A', ['class' => 'form-control',     
 'style' => 'font-size:9pt;width:200px;height:26px;visibility:hidden',
 'id'=>'idoc']) !!}                                     {{-- Link Docto --}}

  {!! Form::number('stotal', 0, ['class' => 'form-control', 
             'id' => 'idstotal','step'=>'any',
             'style' => 'font-size:9pt;width:200px;height:26px;text-align:right;visibility:hidden', 
             'max'=>'99999999',
             'required' => 'required']) !!}              {{-- Gran Total --}}

   {!! Form::number('iva', 0, ['class' => 'form-control',
             'id' => 'iiva','step'=>'any',
             'style' => 'font-size:9pt;width:200px;height:26px;text-align:right;visibility:hidden',
             'max'=>'99999999',
             'required' => 'required']) !!}              {{-- IVA --}}

{!! Form::number('gtotal', 0, ['class' => 'form-control',
             'id' => 'igtotal','step'=>'any',
             'style' => 
             'font-size:9pt;width:200px;height:26px;text-align:right;visibility:hidden',
             'max'=>'99999999',
             'required' => 'required']) !!}              {{-- Gran Total --}}
                          
</div>  {{-- Fin de Primer Fila / ROW  --}}


