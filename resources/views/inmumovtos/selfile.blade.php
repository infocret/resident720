@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
           Importar movimientos de unidades             
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">                   
                    {!! Form::open(['route' => 'movsimport.upload',
                    'method'=>'post','files'=>'true','enctype'=>'multipart/form-data']) !!}  
                     <div class="clearfix"></div>
                    @include('flash::message')

                    {!! csrf_field() !!} 
                  
                          <div class="form-group col-sm-2">
                              <img width="100px" src="/img/excell.png"  
                              class="img-rounded" alt="/img/excell.png">          
                          </div>
                          <div class="form-group col-sm-2">
                              {!! Form::radio('opfile', 'funo',true) !!}
                               {!! Form::label('imagen', 
                               'Un archivo') !!}
                               {!! Form::file('Archivo', 
                               null, array('class' => 'form-control')) !!} 
                               {!! Form::label('destino','Destino: box/import/' ) !!}
                          </div>
                          <div class="form-group col-sm-2">                            
                            {!! Form::radio('opfile', 'ftodo') !!}
                            {!! Form::label('opfi', 
                              'Todos los archivos') !!}
                          </div>

                           <div class="form-group col-sm-6">
                            <p>Recuerde que para importar la informacion de cargos y movimientos el condominio debe tener registrados, Areas, Proveedores, Conceptos y Servicios, Catalogo de movimientos, catalogo de medidad.
                            Y las unidades deben tener relacionados sus contratos de servicios.
                           </p>
                           </div>
                          <div class="clearfix"></div>

                          <div class="row">                               
                            <!-- Conceptserv Id Field -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('conceptserv_id', 'Concepto/Servicio:') !!}
                                <select name="conceptserv_id" id="conceptserv_id" 
                                class="form-control"  required>
                                <option value="">Seleccione concepto:</option>        
                                @foreach($concepservs as $concep)            
                                <option value="{{$concep->id}}"
                                {{$concep->cve == '1100' ? 'selected="selected"' : '' }}
                                >
                                 {{ $concep->cve.' - '.$concep->name }}</option>
                                @endforeach
                                </select>
                            </div>
                           

                            <!-- Proparea Id Field -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('proparea_id', 
                                'Area: ') !!}
                                 <select name="proparea_id" id="proparea_id" 
                                class="form-control"  required>
                                <option value="">Seleccione area:</option>        
                                @foreach($areas as $area)            
                                  <option value="{{$area->id}}"
                                  {{$area->nombre == 'Admin' ? 'selected="selected"' : '' }}
                                  >
                                    {{ $area->nombre.' - '.$area->descripcion }}</option>
                                @endforeach
                                </select>
                            </div>

                            <!-- Provider Id Field -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('provider_id', 
                                'Proveedor: ') !!}
                                <select name="provider_id" id="provider_id" 
                                class="form-control"  required>
                                <option value="">Seleccione proveedor:</option>        
                                @foreach($providers as $provider)            
                                  <option value="{{$provider->id}}"
                                {{$provider->nomcorto == 'ADP' ? 'selected="selected"' : '' }}
                                  >
                                    {{ $provider->nomcorto.' - '.$provider->razonsocial }}</option>
                                @endforeach
                                </select>
                            </div>

                            <!-- movimiento de cargo -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('lcmovto_id', 
                                'Movimiento de cargo: ') !!}
                                <select name="cmovto_id" id="cmovto_id" 
                                class="form-control"  required>
                                <option value="">Seleccione movimiento cargo:</option>        
                                @foreach($cmovtos as $cmovto)            
                                  <option value="{{$cmovto->id}}"
                                  {{$cmovto->cve == '1101' ? 'selected="selected"' : '' }}
                                  >
                                    {{ $cmovto->cve.' - '.$cmovto->name }}</option>
                                @endforeach
                                </select>
                            </div>

                            <!-- movimiento de abono -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('lamovto_id', 
                                'Movimiento de abono: ') !!}
                                <select name="amovto_id" id="amovto_id" 
                                class="form-control"  required>
                                <option value="">Seleccione movimiento abono:</option>        
                                @foreach($amovtos as $amovto)            
                                  <option value="{{$amovto->id}}"
                                  {{$amovto->cve == '1111' ? 'selected="selected"' : '' }}
                                  >
                                    {{ $amovto->cve.' - '.$amovto->name }}</option>
                                @endforeach
                                </select>
                            </div>

                            <!-- movimiento de cargo por saldo inicial -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('lcsdoimovto_id', 
                                'Movimiento saldo inicial: ') !!}
                                <select name="csdoimovto_id" id="csdoimovto_id" 
                                class="form-control"  required>
                                <option value="">Seleccione mov saldo ini:</option>        
                                @foreach($cmovtos as $cmovto)            
                                  <option value="{{$cmovto->id}}"
                                  {{$cmovto->cve == '1105' ? 'selected="selected"' : '' }}
                                  >
                                    {{ $cmovto->cve.' - '.$cmovto->name }}</option>
                                @endforeach
                                </select>
                            </div>

                            <!-- movimiento de abono por saldo inicial a favor -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('lasdoimovto_id', 
                                'Movimiento de saldo inicial a favor: ') !!}
                                <select name="asdoimovto_id" id="asdoimovto_id" 
                                class="form-control"  required>
                                <option value="">Seleccione mov saldo a favor:</option>        
                                @foreach($amovtos as $amovto)            
                                  <option value="{{$amovto->id}}"
                                  {{$amovto->cve == '1114' ? 'selected="selected"' : '' }}
                                  >
                                    {{ $amovto->cve.' - '.$amovto->name }}</option>
                                @endforeach
                                </select>
                            </div>

                             <!-- movimiento de nota de credito -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('lncmovto_id', 
                                'Movimiento de Nota Credito: ') !!}
                                <select name="ncmovto_id" id="ncmovto_id" 
                                class="form-control"  required>
                                <option value="">Seleccione movimiento nota credito:</option>        
                                @foreach($amovtos as $amovto)            
                                  <option value="{{$amovto->id}}"
                                  {{$amovto->cve == '1113' ? 'selected="selected"' : '' }}
                                  >
                                    {{ $amovto->cve.' - '.$amovto->name }}</option>
                                @endforeach
                                </select>
                            </div>

                            <!-- medida de cargo -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('lcmedida_id', 
                                'Unid. de medida de cargo: ') !!}
                                <select name="cmedida_id" id="cmedida_id" 
                                class="form-control"  required>
                                <option value="">Sel. medida de cargo:</option>        
                                @foreach($medidas as $medida)            
                                  <option value="{{$medida->id}}"
                                  {{$medida->nombre == 'servicio' ? 'selected="selected"' : '' }}
                                  >
                                    {{ $medida->nombre }}</option>
                                @endforeach
                                </select>
                            </div>

                            <!-- medida de abono -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('lamedida_id', 
                                'Unid. de medida de abono: ') !!}
                                <select name="amedida_id" id="amedida_id" 
                                class="form-control"  required>
                                <option value="">Sel. medida de abono:</option>        
                                @foreach($medidas as $medida)            
                                  <option value="{{$medida->id}}"
                                  {{$medida->nombre == 'pago' ? 'selected="selected"' : '' }}
                                  >
                                    {{ $medida->nombre }}</option>
                                @endforeach
                                </select>
                            </div>                            
                          </div>                           

                          <div class="form-group col-sm-12">
                               {!! Form::submit('Cargar Archivo', 
                               ['class' => 'btn btn-primary']) !!}
                               <a href="{!! route('condominios.index') !!}" 
                               class="btn btn-default">Cancelar</a>
                               {{-- <p>{{ 'Prueba helper: '.GetPeriod::GetP() }}</p> --}}
                          </div> 

                     {!! Form::close() !!}    
                </div>
            </div>
        </div>
    </div>
@endsection