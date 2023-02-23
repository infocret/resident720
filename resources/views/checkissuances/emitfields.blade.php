
<!-- Select de Bancos  -->
<div class="form-group col-sm-6">   
{!! Form::label('lcheckbook', 'Chequera:') !!}     
 <select name="checkbook" id="checkbook" class="form-control"  required>
 <option value="">Seleccione chequera</option>

@if (isset($chequeraid) && !empty($chequeraid)) {{-- para Edit --}}
    @foreach($chequeras as $chequera)            
        <option value="{{ $chequera->propacc_id.'-'.$chequera->checkbook_id}}"
            {{$chequeraid == $chequera->checkbook_id ? 'selected="selected"' : '' }}
            >
        {{ $chequera->banco.' - Cta:'.$chequera->ctanum.' -'.$chequera->checkdesc }}
        </option>            
    @endforeach   
@else                                           {{-- para Create --}}
    @foreach($chequeras as $chequera)            
        <option value="{{ $chequera->propacc_id.'-'.$chequera->checkbook_id}}">
        {{ $chequera->banco.' - Cta:'.$chequera->ctanum.' -'.$chequera->checkdesc }}
        </option>            
    @endforeach
@endif

</select> 
</div>


  
<!-- Datetext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ldatetext', 'Fecha de cheque:') !!}
    {!! Form::date('datetext',null , 
    ['class' => 'form-control', 'id' => 'fdatetext', 'required' => 'required']) !!}    
</div>

<!-- Nametext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nametext', 'A nombre de:') !!}
    {!! Form::text('nametext', $providers->razonsocial, ['class' => 'form-control']) !!}
</div>

<!-- Amounttext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lamounttext', 'Cantidad:') !!}
    {!! Form::text('amounttext', number_format($inmucharge->balance, 2, '.', ''), 
    ['class' => 'form-control','id' => 'amounttext']) !!}
</div>


<!-- Amountletertext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lamountletertext', 'Cantidad con letra:') !!}
    {!! Form::text('amountletertext', null, ['class' => 'form-control' ,'id' => 'amountletertext']) !!}
</div>


<!-- Textleyenda Field -->
<div class="form-group col-sm-6"> 
    {!! Form::label('lleyend', 'Para abono a cuenta') !!}
    {!! Form::checkbox('chleyenda', 1, 0, ['id' => 'chleyenda'])  !!}
    {!! Form::text('textleyenda', 'n/a', ['class' => 'form-control', 'id' => 'textleyenda']) !!}
</div>


<!-- Observ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observ', 'Observaciones:') !!}
    {!! Form::text('observ', 'n/a', ['class' => 'form-control']) !!}
</div>


@if (isset($statuslist) && !empty($statuslist)) {{-- para Edit --}}
<div class="form-group col-sm-6">   
{!! Form::label('lliststat', 'Estatus:') !!}     
 <select name="liststat" id="liststat" class="form-control"  required>
 <option value="">Seleccione Estatus</option>
    @foreach($statuslist as $key=>$value)            
        <option value="{{ $value }}"
            {{$key == $checkissuance->estatus ? 'selected="selected"' : '' }}
            >
        {{ $value }}
        </option>            
    @endforeach   
</select> 
</div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!!url()->previous() !!}" class="btn btn-default">Cancel</a>

</div>
    {{-- <a href="{!! route('checkissuances.index') !!}" class="btn btn-default">Cancelar</a> --}}



<!-- Inmucharge Id Field -->
   {{--  {!! Form::label('linmucharge_id', 'Inmucharge Id:') !!} --}}
   {!! Form::hidden('inmucharge_id', $inmucharge->id, ['class' => 'form-control']) !!}
<!-- Propaccount Id Field -->
    {{-- {!! Form::label('lpropaccount_id', 'Cuenta asignada Id:') !!} --}}
    {!! Form::hidden('propaccount_id', null, 
    ['class' => 'form-control', 'id' => 'propaccount_id']) !!}
<!-- Checkbook Id Field -->
    {{-- {!! Form::label('lcheckbook_id', 'Chequera Id:') !!} --}}
    {!! Form::hidden('checkbook_id', null, 
    ['class' => 'form-control', 'id' => 'checkbook_id']) !!}
<!-- Status Field -->
   {{--  {!! Form::label('lstatus', 'Estatus:') !!} --}}
    {!! Form::hidden('status', 'Registrado', ['class' => 'form-control', 'id' => 'status']) !!}
<!-- Checknum Field -->
   {{--  {!! Form::label('lchecknum', 'Numero de cheque:') !!} --}}
    {!! Form::hidden('checknum', 0, ['class' => 'form-control']) !!}
<!-- Cancelchargeid Field -->
  {{--   {!! Form::label('lcancelchargeid', 'Cancelación:') !!} --}}
    {!! Form::hidden('cancelchargeid', 0, ['class' => 'form-control']) !!}
<!-- Incluir leyenda -->
   {{--  {!! Form::label('lincluirleyenda', 'Incluir leyenda:') !!} --}}
    {!! Form::hidden('incluirleyenda', 0, 
    ['class' => 'form-control', 'id' => 'incluirleyenda']) !!}


{{-- 

div class="form-group col-sm-6">   
{!! Form::label('bank_id', 'Banco:') !!}     
 <select name="bank_id" id="bank_id" class="form-control"  required>
 <option value="">Seleccione Banco</option>

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

 --}}