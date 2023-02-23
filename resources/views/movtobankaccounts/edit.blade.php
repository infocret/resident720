@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Movtobankaccount
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($movtobankaccount, ['route' => ['movtobankaccounts.update', $movtobankaccount->id], 'method' => 'patch']) !!}

                        @include('movtobankaccounts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection