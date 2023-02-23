@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Statusticketimg
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($statusticketimg, ['route' => ['statusticketimgs.update', $statusticketimg->id], 'method' => 'patch']) !!}

                        @include('statusticketimgs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection