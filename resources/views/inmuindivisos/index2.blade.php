@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Indivisos de Unidadesss</h1>
        <h1 class="pull-right">
       {{--  <a id="vlida" class="btn btn-primary pull-right" 
        style="margin-top: -10px;margin-bottom: 5px" href="">
          Validar
        </a>  --}}  
          {!! Form::submit('Save', ['name'=>'bsave','id'=>'bsave','class' => 'btn btn-primary']) !!} 

        </h1>              
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="form-group col-sm-12">
              {!! Form::label('lnunid', 'Unidades: '.$numunids,['name'=>'lnunid','id' => 'lnunid']) !!}

              <button type="button" class="btn btn-info btn-xs" onclick="validar();">
                <span title="Agregar detalle" class="glyphicon glyphicon-ok"></span>
              </button>   
            </div>
            <div class="box-body">   
              {!! Form::open(['id' => 'form1','name' => 'form1','route' => 'propertyvalues.store']) !!}
                    @include('inmuindivisos.tableindiv') 
              {!! Form::close() !!}               
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
{{--  *************************************************************************************
      Este script permite saber si se llama a  dropdown.js desde el create o el edit 
      y pasa una variable general , sirve tambien si se desea enviar una variable de session
      <script type="text/javascript">
        var action = '{!! Session::get('personaexpid') !!}';
      </script>   
      ************************************************************************************* --}}    
  <script type="text/javascript">
    var numunids = '{{ $numunids }}';       
  </script> 
@endsection

@section('scripts')
    {{-- Carga el java script de dropdown --}}
    <script src="{{ url('/js/indivisos.js') }}"></script>
@endsection

