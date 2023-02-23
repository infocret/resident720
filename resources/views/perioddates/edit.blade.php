@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Perioddate
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($perioddate, ['route' => ['perioddates.update', $perioddate->id], 'method' => 'patch']) !!}

                        @include('perioddates.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection