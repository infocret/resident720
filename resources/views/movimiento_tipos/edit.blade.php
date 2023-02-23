@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Movimiento Tipo
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($movimientoTipo, ['route' => ['movimientoTipos.update', $movimientoTipo->id], 'method' => 'patch']) !!}

                        @include('movimiento_tipos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection