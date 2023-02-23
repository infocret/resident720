<!-- Inmucharg Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmucharg_id', 'Inmucharg Id:') !!}
    {!! Form::text('inmucharg_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Unidmovto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unidmovto_id', 'Unidmovto Id:') !!}
    {!! Form::text('unidmovto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Catmovto Cve Field -->
<div class="form-group col-sm-6">
    {!! Form::label('catmovto_cve', 'Catmovto Cve:') !!}
    {!! Form::number('catmovto_cve', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Folio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('folio', 'Folio:') !!}
    {!! Form::text('folio', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Measureunit Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('measureunit_id', 'Measureunit Id:') !!}
    {!! Form::text('measureunit_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Balance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('balance', 'Balance:') !!}
    {!! Form::number('balance', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Apmode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('apmode', 'Apmode:') !!}
    {!! Form::text('apmode', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Observ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observ', 'Observ:') !!}
    {!! Form::text('observ', null, ['class' => 'form-control']) !!}
</div>

<!-- Filelink Field -->
<div class="form-group col-sm-6">
    {!! Form::label('filelink', 'Filelink:') !!}
    {!! Form::text('filelink', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inmumovtos.index') !!}" class="btn btn-default">Cancel</a>
</div>
