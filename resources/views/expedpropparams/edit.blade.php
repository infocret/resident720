@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Propertyparameter
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($propertyparameter, ['route' => ['pparams.update', $propertyparameter->id, $condomid], 'method' => 'patch']) !!}

                        @include('expedpropparams.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection