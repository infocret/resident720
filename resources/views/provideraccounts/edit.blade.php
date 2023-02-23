@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Provideraccount
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($provideraccount, ['route' => ['provideraccounts.update', $provideraccount->id], 'method' => 'patch']) !!}

                        @include('provideraccounts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection