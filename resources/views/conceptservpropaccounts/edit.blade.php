@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Conceptservpropaccount
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($conceptservpropaccount, ['route' => ['conceptservpropaccounts.update', $conceptservpropaccount->id], 'method' => 'patch']) !!}

                        @include('conceptservpropaccounts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection