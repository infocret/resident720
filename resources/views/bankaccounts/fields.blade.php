<!-- Clabe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clabe', 'CLABE:') !!}
    {!! Form::text('clabe', null, [
        'class' => 'form-control',
        'maxlength' => '18',
        'title' => 'Cuenta CLABE 18 digitos'        
        ]) !!}
</div>

<!-- Account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('account', 'Num.Cuenta:') !!}
    {!! Form::text('account', null, [
        'class' => 'form-control',
        'maxlength' => '11',
        'title' => 'Cuenta bancaria 11 digitos'
        ]) !!}
</div>


<!-- Opening Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opening_date', 'Fecha de Apertura:') !!}
    {!! Form::date('opening_date', null, [
        'class' => 'form-control',
        'title' => 'En que fecha se abrio la cuenta.'        
        ]) !!}
</div>

<!-- Bancos -->
<div class="form-group col-sm-6">
    {!! Form::label('lbancos', 'Banco:') !!}
    <select name="bank_id" id="bank_id" class="form-control"  required>
    <option value="">Seleccione un banco </option>
    
    @if (isset($bankaccount)&& !empty($bankaccount)) 
        @foreach($banks as $bank)            
            <option value="{{$bank->id}}"
                {{ $bankaccount->bank_id == $bank->id ? 'selected="selected"' : '' }}
                >{{ $bank->cve.'-'.$bank->shortname }}
            </option>            
        @endforeach
    @else
        @foreach($banks as $bank)           
            <option value="{{$bank->id}}">               
               {{ $bank->cve.'-'.$bank->shortname }}
            </option>            
        @endforeach
    @endif
    </select>
</div>

<!-- Plazas -->
<div class="form-group col-sm-6">
    {!! Form::label('lbanksquare', 'Plaza:') !!}
    <select name="banksquare_id" id="banksquare_id" class="form-control"  required>
    <option value="">Seleccione plaza </option>
    
    @if (isset($bankaccount)&& !empty($bankaccount)) 
        @foreach($banksqs as $banksq)            
            <option value="{{$banksq->id}}"
                {{ $bankaccount->banksquare_id == $banksq->id ? 'selected="selected"' : '' }}
                >{{ $banksq->cve.'-'.$banksq->square }}
            </option>            
        @endforeach
    @else
        @foreach($banksqs as $banksq)           
            <option value="{{$banksq->id}}"
                {{ 72 == $banksq->id ? 'selected="selected"' : '' }}
                >{{ $banksq->cve.'-'.$banksq->square }}
            </option>            
        @endforeach
    @endif
    </select>
</div>


<!-- Moneda -->
<div class="form-group col-sm-6">
    {!! Form::label('lcurrency', 'Moneda:') !!}
    <select name="currency_type" id="currency_type" class="form-control"  required>
    <option value="">Seleccione moneda </option>
    
    @if (isset($bankaccount)&& !empty($bankaccount)) 
        @foreach($currencys as $currency)            
            <option value="{{$currency->iso_code}}"
                {{ $bankaccount->currency_type == $currency->iso_code ? 
                    'selected="selected"' : '' }}
                >{{ $currency->territory.'-'.$currency->currency.'-'.$currency->iso_code }}
            </option>            
        @endforeach
    @else
        @foreach($currencys as $currency)            
            <option value="{{$currency->iso_code}}"
                {{ 'MXN' == $currency->iso_code ? 'selected="selected"' : '' }}
                >{{ $currency->territory.'-'.$currency->currency.'-'.$currency->iso_code }}
            </option>            
        @endforeach
    @endif
    </select>
</div>


<!-- Tipo de movimientos -->
<div class="form-group col-sm-6">
    {!! Form::label('laccount_type', 'Tipo de movimientos:') !!}
    <select name="account_type" id="account_type" class="form-control"  required>
    <option value="">Seleccione tipo </option>         
    
    <option value="ING">Ingresos</option>            
    <option value="EGR">Egresos</option>            
    <option value="IYE">Ingresos y Egresos</option>            
   
    </select>
</div>



<!-- Ident Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ident', 'Nombre corto o Cve:') !!}
    {!! Form::text('ident', null, ['class' => 'form-control','maxlength' => '10']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => '35']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => '50']) !!}
</div>



<!-- Accounting Field -->
<div class="form-group col-sm-6">
    {!! Form::label('accounting', 'Cta.Contable:') !!}
    {!! Form::text('accounting', null, ['class' => 'form-control','maxlength' => '35']) !!}
</div>

<!-- Allow Overdrafts Field -->
<div class="form-group col-sm-6">
    {!! Form::label('allow_overdrafts', 'Permite sobregiro:') !!}
    <label class="radio-inline">
        {!! Form::radio('allow_overdrafts', "1", null) !!} Si
    </label>

    <label class="radio-inline">
        {!! Form::radio('allow_overdrafts', "0", null) !!} No
    </label>

</div>

{{-- Datos para dar de alta chequera --}}

<div class="form-group col-sm-12" align="center">      
    {!! Form::checkbox('agregarch', '1', false,['id'=>'agregarch'])  !!}
    {!! Form::label('lagregarch', ' Agregar Chequera ',['id'=>'lagregarch']) !!}
</div>


<!-- Shortname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lshortname', 'Nomcorto / Cve:',['id'=>'lshortname']) !!}
    {!! Form::text('shortname', null, ['class' => 'form-control','id'=>'shortname'
    ,'maxlength' => '8']) !!}
</div>

<!-- Fullname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lfullname', 'Nombre:',['id'=>'lfullname']) !!}
    {!! Form::text('fullname', null, ['class' => 'form-control',
    'id'=>'fullname','maxlength' => '35']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ldescriptionch', 'Descripción:',['id'=>'ldescriptionch']) !!}
    {!! Form::text('descriptionch', null, ['class' => 'form-control','id'=>'descriptionch'
    ,'maxlength' => '150']) !!}
</div>

<!-- Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lstart', 'Num. Cheque inicio:',['id'=>'lstart']) !!}
    {!! Form::text('start', null, ['class' => 'form-control','id'=>'start']) !!}
</div>

<!-- End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lend', 'Num. Cheque final:',['id'=>'lend']) !!}
    {!! Form::text('end', null, ['class' => 'form-control','id'=>'end']) !!}
</div>



{{-- Fin de datos para dar de alta chequera --}}



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bankaccounts.indexb') !!}" class="btn btn-default">Cancelar</a>
</div>
