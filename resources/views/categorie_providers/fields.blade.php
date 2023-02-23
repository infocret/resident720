<!-- Provcat Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('provcat_id', 'Provcat Id:') !!}
    {!! Form::text('provcat_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Provider Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('provider_id', 'Provider Id:') !!}
    {!! Form::text('provider_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('categorieProviders.index') !!}" class="btn btn-default">Cancel</a>
</div>
