@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Measurunit
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($measurunit, ['route' => ['measurunits.update', $measurunit->id], 'method' => 'patch']) !!}

                        @include('measurunits.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection