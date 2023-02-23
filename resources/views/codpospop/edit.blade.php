@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Cod Po
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($codPo, ['route' => ['codPos.update', $codPo->id], 'method' => 'patch']) !!}

                        @include('cod_pos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection