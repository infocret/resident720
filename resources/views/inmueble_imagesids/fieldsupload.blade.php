<div class="clearfix"></div>
@include('flash::message')

{!! csrf_field() !!} 

  @empty($filename)     

      <div class="form-group col-sm-2">
          <img width="100px" src="{!! env('PATH_IMGINMU').env('DEFAULT_IMGINMU') !!}"  
          class="img-rounded" alt="{!!env('PATH_IMGINMU').env('DEFAULT_IMGINMU') !!}">          
      </div>
       <div class="form-group col-sm-4">
           {!! Form::label('imagen', 'Subir Imágen (archivo .png , 200x200 pixeles)') !!}
           {!! Form::file('Archivo', null, array('class' => 'form-control')) !!} 
           {!! Form::label('destino', 
           'Destino: box/'.env('FOLDER_IMGINMU').'/' 
           ) !!}
      </div>
      
  @else
   
      
      <div class="form-group col-sm-2">
          <img width="100px" src="{!!  env('PATH_IMGINMU').$filename  !!}"  
          class="img-rounded" alt="{!! env('PATH_IMGINMU').$filename !!}">
      </div>

  @endempty  
     
       <div class="form-group col-sm-4">
             {!! Form::submit('Cargar Imagen', ['class' => 'btn btn-primary']) !!}
              <a href="{!! route('propertyexp.index', Session::get('propertyid')) !!}" class="btn btn-default">Cancel</a>
        </div> 


