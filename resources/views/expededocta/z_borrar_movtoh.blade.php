{{-- 
  #attributes: array:17 [▼
        "uid" => 2
        "ucve" => "vj-c"
        "uname" => "101"
        "udesc" => "Departamento 103, Vista Sol"

        "hid" => 1
        "mtype" => "I"
        "ffact" => "2019-01-10 22:35:40"
        "folio" => "0021901100062520000001"
        "area" => "Administración"

        "nomcorto" => "ADP"
        "razonsocial" => "Adprocon"
        "rfcmoral" => "1234567891234"

        "stotal" => "6252.0000"
        "iva" => "0.0000"
        "gtotal" => "6252.0000"
        "status" => "GENERADO"
        "doc_link" => "n/a"
      ] 

 "id" => 7
    "name" => "Natasha"
    "appat" => "N/A"
    "apmat" => "N/A"
    "rfc" => "N/A"
    "inmueble_id" => 2
    "reltipo_id" => 1
    "nombre" => "Propietario"
    "descripcion" => "Propietario de un inmueble"      
--}} 

<div>
<div class="col-xs-6 ">  
    <img src="{{ url('img/adplogo_200h.png') }}"  alt="Logotipo">      
</div>
<div class=" col-xs-6 text-right">
    {!! Form::label('lprove', 'Proveedor',['class'=>'titgrisr']) !!}
    {!! Form::label('dncort', $mhead->nomcorto,['class'=>'dwithr']) !!}    
    {!! Form::label('drazons', $mhead->razonsocial,['class'=>'dwithr']) !!}    
    {!! Form::label('drfc', $mhead->rfcmoral,['class'=>'dwithr']) !!}
</div>
</div>


{{-- ***********************   Unidad y Propietario ************************** --}}
<div>

<div class="col-xs-6 text-center">
    <div class="tgrisl col-xs-12 " >
        {!! Form::label('luid', 'Unidad',['class'=>'titgrisl']) !!}    
    </div>
    <div class="col-xs-12 text-center" >        
        {!! Form::label('dcve', $mhead->ucve,['class'=>'dwithl']) !!}    
        {!! Form::label('dname', $mhead->uname,['class'=>'dwithl']) !!}    
        {!! Form::label('ddesc', $mhead->udesc,['class'=>'dwithl']) !!}
    </div>
</div>

<div class=" col-xs-6 text-right">
    <div class="tgrisr col-xs-12 " >  
        {!! Form::label('lprop', $propietario->nombre,['class'=>'titgrisr']) !!}    
    </div>
    <div class=" col-xs-12 text-right" > 
        {!! Form::label('dpname', $propietario->name,['class'=>'dwithr']) !!}    
        {!! Form::label('dpapp', $propietario->apmat,['class'=>'dwithr']) !!}    
        {!! Form::label('dpapm', $propietario->appat,['class'=>'dwithr']) !!}
    </div>
</div>

</div>

{{-- *********************** Mov Id - Mov Type - FechaFact - Area -Folio ************ --}}
<div>

<div class=" col-xs-6 text-left">
    <div class="tgrisl col-xs-3 " >
        {!! Form::label('lhid', 'Movto. Id',['class'=>'titgrisl']) !!}    
    </div>
    <div class="tgrisl col-xs-3 " >
        {!! Form::label('lmtype', 'Movto. Tipo',['class'=>'titgrisl']) !!}    
    </div>
    <div class="tgrisl col-xs-6 " >
        {!! Form::label('lffact', 'Fecha Aplicación',['class'=>'titgrisl']) !!}    
    </div>


    <div class=" col-xs-3 text-left" >        
        {!! Form::label('dhid', $mhead->hid,['class'=>'dwithl']) !!}           
    </div>
    <div class=" col-xs-3 text-left" >        
        {!! Form::label('dhmtype', $mhead->mtype,['class'=>'dwithl']) !!}           
    </div>
    <div class=" col-xs-6 text-left" > 

        {!! Form::label('dffact', \Carbon\Carbon::parse($mhead->ffact)->format('d/m/Y')
        ,['class'=>'dwithl']) !!}           
    </div>
   
</div>

<div class=" col-xs-6 text-right">       
        <div class="tgrisr col-xs-6 " >  
            {!! Form::label('larea', 'Area',['class'=>'titgrisr']) !!}    
        </div>
        <div class="tgrisr col-xs-6 " >  
            {!! Form::label('lfolio', 'Folio',['class'=>'titgrisr']) !!}    
        </div>
        <div class=" col-xs-6 text-right" > 
            {!! Form::label('darea', $mhead->area,['class'=>'dwithr']) !!}           
        </div>
        <div class=" col-xs-6 text-right" > 
            {!! Form::label('dfolio', $mhead->folio,['class'=>'dwithr']) !!}           
        </div>
</div>

</div>


{{-- *********************** stotal - iva - gtotal - status - doc_link ************ --}}

<div>

<div class=" col-xs-6 text-left">

    <div class="tgrisl col-xs-3 " >
        {!! Form::label('lhid', 'Estatus',['class'=>'titgrisl']) !!}    
    </div>
    <div class="tgrisl col-xs-9 " >
        {!! Form::label('lmtype', 'Document Link',['class'=>'titgrisl']) !!}    
    </div>

    <div class=" col-xs-3 text-left" >        
        {!! Form::label('dhid', $mhead->status,['class'=>'dwithl']) !!}           
    </div>
    <div class=" col-xs-9 text-left" >        
        {!! Form::label('dhmtype', $mhead->doc_link,['class'=>'dwithl']) !!}           
    </div> 
   
</div>

<div class=" col-xs-6 text-right">
    <div class="tgrisr col-xs-3 " >
        {!! Form::label('lstot', 'Subtotal',['class'=>'titgrisr']) !!}    
    </div>
    <div class="tgrisr col-xs-3 " >
        {!! Form::label('liva', 'I.V.A.',['class'=>'titgrisr']) !!}    
    </div>
    <div class="tgrisr col-xs-6 " >
        {!! Form::label('lgtot', 'Total',['class'=>'titgrisr']) !!}    
    </div>


    <div class=" col-xs-3 text-right" >  
        {!! Form::label('dstot','$ '.number_format($mhead->stotal, 2, '.', ',') 
        ,['class'=>'dwithr']) !!}           
    </div>
    <div class=" col-xs-3 text-right" >        
        {!! Form::label('diva', '$ '.number_format($mhead->iva, 2, '.', ',')
        ,['class'=>'dwithr']) !!}           
    </div>
    <div class=" col-xs-6 text-right" >        
        {!! Form::label('dgtot', '$ '.number_format($mhead->gtotal, 2, '.', ',')
        ,['class'=>'dwithr']) !!}           
    </div>

   
</div>

</div>

