<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lpersona_id', 'Persona de contacto:') !!}
    <select name="persona_id" id="persona_id" class="form-control"  required>
    <option value="">Seleccione una persona </option>
    
    @if (isset($providers)&& !empty($providers)) 
        @foreach($personas as $persona)            
            <option value="{{$persona->id}}"
                {{ $providers->persona_id == $persona->id ? 'selected="selected"' : '' }}
                >{{ $persona->appat.'-'.$persona->apmat.'-'.$persona->name}}
            </option>            
        @endforeach
    @else
        @foreach($personas as $persona)            
            <option value="{{$persona->id}}">               
                {{ $persona->appat.'-'.$persona->apmat.'-'.$persona->name}}
            </option>            
        @endforeach
    @endif
    </select>
</div>



<!-- Nomcorto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nomcorto', 'Nombre corto:') !!}
    {!! Form::text('nomcorto', null, ['class' => 'form-control','maxlength'=>'10']) !!}
</div>

<!-- Razonsocial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('razonsocial', 'Razon social:') !!}
    {!! Form::text('razonsocial', null, ['class' => 'form-control','maxlength'=>'60']) !!}
</div>

<!-- Rfcmoral Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rfcmoral', 'RFC(moral):') !!}
    {!! Form::text('rfcmoral', null, ['class' => 'form-control','maxlength'=>'13']) !!}
</div>


<!-- Tipo Field -->
<div class="form-group col-sm-6" align="center">

    <H4>
        Asigne tipo y categorías del proveedor
    </H4> 


    {!! Form::label('tipo', 'Tipo:') !!}
    <label class="radio-inline">
        {!! Form::radio('tipo', "SE", null) !!} Servicios
    </label>

    <label class="radio-inline">
        {!! Form::radio('tipo', "VP", null) !!} Venta productos y/o materiales
    </label>

    <label class="radio-inline">
        {!! Form::radio('tipo', "SV", null) !!} Servcios y Venta
    </label>
    
    @include('providers.tablecats')
    

        
        {{-- ini - Boton que llama a ventana modal  --}}
         <a  data-toggle="modal" 
            data-target="#creapop"> Agregar categoría 
            <i class="glyphicon glyphicon-plus-sign"></i>
        </a>


</div>



<div class="form-group col-sm-6" align="center">
 <h4>  Asigne cuenta Bancaria  </h4>
 <h6>
    Si no existe la cuenta debe darse de alta en la operación [Cuentas bancarias].
</h6>
</div>


<!-- Select de Bancos  -->
<div class="form-group col-sm-6">   
{!! Form::label('bank_id', 'Banco:') !!}     
 <select name="bank_id" id="bank_id" class="form-control"  required>
 <option value="">Seleccione Banco</option>

@if (isset($account)&& !empty($account))        {{-- para edit --}}
  @foreach($bancos as $key => $value) 
  <option value="{{$key}}"
    {{ $account->bankid == $key ? 'selected="selected"' : '' }}
    >{{ $value }}
  </option> 
  @endforeach   
@else                                               {{-- para create --}}
  @foreach($bancos as $key => $value)            
      <option value="{{$key}}">{{ $value }}</option>            
  @endforeach
@endif
</select> 
</div>


<div class="form-group col-sm-6">   
{!! Form::label('lbankaccount_id', 'Cuenta:') !!}    
 <select name="bankaccount_id" id="bankaccount_id" class="form-control"  required>
 <option value="">Seleccione Cuenta</option>
 </select>
</div>


<div class="form-group col-sm-6">   
 {!! Form::label('lcheckbook_id', 'Chequera:') !!} {{-- ,['style'=>'visibility:hidden'] --}}
 <select name="checkbook_id" id="checkbook_id" class="form-control"  > {{-- style="visibility:hidden" --}}
 <option value="">Seleccione Chequera</option>
 </select>
       
</div>

<div class="form-group col-sm-6"> 
    {{-- ini - Boton que llama a ventana modal  --}}
     <a  data-toggle="modal" 
        data-target="#creapopb"> Agregar cuenta bancaria 
        <i class="glyphicon glyphicon-plus-sign"></i>
    </a>
</div> 

<!-- Submit Field -->
<div class="form-group col-sm-6">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('providers.index') !!}" class="btn btn-default">Cancelar</a>
</div>
