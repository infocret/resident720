<table class="table table-responsive" id="cta-table">
<tbody>
<tr>       
  <td>      
      <div class="form-group">
          {!! Form::label('lid', 'Id:',['id'=>'ref1l']) !!}
          {!! Form::label('id', $propaccount->id,['id'=>'ref1d']) !!}
      </div>
  </td>
  <td>      
      <div class="form-group">
          {!! Form::label('lbanco', 'Banco:',['id'=>'ref1l']) !!}
          {!! Form::label('banco', $propaccount->banco,['id'=>'ref1d']) !!}
      </div>
  </td>
  <td>      
      <div class="form-group">
          {!! Form::label('lctanom', 'Nombre:',['id'=>'ref1l']) !!}
          {!! Form::label('ctanom', $propaccount->ctanom,['id'=>'ref1d']) !!}
      </div>
  </td>
  <td>      
      <div class="form-group">
          {!! Form::label('ldesc', 'Descripción:',['id'=>'ref1l']) !!}
          {!! Form::label('desc', $propaccount->ctadesc,['id'=>'ref1d']) !!}
      </div>
  </td>
      

</tr>

<tr>
  <td>   
      <div class="form-group">
          {!! Form::label('lcta', 'Cuenta:',['id'=>'ref1l']) !!}
          {!! Form::label('cta', $propaccount->ctanum,['id'=>'ref1d']) !!}
      </div>
  </td>      
  <td>      
      <div class="form-group">
          {!! Form::label('lclabe', 'CLABE:',['id'=>'ref1l']) !!}
          {!! Form::label('clabe', $propaccount->clabe,['id'=>'ref1d']) !!}
      </div>
  </td>
  <td>      
      <div class="form-group">
          {!! Form::label('lconvenio', 'Convenio:',['id'=>'ref1l']) !!}
          {!! Form::label('convenio', $propaccount->convenio,['id'=>'ref1d']) !!}
      </div>
  </td>
    <td>      
      <div class="form-group">
          {!! Form::label('lctac', 'Cta Contable:',['id'=>'ref1l']) !!}
          {!! Form::label('ctac', $propaccount->contable,['id'=>'ref1d']) !!}
      </div>
  </td>
</tr>

<tr>
  <td>   
      <div class="form-group">
          {!! Form::label('ltipo', 'Tipo:',['id'=>'ref1l']) !!}
          {!! Form::label('tipo', $propaccount->tipocta,['id'=>'ref1d']) !!}
      </div>
  </td>      
  <td>      
      <div class="form-group">
          {!! Form::label('lmoneda', 'Moneda:',['id'=>'ref1l']) !!}
          {!! Form::label('moneda', $propaccount->moneda,['id'=>'ref1d']) !!}
      </div>
  </td>
  <td>      
      <div class="form-group">
          {!! Form::label('lapert', 'Fecha Apertura:',['id'=>'ref1l']) !!}
          {!! Form::label('apert', $propaccount->apertura,['id'=>'ref1d']) !!}
      </div>
  </td>
    <td>      
      <div class="form-group">
          {!! Form::label('lcheq', 'Chequera:',['id'=>'ref1l']) !!}
          {!! Form::label('cheq', $propaccount->checkdesc,['id'=>'ref1d']) !!}
      </div>
  </td>
</tr>

<tr>
  <td>   
      <div class="form-group">
          {!! Form::label('lchini', 'No. Cheque inicial:',['id'=>'ref1l']) !!}
          {!! Form::label('chini', $propaccount->checkini,['id'=>'ref1d']) !!}
      </div>
  </td>      
  <td>      
      <div class="form-group">
          {!! Form::label('lchfin', 'No. Cheque final:',['id'=>'ref1l']) !!}
          {!! Form::label('chfin', $propaccount->checkfin,['id'=>'ref1d']) !!}
      </div>
  </td>
 
</tr>
</tbody>
</table>

{{-- 
array:1 [▼
  0 => {#1447 ▼
    +"id": 1
    +"banco": "BANAMEX"
    +"ctanom": "Banamex 5024"
    +"ctanum": "1409615024"

    +"clabe": "012180014096150240"
    +"ctadesc": "Cta de recepción de pagos"

    +"moneda": "MXN"
    +"tipocta": "ING"
    +"contable": "CtaContable"
    +"apertura": "2018-10-17 00:00:00"
    +"convenio": "999888777666"
    +"checkdesc": "Sin Chequera"
    +"checkini": "0"
    +"checkfin": "0"
  }
]
 --}}