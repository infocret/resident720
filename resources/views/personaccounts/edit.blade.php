@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Personaccount
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($personaccount, ['route' => ['personaccounts.update', $personaccount->id], 'method' => 'patch']) !!}

                        @include('personaccounts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection