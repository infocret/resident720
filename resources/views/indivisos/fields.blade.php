
<!-- Parametro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parametro', 'Parametro:') !!}
    {!! Form::text('parametro', 'Indiviso', ['class' => 'form-control']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::text('valor', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('indivisos.index') !!}" class="btn btn-default">Cancelar</a>
</div>

<!-- Inmueble Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmueble_id', 'Inmueble Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('inmueble_id', $propexpid, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

