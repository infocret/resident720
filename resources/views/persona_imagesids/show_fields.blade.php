<!-- Imagen ID -->
<img width="100px" src="{!!  env('PATH_IMGIDS').$personaImagesids->filename !!}"  
class="img-rounded" alt="{!! env('PATH_IMGIDS').$personaImagesids->filename !!}">

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $personaImagesids->id !!}</p>
</div>

<!-- Persona Id Field -->
<div class="form-group">
    {!! Form::label('persona_id', 'Persona Id:') !!}
    <p>{!! $personaImagesids->persona_id !!}</p>
</div>

<!-- Link Field -->
<div class="form-group">
    {!! Form::label('link', 'Link:') !!}
    <p>{!! $personaImagesids->link !!}</p>
</div>

<!-- Filename Field -->
<div class="form-group">
    {!! Form::label('filename', 'Filename:') !!}
    <p>{!! $personaImagesids->filename !!}</p>
</div>

<!-- Activ Field -->
<div class="form-group">
    {!! Form::label('activ', 'Activ:') !!}
    <p>{!! $personaImagesids->activ !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $personaImagesids->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $personaImagesids->updated_at !!}</p>
</div>

