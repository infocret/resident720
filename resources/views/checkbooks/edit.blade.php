@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Checkbook
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($checkbook, ['route' => [$rutupdate, $checkbook->id], 'method' => 'patch']) !!}

                        @include('checkbooks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection