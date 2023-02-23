<!-- Inmucharge Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmucharge_id', 'Inmucharge Id:') !!}
    {!! Form::text('inmucharge_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Propaccount Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('propaccount_id', 'Propaccount Id:') !!}
    {!! Form::text('propaccount_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Checkbook Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('checkbook_id', 'Checkbook Id:') !!}
    {!! Form::text('checkbook_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Datetext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('datetext', 'Datetext:') !!}
    {!! Form::text('datetext', null, ['class' => 'form-control']) !!}
</div>

<!-- Nametext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nametext', 'Nametext:') !!}
    {!! Form::text('nametext', null, ['class' => 'form-control']) !!}
</div>

<!-- Amounttext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amounttext', 'Amounttext:') !!}
    {!! Form::text('amounttext', null, ['class' => 'form-control']) !!}
</div>

<!-- Amountletertext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amountletertext', 'Amountletertext:') !!}
    {!! Form::text('amountletertext', null, ['class' => 'form-control']) !!}
</div>

<!-- Textleyenda Field -->
<div class="form-group col-sm-6">
    {!! Form::label('textleyenda', 'Textleyenda:') !!}
    {!! Form::text('textleyenda', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Checknum Field -->
<div class="form-group col-sm-6">
    {!! Form::label('checknum', 'Checknum:') !!}
    {!! Form::text('checknum', null, ['class' => 'form-control']) !!}
</div>

<!-- Cancelchargeid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cancelchargeid', 'Cancelchargeid:') !!}
    {!! Form::text('cancelchargeid', null, ['class' => 'form-control']) !!}
</div>

<!-- Observ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observ', 'Observ:') !!}
    {!! Form::text('observ', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('checkissuances.index') !!}" class="btn btn-default">Cancel</a> 
</div>

