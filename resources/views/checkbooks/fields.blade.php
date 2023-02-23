
<!-- Bankaccount Id Field -->
  
    @if (isset($ctaid)&& !empty($ctaid))    
    {!! Form::hidden('bankaccount_id', $ctaid) !!}
    @else
    <div class="form-group col-sm-6">  
    {!! Form::label('bankaccount_id', 'Id de Cuenta Bancaria:') !!}
    {!! Form::text('bankaccount_id', null, ['class' => 'form-control']) !!}
    </div>
    @endif



<!-- Shortname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shortname', 'Nombre corto / Cve:') !!}
    {!! Form::text('shortname', null, ['class' => 'form-control']) !!}
</div>

<!-- Fullname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fullname', 'Nombre:') !!}
    {!! Form::text('fullname', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start', 'Cheque inicial:') !!}
    {!! Form::text('start', null, ['class' => 'form-control']) !!}
</div>

<!-- End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end', 'Cheque final:') !!}
    {!! Form::text('end', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    @if (isset($ctaid)&& !empty($ctaid)) 
        <a href="{!! route('bankaccounts.show', [$ctaid]) !!}" class="btn btn-default">Cancelar</a>
    @else
        <a href="{!! route('checkbooks.index') !!}" class="btn btn-default">Cancelar</a>
    @endif
</div>
