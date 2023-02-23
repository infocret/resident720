<!-- Anticipo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('anticipo_id', 'Anticipo Id:') !!}
    {!! Form::text('anticipo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Inmucharg Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmucharg_id', 'Inmucharg Id:') !!}
    {!! Form::text('inmucharg_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Inmumovto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inmumovto_id', 'Inmumovto Id:') !!}
    {!! Form::text('inmumovto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Fechareg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fechareg', 'Fechareg:') !!}
    {!! Form::date('fechareg', null, ['class' => 'form-control','id'=>'fechareg']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#fechareg').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Saldoini Field -->
<div class="form-group col-sm-6">
    {!! Form::label('saldoini', 'Saldoini:') !!}
    {!! Form::number('saldoini', null, ['class' => 'form-control','max' => 9999999,'min' => 0]) !!}
</div>

<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', null, ['class' => 'form-control','max' => 9999999,'min' => 0]) !!}
</div>

<!-- Saldofin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('saldofin', 'Saldofin:') !!}
    {!! Form::number('saldofin', null, ['class' => 'form-control','max' => 9999999,'min' => 0]) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control','maxlength' => 15,'minlength' => 1]) !!}
</div>

<!-- Apmode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('apmode', 'Apmode:') !!}
    {!! Form::text('apmode', null, ['class' => 'form-control','maxlength' => 35,'minlength' => 1]) !!}
</div>

<!-- Desc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('desc', 'Desc:') !!}
    {!! Form::text('desc', null, ['class' => 'form-control','maxlength' => 150,'minlength' => 1]) !!}
</div>

<!-- Observ Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observ', 'Observ:') !!}
    {!! Form::text('observ', null, ['class' => 'form-control','maxlength' => 250,'minlength' => 1]) !!}
</div>

<!-- Userreg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('userreg', 'Userreg:') !!}
    {!! Form::text('userreg', null, ['class' => 'form-control','maxlength' => 150,'minlength' => 1]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('anticiposaplis.index') }}" class="btn btn-default">Cancel</a>
</div>
