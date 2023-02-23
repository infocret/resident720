
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


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('indivisos.index',$inmuid) !!}" class="btn btn-default">Cancel</a>
</div>

<!-- Inmueble Id Field -->
<div class="form-group col-sm-2">
    {!! Form::label('inmueble_id', 'Inmueble Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Area Field -->
<div class="form-group col-sm-2">
    {!! Form::label('area', 'Area:',['style'=>'visibility:hidden']) !!}
    {!! Form::number('area', null, ['class' => 'form-control','step'=>'any','style'=>'visibility:hidden']) !!}
</div>

<!-- Porcentaje Field -->
<div class="form-group col-sm-2">
    {!! Form::label('porcentaje', 'Porcentaje:',['style'=>'visibility:hidden']) !!}
    {!! Form::number('porcentaje', null, ['class' => 'form-control','step'=>'any','style'=>'visibility:hidden']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-2">
    {!! Form::label('valor', 'Valor:',['style'=>'visibility:hidden']) !!}
    {!! Form::number('valor', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Presupuesto Field -->
<div class="form-group col-sm-2">
    {!! Form::label('presupuesto', 'Presupuesto:',['style'=>'visibility:hidden']) !!}
    {!! Form::number('presupuesto', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Cuota Field -->
<div class="form-group col-sm-2">
    {!! Form::label('cuota', 'Cuota:',['style'=>'visibility:hidden']) !!}
    {!! Form::number('cuota', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Param1 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('param1', 'Param1:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('param1', null, ['class' => 'form-control','step'=>'any','style'=>'visibility:hidden']) !!}
</div>

<!-- Param2 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('param2', 'Param2:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('param2', null, ['class' => 'form-control','step'=>'any','style'=>'visibility:hidden']) !!}
</div>

<!-- Param3 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('param3', 'Param3:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('param3', null, ['class' => 'form-control','step'=>'any','style'=>'visibility:hidden']) !!}
</div>
