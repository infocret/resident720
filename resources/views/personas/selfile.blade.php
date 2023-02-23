@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
           Iportar datos de personas a Unidad desde archivo de excell             
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">                   
                    {!! Form::open(['route' => 'personasimport.upload',
                    'method'=>'post','files'=>'true','enctype'=>'multipart/form-data']) !!}  
                     <div class="clearfix"></div>
                    @include('flash::message')

                    {!! csrf_field() !!} 
                  
                          <div class="form-group col-sm-2">
                              <img width="100px" src="/img/excell.png"  
                              class="img-rounded" alt="/img/excell.png">          
                          </div>

                           <div class="form-group col-sm-4">
                               {!! Form::label('imagen', 
                               'Subir archivo de excell') !!}
                               {!! Form::file('Archivo', 
                               null, array('class' => 'form-control')) !!} 
                               {!! Form::label('destino','Destino: box/import/' ) !!}
                          </div>


                          <!-- Condominio -->
                          <div class="form-group col-sm-6">
                          {!! Form::label('linmuebles', 'Condominio Destino:') !!} 
                            <select name="linmuebles" id="linmuebles" class="form-control"  required>
                               <option value="">Seleccione Condominio:</option>
                                  @foreach($condominios as $condominio)            
                                      <option value="{{$condominio ->id}}">
                                        {{ $condominio ->id."-".$condominio ->nombre }}</option>            
                                  @endforeach
                              </select>    
                           </div>


                          <div class="form-group col-sm-4">
                               {!! Form::submit('Cargar Archivo', ['class' => 'btn btn-primary']) !!}
                               <a href="{!! route('personas.index') !!}" class="btn btn-default">Cancelar</a>                              
                          </div> 

                     {!! Form::close() !!}    
                </div>
            </div>
        </div>
    </div>
@endsection