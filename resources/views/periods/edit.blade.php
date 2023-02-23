@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Period
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($period, ['route' => ['periods.update', $period->id], 'method' => 'patch']) !!}

                        @include('periods.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection