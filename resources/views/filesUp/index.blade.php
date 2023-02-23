@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Imagen de Perfil </h1>      
    </section>
    
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')

   {!! Form::open(['url' => 'upload','method'=>'post','files'=>'true','enctype'=>'multipart/form-data']) !!} 
   {!! csrf_field() !!} 

  @empty($filename)                 
      <div class="form-group col-sm-2">
          <img width="100px" src="{!! env('PATH_IMGIDS')."personaid.png" !!}"  
          class="img-rounded" alt="{!!env('PATH_IMGIDS')."personaid.png" !!}">
      </div>
       <div class="form-group col-sm-4">
           {!! Form::label('imagen', 'Subir Imágen (archivo .png , 200x200 pixeles)') !!}
           {!! Form::file('Archivo', null, array('class' => 'form-control')) !!}        
      </div>

{{--       <div class="form-group col-sm-4">
          {!! Form::label('msgimagen', Storage::url('imagen/contactpic.png') )  !!} 
      </div> --}}
  @else
      <div class="form-group col-sm-2">
          <img width="100px" src="{!!  env('PATH_IMGIDS').$filename  !!}"  
          class="img-rounded" alt="{!! env('PATH_IMGIDS').$filename !!}">
      </div>
       <div class="form-group col-sm-4">
           {!! Form::label('imagen', 'Subir Imágen (archivo .png , 200x200 pixeles)') !!}
           {!! Form::file('Archivo', null, array('class' => 'form-control')) !!}
        
      </div>  
  
{{--       <div class="form-group col-sm-4">
          {!! Form::label('msgimagen', Storage::url('box/imgid/'.$filename) )  !!} 
      </div> --}}
      {{-- <div class="form-group col-sm-12">
      <img width="100px" src="{!! Storage::url('imagen/'.$filename)  !!}"  
      class="img-rounded" alt="{!!Storage::url('imagen/'.$filename) !!}">
      </div>
      {!! Form::label('msgimagen', Storage::url('imagen/'.$filename) )  !!}   --}}    
    

       
     {{--    <img width="100px" src="{!! '../'.Storage::Url('imagen/'.$filename) !!}"  
        class="img-rounded" alt="{!! '../'.Storage::Url('imagen/'.$filename) !!}">
         {!! Form::label('msgimagen', '../'.Storage::Url('imagen/'.$filename) ) !!}   --}}
  @endempty
  
        <div class="form-group col-sm-4">
             {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
      </div>     

      



   {!! Form::close() !!}

    </div>
@endsection


{{-- {!! Form::open(['route' => 'personas.store']) !!}

                        @include('personas.fields')

                    {!! Form::close() !!} --}}

        {{-- <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('inmuebles.table')
            </div>
        </div> --}}


