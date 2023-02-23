@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Articlescategorie
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($articlescategorie, ['route' => ['articlescategories.update', $articlescategorie->id], 'method' => 'patch']) !!}

                        @include('articlescategories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection