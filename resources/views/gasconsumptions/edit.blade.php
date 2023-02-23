@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gasconsumption
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($gasconsumption, ['route' => ['gasconsumptions.update', $gasconsumption->id], 'method' => 'patch']) !!}

                        @include('gasconsumptions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection