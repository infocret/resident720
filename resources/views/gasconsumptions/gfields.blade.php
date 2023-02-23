
{{-- 
<div class="form-group col-sm-6">
   {!! Form::label('lunidad', 'Unidad:'.$unidname) !!}
   {!! Form::label('ldprice', 'Ultima actualización de precio:'.$dategasprice) !!}
   {!! Form::label('lgprice', 'Precio actual litro de Gas:'.$gasprice) !!}
   {!! Form::label('llectant','Fecha de registro de lectura Anterior:'.$lectant->datelant) !!}
   {!! Form::label('llectant','Lectura de medidor anterior:'.$lectant->lant) !!}
</div>
 --}}
 <div class="form-group">
<!-- Inmueble -->
<table class="table table-responsive" id="propertyvalues-table">
    <thead>
    <tr>
        <th>Unidad</th>
        <th>Fecha precio</th>
        <th>Precio actual</th>
        <th>Fecha Anterior</th>
        <th>Lectura Aterior</th>
    </tr>        
    </thead>

<tbody>
    <tr>
        <td>{{ $unidname }}</td>
        <td>{{ $dategasprice }}</td>
        <td>{{ $gasprice }}</td>
        @if ($lectant->datelant == '1971-01-01')
         <td>No existe</td>
        @else
        <td>{{ $lectant->datelant }}</td>
        @endif        
        <td>{{ $lectant->lant }}</td>
    </tr>    
</tbody>
</table>
</div>

<div class="form-group">
<!-- Current Reading Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lcurrent_reading', 'Lectura actual:') !!}
    {!! Form::number('current_reading', null, ['class' => 'form-control','id'=>'lactual']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-6">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! url()->previous() !!}" class="btn btn-default">Cancel</a>
</div>
</div>

 <div class="clearfix"></div>

<div class="form-group">
<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Consumo:') !!}
    {!! Form::number('quantity', 0, ['class' => 'form-control','id'=>'quantity']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Monto:') !!}
    {!! Form::number('amount', 0, ['class' => 'form-control','id'=>'amount']) !!}
</div>
</div>


<input type="hidden" name="application_date" value="{{  $vdate }}">
<input type="hidden" name="inmueble_id" value="{{ $unidid }}">
<input type="hidden" name="reading_date" value="{{ $vdate }}">
<input type="hidden" name="last_reading" value="{{ $lectant->lant }}">
<input type="hidden" name="gas_price" value="{{ $gasprice }}">
{{-- 
{!! Form::date('bapplication_date', $vdate, ['class' => 'form-control']) !!}
{!! Form::text('binmueble_id', $unidid, ['class' => 'form-control']) !!}
{!! Form::date('breading_date', $vdate, ['class' => 'form-control']) !!}
{!! Form::number('blast_reading',  $lectant->lant, ['class' => 'form-control']) !!}
{!! Form::number('bgas_price', $gasprice, ['class' => 'form-control']) !!}
 --}}