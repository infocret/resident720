@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Movtohead
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($movtohead, ['route' => ['movtoheads.update', $movtohead->id], 'method' => 'patch']) !!}

                        @include('movtoheads.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection