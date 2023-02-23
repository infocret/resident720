@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inmueble Imagesids
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inmuebleImagesids, ['route' => ['inmuebleImagesids.update', $inmuebleImagesids->id], 'method' => 'patch']) !!}

                        @include('inmueble_imagesids.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection