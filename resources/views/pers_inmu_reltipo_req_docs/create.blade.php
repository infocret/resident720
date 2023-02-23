@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pers Inmu Reltipo Req Doc
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'persInmuReltipoReqDocs.store']) !!}

                        @include('pers_inmu_reltipo_req_docs.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

  <script type="text/javascript">
    var action = 'create';   
    var rutax = '{{ url('/') }}';
  </script>

@endsection

{{--  *************************************************************************************
      Este script permite saber si se llama a  dropdown.js desde el create o el edit 
      y pasa una variable general , sirve tambien si se desea enviar una variable de session
      <script type="text/javascript">
        var action = '{!! Session::get('personaexpid') !!}';
      </script>   
      ************************************************************************************* 
         <script type="text/javascript">
            var action = 'create';   
          </script> 
        @endsection  --}}


@section('scripts')
    {{-- Carga el java script de dropdown --}}
    <script src="{{ url('/js/dropsdowndoc.js') }}"></script>
@endsection
