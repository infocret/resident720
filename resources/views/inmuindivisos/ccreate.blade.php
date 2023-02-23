@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar Cuotas            
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['id' => 'form1','name' => 'form1','route' => 'indivisos.cstore']) !!}
                        {{-- @include('propertyvalues.fields') --}}
                        @include('inmuindivisos.tableeditc') 
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
  <script type="text/javascript">
    var tpresup = '{{ $presupuesto }}';       
  </script> 
@endsection

@section('scripts')
    {{-- Carga el java script de dropdown --}}
    <script src="{{ url('/js/cuotas.js') }}"></script>
@endsection


