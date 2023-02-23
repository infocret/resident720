@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Categorie Providers
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($categorieProviders, ['route' => ['categorieProviders.update', $categorieProviders->id], 'method' => 'patch']) !!}

                        @include('categorie_providers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection