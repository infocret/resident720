@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Activitytracking
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($activitytracking, ['route' => ['activitytrackings.update', $activitytracking->id], 'method' => 'patch']) !!}

                        @include('activitytrackings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection