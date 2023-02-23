@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar Cuenta Bancaria
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($propaccount, ['route' => 
                   ['condomaccounts.update', $propaccount->id,$inmuid], 
                   'method' => 'patch']) !!}

                        @include('condomaccounts.fields_edit')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
{{--  *************************************************************************************
      Este script permite saber si se llama a  dropdownctas.js desde el create o el edit 
      y pasa una variable general , sirve tambien si se desea enviar una variable de session
      <script type="text/javascript">
        var action = '{!! Session::get('personaexpid') !!}';
      </script>   
      ************************************************************************************* --}}    
  <script type="text/javascript">
    var action = 'edit';   
    var rutax = '{{ url('/') }}';
  </script>
@endsection

@section('scripts')
    {{-- Carga el java script de dropdown --}}
    <script src="{{ url('/js/dropsdownctas.js') }}"></script>
@endsection
{{-- 
{#1449 ▼
  +"id": 1
  +"banco": "BANAMEX"
  +"bank_id": 1
  +"bcta_id": 1
  +"ctanom": "Banamex 5024"
  +"ctanum": "1409615024"
  +"clabe": "012180014096150240"
  +"ctadesc": "Cta de recepción de pagos"
  +"moneda": "MXN"
  +"tipocta": "ING"
  +"contable": "CtaContable"
  +"apertura": "2018-10-17 00:00:00"
  +"convenio": "999888777666"
  +"checkdesc": "Sin Chequera"
  +"checkini": "0"
  +"checkfin": "0"
} 
--}}