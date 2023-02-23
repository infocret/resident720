@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Bank
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($bank, ['route' => ['banks.update', $bank->id], 'method' => 'patch']) !!}

                        @include('banks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection