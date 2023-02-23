@extends('layouts.app')

@section('content')
 
    <section class="content-header">      
    {!! Form::open(['route' => 'gasconsum.gmonth']) !!} 
      <div class="form-group col-sm-4">    
       <h2 class="pull-left">Lectras de GAS</h2> 
      </div>
    

      <div class="form-group col-sm-3"> 
      <select name="gmonth" id="gmonth" class="form-control"  
      required>
      <option value="">Mes</option>                               
        @foreach($meses as $key => $value)            
          @if ($key == $vmonth)
          <option value="{{$key}}" selected="selected">{{ $value }}</option>            
          @else
          <option value="{{$key}}" >{{ $value }}</option>            
          @endif
        @endforeach
      </select>
      </div>

      <div class="form-group col-sm-3">       
      <select name="gyear" id="gyear" class="form-control"  
      required>
      <option value="">Año</option>                               
        @foreach($años as $key => $value)            
          @if ($key == $vyear)
          <option value="{{$key}}" selected="selected">{{ $value }}</option>            
          @else
          <option value="{{$key}}" >{{ $value }}</option>            
          @endif
        @endforeach
      </select>
      </div>
          
      <div class="form-group col-sm-2">   
       {!! Form::submit('Consultar', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!} 
    </section>
    
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('gasconsumptions.tablec')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection