@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Movtodetail
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($movtodetail, ['route' => ['movtodetails.update', $movtodetail->id], 'method' => 'patch']) !!}

                        @include('movtodetails.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection