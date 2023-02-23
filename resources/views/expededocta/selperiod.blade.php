@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left"> Consulta de Movimientos </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body ">              
                <div class="row"> 
                <div class="form-group col-sm-12">                  
                <p>
                Seleccione los criterios de busqueda. 
                </p>
                </div>
                </div>

                <div class="row">                   
                    
                    {!! Form::open(['route' =>['edoscta.sendperiod'],
                    'method'=>'post']) !!} 

                     <div class="clearfix"></div>
                    @include('flash::message')

                    {!! csrf_field() !!} 
                
                          <div class="form-group col-sm-2">
                              <img width="100px" src="/img/calendar.png"  
                              class="img-rounded" alt="/img/calendar.png">          
                          </div>

                           <div class="form-group col-sm-4">
                            {!! Form::label('lfini','Fecha inicio:') !!}
                            {!! Form::date('dfrom', $dfrom , ['class' => 'form-control','required' => 'required']) !!}
                            
                            {!! Form::label('lfini','Fecha fin:') !!}
                            {!! Form::date('dto', $dto , ['class' => 'form-control','required' => 'required']) !!}

                            {!! Form::text('condomid', $condomid, ['class' => 'form-control',
                                'required' => 'required', 'style'=>'visibility:hidden']) !!}

                      {!! Form::label('lun','Unidad:') !!}
                      <select name="unidadid" id="unidmovto_id" class="form-control"  
                      required>
                       <!-- <option value="">Seleccione unidad</option>   -->                             
                       <option value="0" selected="selected">Todas</option>            
                          @foreach($unids as $unid)            
                            <option value="{{$unid->id}}">
                              {{ $unid->ident.' - '.$unid->descripcion }}</option>            
                          @endforeach
                      </select>


                  <!-- Conceptserv Id Field      -->
                       
                            {!! Form::label('conceptserv_id', 'Concepto/Servicio:') !!}
                            <select name="conceptserv_id" id="conceptserv_id" 
                            class="form-control"  required>
                            <!-- <option value="">Seleccione concepto:</option>   -->  
                             <option value="0" selected="selected">Todos</option>        
                            @foreach($concepservs as $concep)            
                            <option value="{{$concep->id}}">
                             {{ $concep->cve.' - '.$concep->name }}</option>
                            @endforeach
                            </select>
                


                                          
                    {!! Form::label('lchrid','Id / Folio (28 caracteres):') !!}
                           {!! Form::text('folio',old('folio'), ['class' => 'form-control']) !!}
     
                          </div>

                          <div class="form-group col-sm-4">
                               {!! Form::submit('Consultar', ['class' => 'btn btn-primary']) !!}
                          </div>  

                     {!! Form::close() !!}    
                </div>
            </div>
        </div>
    </div>
@endsection