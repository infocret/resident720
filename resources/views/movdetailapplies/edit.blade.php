@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Movdetailapplie
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($movdetailapplie, ['route' => ['movdetailapplies.update', $movdetailapplie->id], 'method' => 'patch']) !!}

                        @include('movdetailapplies.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection