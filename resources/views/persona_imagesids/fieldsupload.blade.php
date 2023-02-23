<div class="clearfix"></div>
@include('flash::message')

{{-- {!! Form::open(['url' => 'upload','method'=>'post','files'=>'true','enctype'=>'multipart/form-data']) !!}  --}}
{!! csrf_field() !!} 

  @empty($filename)     

      <div class="form-group col-sm-2">
          <img width="100px" src="{!! env('PATH_IMGIDS').env('DEFAULT_IMGID') !!}"  
          class="img-rounded" alt="{!!env('PATH_IMGIDS').env('DEFAULT_IMGID') !!}">          
      </div>
       <div class="form-group col-sm-4">
           {!! Form::label('imagen', 'Subir Imágen (archivo .png , 200x200 pixeles)') !!}
           {!! Form::file('Archivo', null, array('class' => 'form-control')) !!} 
           {!! Form::label('destino', 
           'Destino: box/'.env('FOLDER_IMGIDS').'/' 
           ) !!}
      </div>
        {{-- 
          'Destino: '.public_path('box').'/'.env('FOLDER_IMGIDS')
        <div class="form-group col-sm-4">
          {!! Form::label('msgimagen', Storage::url('imagen/contactpic.png') )  !!} 
                </div> --}}

      
  @else
   
      
      <div class="form-group col-sm-2">
          <img width="100px" src="{!!  env('PATH_IMGIDS').$filename  !!}"  
          class="img-rounded" alt="{!! env('PATH_IMGIDS').$filename !!}">
      </div>

{{--        <div class="form-group col-sm-4">
           {!! Form::label('imagen', 'Subir Imágen (archivo .png , 200x200 pixeles)') !!}
           {!! Form::file('Archivo', null, array('class' => 'form-control')) !!}        
      </div> --}}  


  @endempty  
     
       <div class="form-group col-sm-4">
             {!! Form::submit('Cargar Imagen', ['class' => 'btn btn-primary']) !!}
              <a href="{!! route('personaexp.index', Session::get('personaexpid')) !!}" class="btn btn-default">Cancel</a>
        </div> 


