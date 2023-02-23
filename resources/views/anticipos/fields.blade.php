
<!-- Unid Id  -->
<div class="form-group col-sm-6">
    {!! Form::label('lunid_id', 'Unidad:') !!}

     <select name="unid_id" id="unid_id" class="form-control" required >
     <option value="">Seleccione unidad</option>
     
     @foreach($unidades as $unidad)
   
    @if (isset($anticipo)&& !empty($anticipo))          {{-- para Edit --}}
        <option value="{{$unidad->id}}"
            {{$anticipo->unid_id == $unidad->id ? 'selected="selected"' : '' }}  >
        {{$unidad->ident.'-'.$unidad->nombre}}</option>   
    @else                                               {{-- para Create --}}
        <option value="{{$unidad->id}}">
        {{$unidad->ident.'-'.$unidad->nombre}}</option>   
    @endif

      @endforeach
    </select> 
</div>

<!-- Conceptserv Id  -->
<div class="form-group col-sm-6">
    {!! Form::label('conceptserv_id', 'Concepto / Servicio:') !!}
    <!-- {!! Form::text('conceptserv_id', null, ['class' => 'form-control']) !!} -->
    <select name="conceptserv_id" id="conceptserv_id" 
    class="form-control" required>
    <option value="">Seleccione concepto:</option>
      @if (isset($anticipo)&& !empty($anticipo))          {{-- para Edit --}}
        @foreach($conceptservices as $concept)
        <option value="{{$concept->id}}"
            {{$anticipo->conceptserv_id == $concept->id ? 'selected="selected"' : '' }}  >
        {{$concept->cve.'-'.$concept->name}} </option>     
        @endforeach      
      @endif
    </select>
</div>

<!-- Fechareg  -->
<div class="form-group col-sm-6">
    {!! Form::label('fechareg', 'Fecha de registro:') !!}
    {!! Form::date('fechareg', \Carbon\Carbon::now(), ['class' => 'form-control','id'=>'fechareg']) !!}
</div>

<!-- Montoini Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lmontoini', 'Monto recibido:') !!}
    {!! Form::number('montoini',null, ['class' => 'form-control','id' => 'mmonto','step' => 'any','id' => 'montoini' ]) !!}
</div>

<!-- Cobertura Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cobertura', 'Periodo de Cobertura:') !!}
    {!! Form::text('cobertura', 'Un año', ['class' => 'form-control','maxlength' => 150,'minlength' => 1]) !!}
</div>

<!-- Observ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observ', 'Observaciones:') !!}
     {!! Form::text('observ', 'n/a', [
        'class' => 'form-control',
        'minlength'=>'1',
        'maxlength'=>'250',
        'required' => 'required'
        ]) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('anticipos.index') }}" class="btn btn-default">Cancelar</a>
</div>


<!-- Campos ocultos -->

<!-- Condom Id Field -->

    {!! Form::hidden('condom_id', $propexpid, ['class' => 'form-control']) !!}

    {!! Form::hidden('folio', '0000000000000000000000000000', ['class' => 'form-control','maxlength' => 35,'minlength' => 1]) !!}

    {!! Form::hidden('saldo', null, ['class' => 'form-control','max' => 9999999,'min' => 0,'id' => 'saldo' ]) !!}

    {!! Form::hidden('status', 'Generado', ['class' => 'form-control','maxlength' => 15,'minlength' => 1]) !!}

    {!! Form::hidden('desc', 'n/a', ['class' => 'form-control','maxlength' => 150,'minlength' => 1,'id'=>'desc']) !!}

    {!! Form::hidden('docto', 'n/a', ['class' => 'form-control','maxlength' => 150,'minlength' => 1]) !!}

    {!! Form::hidden('filelink', 'n/a', ['class' => 'form-control','maxlength' => 250,'minlength' => 1]) !!}

    {!! Form::hidden('userreg', $user, ['class' => 'form-control','maxlength' => 150,'minlength' => 1]) !!}
