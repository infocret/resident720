@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Checkbooktracking
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($checkbooktracking, ['route' => ['checkbooktrackings.update', $checkbooktracking->id], 'method' => 'patch']) !!}

                        @include('checkbooktrackings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection