@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detailmov
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($detailmov, ['route' => ['detailmovs.update', $detailmov->id], 'method' => 'patch']) !!}

                        @include('detailmovs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection