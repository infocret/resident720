@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit movimiento
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($headmov, ['route' => ['inmovtos.update', $headmov->id], 'method' => 'patch','enctype'=>'multipart/form-data']) !!}

                        @include('inmumovs.fieldsedit')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
    {{--  *************************************************************************************
      Este script permite saber si se llama a  inmumovtos.js desde el create o el edit 
      y pasa una variable general , sirve tambien si se desea enviar una variable de session
      <script type="text/javascript">
        var action = '{!! Session::get('personaexpid') !!}';
      </script>   
      ************************************************************************************* --}}  
 <script type="text/javascript">
    var action = 'edit';   
    var rutax = '{{ url('/') }}';
    var variva = .16;
    var tmovtos ={!! json_encode($TiposMovtos) !!};
    var tunidades ={!! json_encode($Unidades) !!};
    var idetrow = 0;
    var fileexist ='{{ $headmov->doc }}';
  </script>
@endsection

@section('scripts')
    {{-- Carga el java script de inmumovtos --}}
    <script src="{{ url('/js/inmumovtos.js') }}"></script>   
@endsection