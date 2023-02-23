<!-- Inmueble Id Field -->
<div class="form-group col-sm-2">
    {!! Form::label('inmueble_id', 'Inmueble Id:') !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Area Field -->
<div class="form-group col-sm-2">
    {!! Form::label('area', 'Area:') !!}
    {!! Form::number('area', null, ['class' => 'form-control','step'=>'any']) !!}
</div>

<!-- Porcentaje Field -->
<div class="form-group col-sm-2">
    {!! Form::label('porcentaje', 'Porcentaje:') !!}
    {!! Form::number('porcentaje', null, ['class' => 'form-control','step'=>'any']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-2">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::number('valor', null, ['class' => 'form-control']) !!}
</div>

<!-- Presupuesto Field -->
<div class="form-group col-sm-2">
    {!! Form::label('presupuesto', 'Presupuesto:') !!}
    {!! Form::number('presupuesto', null, ['class' => 'form-control']) !!}
</div>

<!-- Cuota Field -->
<div class="form-group col-sm-2">
    {!! Form::label('cuota', 'Cuota:') !!}
    {!! Form::number('cuota', null, ['class' => 'form-control']) !!}
</div>

<!-- Indiv1 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('indiv1', 'Indiv1:') !!}
    {!! Form::number('indiv1', null, ['class' => 'form-control','step'=>'any']) !!}
</div>

<!-- Indiv2 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('indiv2', 'Indiv2:') !!}
    {!! Form::number('indiv2', null, ['class' => 'form-control','step'=>'any']) !!}
</div>

<!-- Indiv3 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('indiv3', 'Indiv3:') !!}
    {!! Form::number('indiv3', null, ['class' => 'form-control','step'=>'any']) !!}
</div>

<!-- Indiv4 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('indiv4', 'Indiv4:') !!}
    {!! Form::number('indiv4', null, ['class' => 'form-control','step'=>'any']) !!}
</div>

<!-- Indiv5 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('indiv5', 'Indiv5:') !!}
    {!! Form::number('indiv5', null, ['class' => 'form-control','step'=>'any']) !!}
</div>

<!-- Param1 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('param1', 'Param1:') !!}
    {!! Form::text('param1', null, ['class' => 'form-control','step'=>'any']) !!}
</div>

<!-- Param2 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('param2', 'Param2:') !!}
    {!! Form::text('param2', null, ['class' => 'form-control','step'=>'any']) !!}
</div>

<!-- Param3 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('param3', 'Param3:') !!}
    {!! Form::text('param3', null, ['class' => 'form-control','step'=>'any']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('ivalues.index',$inmuid) !!}" class="btn btn-default">Cancel</a>
</div>
