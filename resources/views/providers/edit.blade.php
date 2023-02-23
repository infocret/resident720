@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Proveedor
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($providers, ['route' => ['providers.update', $providers->id], 'method' => 'patch']) !!}                    

                        @include('providers.fields')
               
                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>

   @include('providers.createpop'){{-- Incluye view para ventana modal --}}
      
{{--  *************************************************************************************
      Este script permite saber si se llama a  dropdownctas.js desde el create o el edit 
      y pasa una variable general , sirve tambien si se desea enviar una variable de session
      <script type="text/javascript">
        var action = '{!! Session::get('personaexpid') !!}';
      </script>   
      ************************************************************************************* --}}
  @if (isset($account)&& !empty($account)) 
    <script type="text/javascript">
      var action = 'edit';   
      var bank = {{   $account->bankid  }};
      var account = {{ $account->bankaccount_id }};
      var checkbook = {{  $account->checkbook_id  }};
      var rutax = '{{ url('/') }}';
    </script>   
  @else
    <script type="text/javascript">
      var action = 'edit';   
      var bank = 0;
      var account = 0;
      var checkbook = 0;
      var rutax = '{{ url('/') }}';
    </script>  
  @endif

@endsection


@section('css')
<link rel="stylesheet" href="{{ url('/css/tablescroll.css') }}">
@endsection


@section('scripts')
    {{-- Carga el java script de checkbox --}}
    <script src="{{ url('/js/checkbox.js') }}"></script>
    {{-- Carga el java script de dropdown de cuentas --}}
    <script src="{{ url('/js/dropsdownctas.js') }}"></script>
@endsection