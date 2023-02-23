
<!-- Persona imagen Id Field -->
 <div class="form-group col-sm-2">
  <img width="100px" src="{!!  env('PATH_IMGIDS').$filename  !!}"  
  class="img-rounded" alt="{!! env('PATH_IMGIDS').$filename !!}">
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('personaImagesids.delimgid', [$filename]) !!}" 
    class="btn btn-default">Cancelar</a>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Persona Id:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('persona_id', $personaexpid, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Link Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('link', 'Link:',['style'=>'visibility:hidden']) !!}
    {!! Form::text('link', env('PATH_IMGIDS'), ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Filename Field -->
<div class="form-group col-sm-6">
    {!! Form::label('filename', 'Filename:',['style'=>'visibility:hidden','style'=>'visibility:hidden']) !!}
    {!! Form::text('filename', $filename, ['class' => 'form-control','style'=>'visibility:hidden']) !!}
</div>

<!-- Activ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activ', 'Activ:',['style'=>'visibility:hidden']) !!}
    <label class="checkbox-inline" style="visibility:hidden">
        {!! Form::hidden('activ', false,['style'=>'visibility:hidden']) !!}
        {!! Form::checkbox('activ', '1', 1 ,['style'=>'visibility:hidden'] )!!} 1
    </label>
</div>


