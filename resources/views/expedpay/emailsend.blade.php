@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left"> Enviar correo de Recibo de Pago y anexar PDF </h1>

        <h1 class="pull-right">
        <a class="btn btn-primary pull-right" 
        style="margin-top: -10px;margin-bottom: 5px; margin-left: 10px" 
        href="{!! url()->previous() !!}" >Volver</a>
        </h1>

    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">                   
                    {!! Form::open(['route' => 'cpay.sendrecipmail',
                    'method'=>'post']) !!}  
                     <div class="clearfix"></div>
                    @include('flash::message')

                    {!! csrf_field() !!} 

                          <div class="form-group col-sm-2">
                              <img width="100px" src="/img/EmailSend.png"  
                              class="img-rounded" alt="/img/EmailSend.png">          
                          </div>
                           

                           <div class="form-group col-sm-4">
                            {!! Form::label('lname','Remitente:') !!}
                            {!! Form::text('tname', $mailhead->tname, ['class' => 'form-control',
                                'required' => 'required']) !!}
                            {!! Form::label('lfrom','Correo remitente:') !!}
                            {!! Form::text('tfrom', $mailhead->tfrom, ['class' => 'form-control',
                                'required' => 'required']) !!}
                            {!! Form::label('lto','Correo Destinatario:') !!}
                            {!! Form::text('tto', $mailhead->tto, ['class' => 'form-control',
                                'required' => 'required']) !!}    
                            {!! Form::label('lsub','Asunto:') !!}
                            {!! Form::text('tsub',$mailhead->tsub, ['class' => 'form-control',
                                'required' => 'required']) !!}  
                            {!! Form::label('lmsg','Nota / Mensaje:') !!}
                            {!! Form::text('tmsg', $mailhead->tmsg, ['class' => 'form-control',
                                'required' => 'required']) !!}  
                            {!! Form::text('thid', $chrid, ['class' => 'form-control',
                                'required' => 'required', 'style'=>'visibility:hidden']) !!}          
                            {!! Form::text('tmid', $movtoid, ['class' => 'form-control',
                                'required' => 'required', 'style'=>'visibility:hidden']) !!}          
                          </div>


                          <div class="form-group col-sm-4">
                               {!! Form::submit('Enviar >', ['class' => 'btn btn-primary']) !!}
                          </div>  

                     {!! Form::close() !!}    
                </div>
            </div>
        </div>
    </div>
@endsection