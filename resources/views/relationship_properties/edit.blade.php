@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Relationship Propertie
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($relationshipPropertie, ['route' => ['relationshipProperties.update', $relationshipPropertie->id], 'method' => 'patch']) !!}

                        @include('relationship_properties.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection