@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pers Inmu Reltipo Req Doc
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($persInmuReltipoReqDoc, ['route' => ['persInmuReltipoReqDocs.update', $persInmuReltipoReqDoc->id], 'method' => 'patch']) !!}

                        @include('pers_inmu_reltipo_req_docs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
  
  <script type="text/javascript">
    var action = 'create';   
    var rutax = '{{ url('/') }}';
  </script>

@endsection