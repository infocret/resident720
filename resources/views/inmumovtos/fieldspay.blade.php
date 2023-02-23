    {{--  *****************     Logo condominio proveedor ******************* --}}
    <table class="table table-responsive"> 

    <tr>
      <td id="logo" rowspan="4">        
       <img src="{{ url('/').'/img/adplogo_200h.png' }}">
      </td>
    </tr>

    <tr>
      <td class="titulo">
        Estado de Cuenta
      </td>
    </tr>

    <tr>
      <td class="datpc">        
         {{ $ncondomi }}
      </td>
    </tr>

    <tr>
      <td class="datpc">
         {{ $mhead->providnom." ".$mhead->providrazsoc." ".$mhead->providrfc }}             
      </td>
    </tr>

    </table>

    {{--  *****************     Unidad, Propietario ******************* --}}
    <table  class="table table-responsive"> 
    <thead>
        <tr>
            <th class="tit1">
                Unidad
            </th>
            <th class="tit1"> {{-- Tipo de relacion de la persona e inmueble --}}
                {{ $propietario->nombre }}
            </th>
            <th class="tit1">
                Fecha Aplicación
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="dat1">
                 {{$mhead->unidcve." ".$mhead->uniddesc }}
            </td>
            <td class="dat1">
                {{ $propietario->name." ".$propietario->apmat." ".$propietario->appat }}
            </td>
            <td class="dat1">
               {{ \Carbon\Carbon::parse($mhead->chrdate)->format('d/m/Y') }}
            </td>   

        </tr>   
    </tbody>
    </table>

   {{--  *****************     Unidad, Propietario ******************* --}}
    <table  class="table table-responsive">
        <thead>
        <tr>
            <th class="tit1">
                Area
            </th>
            <th class="tit1">
                Folio
            </th>      
            <th class="tit1">
                Concepto
            </th>                   
        </tr>
        </thead>

        <tbody>
        <tr>
            <td class="dat1">
                {{ $mhead->area }}
            </td>
            <td class="dat1">
                {{ $mhead->chrfolio }}
            </td> 
            <td class="dat1">
                {{ $mhead->chrcve." - ".$mhead->chrname }}
            </td>                       
        </tr>   
        </tbody>
    </table>

   {{--  *****************     Estatus, Subtotal, IVA, Total ******************* --}}
    <table  class="table table-responsive">   
    <thead>
        <tr>
            <th class="tit1">
               Estatus
            </th>
            <th class="tit1">
               Subtotal
            </th>
            <th class="tit1">
               I.V.A.
            </th> 
            <th class="tit1">
               Total
            </th> 
            <th class="tit1">
               Saldo
            </th>                       
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="dat1">
               {{ $mhead->chrstatus }}
            </td>
            <td class="dat1">
              {{ '$ '.number_format($mhead->chrtotal, 2, '.', ',') }}
            </td>
            <td class="dat1">
               {{ '$ '.number_format($mhead->chriva, 2, '.', ',') }}
            </td>
            <td class="dat1">
               {{ '$ '.number_format($mhead->chriva+$mhead->chrtotal, 2, '.', ',') }}
            </td>
            <td class="dat1" style="font-weight: bold;">
                {{ '$ '.number_format($mhead->chrbalance, 2, '.', ',') }}
            </td>           
        </tr>   
    </tbody>

    </table>

    {{--  *****************  Detalles ******************* --}}

    <div align="center" style="color: gray">
        Pagos registrados
    </div>

    <table  class="table table-responsive"> 

    <thead>
    <tr>
    <th class="tit2">Fecha Pago</th>    
    <th class="tit2">Concepto Pago</th> 
    <th class="tit2">-</th> 
    <th class="tit2">Cantidad</th>
    </tr>
    </thead>

    <tbody>
           
    @foreach($cargos as $cargo)
    <tr>  
    <td class="dat2c">{{ \Carbon\Carbon::parse($cargo->movdate)->format('d/m/Y')}}</td>    
    <td class="dat2l">
        {{ $cargo->movcve.' - '.$cargo->movdesc.' Fol.: '.$cargo->movfolio}}
    </td>
    <td>-</td>    
    <td class="dat2r">{{ '$ '.number_format($cargo->movbalance, 2, '.', ',') }}</td>
    </tr>

    @endforeach

    @foreach($pagos as $pago)
    <tr>  
    <td class="dat2c">{{ \Carbon\Carbon::parse($pago->movdate)->format('d/m/Y')}}</td>    
    <td class="dat2l">
        {{ $pago->movcve.' - '.$pago->movdesc.' Fol.: '.$pago->movfolio}}
    </td>
    <td>-</td>    
    <td class="dat2r">{{ '$ '.number_format($pago->movbalance, 2, '.', ',') }}</td>
    </tr>

    @endforeach




    <tr>  
    <td class="dat2c">               
        {!! Form::date('date', 
        \Carbon\Carbon::now(), ['class' => 'form-control']) !!}        
    </td>   
    <td class="dat2l">
        <select name="unidmovto_id" id="unidmovto_id" class="form-control"  
        required>
         <option value="">Seleccione concepto:</option>        
            @foreach($movtos as $movto)            
              <option value="{{$movto->id}}">
                {{ $movto->cve.' - '.$movto->description }}</option>            
            @endforeach
        </select>
    </td>       
    <td>
    {!! Form::label('simbol', '$ ') !!}
    </td>
    <td class="dat2r">
    
    {!! Form::number('balance', $mhead->balance, ['class' => 'form-control']) !!}

    </td>
    </tr>

   
    </tbody>

    </table>

    <div style="clear:both; margin:10px" > </div> {{-- Separador --}}

<table>
    <tr>
    <td>
        <p class="datpc"> 
        Conforme al presupuesto autorizado por asamblea general de condominio.
        </p>    
        <p class="datpc">
        Exija el original de este recibo como un comprobante de su aportación
        </p>
    </td>
    <td>        
        <div class="form-group col-sm-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        {{-- <a href="{!! route($rback->ruta,$rback->param) !!}" class="btn btn-default">Cancelar</a> --}}

        <a href="{!! url()->previous()!!}" class="btn btn-default">Cancelar</a>
        
        </div>
    </td>    
    </tr>
</table>

<input type="hidden" name="inmucharg_id" value="{{ $mhead->chrid }}">
<input type="hidden" name="catmovto_cve" value="0000">
<input type="hidden" name="folio" value="0000">
<input type="hidden" name="measureunit_id" value="0">
<input type="hidden" name="quantity" value="1">
<input type="hidden" name="amount" value="0">
<input type="hidden" name="status" value="Registrado">
<input type="hidden" name="apmode" value="Manual">
<input type="hidden" name="description" value="Desc">
<input type="hidden" name="observ" value="N/A">
<input type="hidden" name="filelink" value="N/A">



{{-- 
'catmovto_cve' => 'required|max:11999|min:1',
'date' => 'required',
'folio' => 'required|max:35|min:1',
        'quantity' => 'required|max:9999999|min:0',
        'amount' => 'required|max:9999999|min:0',
        'balance' => 'required|max:9999999|min:0',
        'status' => 'required|max:15|min:1',
        'apmode' => 'required|max:35|min:1',
        'description' => 'required|max:150|min:1',
        'observ' => 'required|max:250|min:1',
        'filelink' => 'required|max:250|min:1'
--}}