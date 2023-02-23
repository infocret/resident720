@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Medio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($medio, ['route' => ['medios.update', $medio->id], 'method' => 'patch']) !!}

                        @include('medios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection