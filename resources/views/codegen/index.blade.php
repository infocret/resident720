@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Generar codigo .JSON y .txt a partir de excell             
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">                   
                    {!! Form::open(['route' => 'codegenjb.upload',
                    'method'=>'post','files'=>'true','enctype'=>'multipart/form-data']) !!}  
                     <div class="clearfix"></div>
                    @include('flash::message')

                    {!! csrf_field() !!} 

                      @empty($filexls)     

                          <div class="form-group col-sm-2">
                              <img width="100px" src="/img/excell.png"  
                              class="img-rounded" alt="/img/excell.png">          
                          </div>
                           <div class="form-group col-sm-4">
                               {!! Form::label('imagen', 
                               'Subir archivo de excell') !!}
                               {!! Form::file('Archivo', 
                               null, array('class' => 'form-control')) !!} 
                               {!! Form::label('destino','Destino: box/codegen/' ) !!}
                          </div>
                          <div class="form-group col-sm-4">
                               {!! Form::submit('Cargar Archivo', ['class' => 'btn btn-primary']) !!}
                               {{-- <p>{{ 'Prueba helper: '.GetPeriod::GetP() }}</p> --}}
                          </div> 
                          
                      @else
                           <div class="form-group col-sm-2">
                              <img width="100px" src=
                              "/img/excell.png"  
                              class="img-rounded" alt=
                              "/img/excell.png">
                          </div>

                        <div class="form-group col-sm-2">
                        <a 
                          href="{{ url('box/codegen/'.$filexls) }}" download="{{ $filexls }}">
                          Descargar {{ $filexls }}
                        </a>
                        </div>

                        <div class="form-group col-sm-2">
                        <a 
                          href="{{ url('box/codegen/'.$filejson) }}" download="{{ $filejson }}">
                          Descargar {{ $filejson }}
                        </a>
                        </div>

                        <div class="form-group col-sm-2">
                        <a 
                          href="{{ url('box/codegen/'.$filetxt) }}" download="{{ $filetxt }}">
                          Descargar {{ $filetxt }}
                        </a>
                        </div>
                        
                        <div class="form-group col-sm-2">
                        <a 
                          href="{!! route('codegenjb.index') !!}" class="btn btn-default">
                          Otro
                        </a> 
                        </div>

                      @endempty  


                     {!! Form::close() !!}    
                </div>
            </div>
        </div>
    </div>
@endsection