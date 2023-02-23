@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left"> Reprogramar ejecución de  procedimiento en contrato </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body ">              
                <div class="row"> 
                <div class="form-group col-sm-12">                  
                <p>
                  Asigne la fecha en que desea se ejecute el procedimiento. 
                </p>
                </div>
                </div>

                <div class="row">                   
                    
                    {!! Form::open(['route' => ['procedmovtos.programar'],
                    'method'=>'post']) !!}

            
                     <div class="clearfix"></div>
                      @include('flash::message')

                    {!! csrf_field() !!} 
                
                          <div class="form-group col-sm-2">
                              <img width="100px" src="/img/calendar.png"  
                              class="img-rounded" alt="/img/calendar.png">          

                            {!! Form::hidden('id', $id, 
                            ['class' => 'form-control','readonly'=>'readonly']) !!}
                          
                          </div>

                           <div class="form-group col-sm-4">
                            {!! Form::label('lfini','Fecha inicio:') !!}
                            {!! Form::date('dfecha', $fecha , ['class' => 'form-control','required' => 'required']) !!}
                          </div>

                          <div class="form-group col-sm-4">
                            <a class="btn btn-default" 
                            href="{!! route('procedmovtos.index') !!}">Cancelar</a>

                            {!! Form::submit('Programar', ['class' => 'btn btn-primary']) !!}
                          </div>  

                     {!! Form::close() !!}    
                </div>
            </div>
        </div>
    </div>
@endsection