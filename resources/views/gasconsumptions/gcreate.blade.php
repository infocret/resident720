@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Registrar consumo de Gas
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    
                    {!! Form::open(['route' => 'gasconsum.gstore']) !!}

                        @include('gasconsumptions.gfields')

                    {!! Form::close() !!}
                     
                </div>
            </div>
        </div>
    </div>
  <script type="text/javascript">
    var lectant = '{{ $lectant->lant }}';   
    var gasprice = '{{ $gasprice }}';   
  </script> 
@endsection

@section('scripts')
    {{-- Carga el java script de calculo de consumo en lectura de gas --}}
    <script src="{{ url('/js/readgas.js') }}"></script>
@endsection

