<table class="table table-responsive" id="propertyvalues-table">
    <thead>
        <tr>
        <th>Dato</th>
        <th>Valor</th> 
        <th>Dato</th>
        <th>Valor</th>         
        </tr>
    </thead>
    <tbody>    
        <tr>            
            <td>{!! Form::label('area', 'Area:') !!}</td>
            <td>{!! Form::number('area', null, ['class' => 'form-control','step'=>'any']) !!}</td>        
            <td>{!! Form::label('porcentaje', 'Porcentaje:') !!}</td>
            <td>{!! Form::number('porcentaje', null, ['class' => 'form-control','step'=>'any']) !!}</td>
        </tr>
            <td>{!! Form::label('valor', 'Valor:') !!}</td>
            <td>{!! Form::number('valor', null, ['class' => 'form-control']) !!}</td>
            <td>{!! Form::label('presupuesto', 'Presupuesto:') !!}</td>
            <td>{!! Form::number('presupuesto', null, ['class' => 'form-control']) !!}</td>
        <tr>  
        </tr>
            <td>{!! Form::label('cuota', 'Cuota:') !!}</td>
            <td>{!! Form::number('cuota', null, ['class' => 'form-control']) !!}</td>
            <td>{!! Form::label('param1', 'Param1:') !!}</td>
            <td>{!! Form::text('param1', null, ['class' => 'form-control','step'=>'any']) !!}</td>
        <tr>          
        </tr>
          
            <td>{!! Form::label('param2', 'Param2:') !!}</td>
            <td>{!! Form::text('param2', null, ['class' => 'form-control','step'=>'any']) !!}</td>
            <td>{!! Form::label('param3', 'Param3:') !!}</td>
            <td>{!! Form::text('param3', null, ['class' => 'form-control','step'=>'any']) !!}</td>
        <tr>
    </tbody>
</table>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('ivalues.index',$inmuid) !!}" class="btn btn-default">Cancelar</a>
</div>

<!-- Inmueble Id Field -->
<div class="form-group col-sm-2">
    {!! Form::label('inmueble_id', 'Inmueble Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('inmueble_id', null, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Indiv1 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('indiv1', 'Indiv1:',['style'=>'visibility:hidden']) !!}
    {!! Form::number('indiv1', null, ['class' => 'form-control','step'=>'any','style'=>'visibility:hidden']) !!}
</div>

<!-- Indiv2 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('indiv2', 'Indiv2:',['style'=>'visibility:hidden']) !!}
    {!! Form::number('indiv2', null, ['class' => 'form-control','step'=>'any','style'=>'visibility:hidden']) !!}
</div>

<!-- Indiv3 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('indiv3', 'Indiv3:',['style'=>'visibility:hidden']) !!}
    {!! Form::number('indiv3', null, ['class' => 'form-control','step'=>'any','style'=>'visibility:hidden']) !!}
</div>

<!-- Indiv4 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('indiv4', 'Indiv4:',['style'=>'visibility:hidden']) !!}
    {!! Form::number('indiv4', null, ['class' => 'form-control','step'=>'any','style'=>'visibility:hidden']) !!}
</div>

<!-- Indiv5 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('indiv5', 'Indiv5:',['style'=>'visibility:hidden']) !!}
    {!! Form::number('indiv5', null, ['class' => 'form-control','step'=>'any','style'=>'visibility:hidden']) !!}
</div>
