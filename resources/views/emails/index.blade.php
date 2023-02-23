@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Enviar Correo de prueba           
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">                   
                    {!! Form::open(['route' => 'testmail.send1',
                    'method'=>'post']) !!}  
                     <div class="clearfix"></div>
                    @include('flash::message')

                    {!! csrf_field() !!} 

                      @empty($filexls)     

                          <div class="form-group col-sm-2">
                              <img width="100px" src="/img/EmailSend.png"  
                              class="img-rounded" alt="/img/EmailSend.png">          
                          </div>
                           

                           <div class="form-group col-sm-4">
                            {!! Form::label('lname','Nombre:') !!}
                            {!! Form::text('tname', "Mi nombre", ['class' => 'form-control',
                                'required' => 'required']) !!}
                            {!! Form::label('lfrom','Correo De:') !!}
                            {!! Form::text('tfrom', "user@mail.com", ['class' => 'form-control',
                                'required' => 'required']) !!}
                            {!! Form::label('lto','Correo Para:') !!}
                            {!! Form::text('tto', "user@mail.com", ['class' => 'form-control',
                                'required' => 'required']) !!}    
                            {!! Form::label('lsub','Asunto:') !!}
                            {!! Form::text('tsub', "Asunto", ['class' => 'form-control',
                                'required' => 'required']) !!}  
                            {!! Form::label('lmsg','Mensaje:') !!}
                            {!! Form::text('tmsg', "Mensaje", ['class' => 'form-control',
                                'required' => 'required']) !!}      
                          </div>


                          <div class="form-group col-sm-4">
                               {!! Form::submit('Enviar >', ['class' => 'btn btn-primary']) !!}
                               
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