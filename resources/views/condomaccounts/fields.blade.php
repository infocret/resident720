
<!-- Select de Bancos  -->
<div class="form-group col-sm-6">   
{!! Form::label('bank_id', 'Banco:') !!}	 
 <select name="bank_id" id="bank_id" class="form-control"  required>
 <option value="">Seleccione Banco</option>
 											{{-- para Create --}}
    @foreach($bancos as $key => $value)            
        <option value="{{$key}}">{{ $value }}</option>            
    @endforeach

</select> 
</div>


<div class="form-group col-sm-6">   
{!! Form::label('lbankaccount_id', 'Cuenta:') !!}	 
 <select name="bankaccount_id" id="bankaccount_id" class="form-control"  required>
 <option value="">Seleccione Cuenta</option>
 </select>
</div>


<div class="form-group col-sm-6">   
 {!! Form::label('lcheckbook_id', 'Chequera:') !!}
 <select name="checkbook_id" id="checkbook_id" class="form-control"  >
 <option value="">Seleccione Chequera</option>
 </select>
</div>

<!-- Numero de Convenio -->
<div class="form-group col-sm-6">
    {!! Form::label('lbank_agreement', 'Num. Convenio:') !!}
    {!! Form::text('bank_agreement', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Asignar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('condomaccounts.index',$inmuid) !!}" class="btn btn-default">Cancelar</a>
</div>

<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('inmueble_id', $inmuid, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>
