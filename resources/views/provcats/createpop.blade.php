<div class="modal fade" id="creapop" 
     tabindex="-1" role="dialog" 
     aria-labelledby="creapopLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {!! Form::open(['route' => 'provcats.store']) !!}

      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="creapopLabel">Agregar Categoria</h4>
      </div>

      <div class="modal-body">       
        {{-- <div class="content"> --}}
        @include('adminlte-templates::common.errors')
       {{--  <div class="box box-primary">
            <div class="box-body"> --}}
          <div class="row">
              <!-- Tipo Field -->
              <div class="form-group col-sm-12">
                  {!! Form::label('tipo', 'Tipo:') !!}
                  <label class="radio-inline">
                      {!! Form::radio('tipo', "SE", null) !!} Servicios
                  </label>

                  <label class="radio-inline">
                      {!! Form::radio('tipo', "VP", null) !!} Venta productos y/o materiales
                  </label>                  
              </div>
              <!-- Categoria Field -->
              <div class="form-group col-sm-6">
                  {!! Form::label('categoria', 'Categoria:') !!}
                  {!! Form::text('categoria', null, ['class' => 'form-control']) !!}
              </div>                 
          </div>           
      </div>

      <div class="modal-footer">
        <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Close</button>
        <span class="pull-right">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!} 
        {{--   <button type="button" class="btn btn-primary">
            Guardar
          </button> --}}
        </span>
      </div>
      {!! Form::close() !!}
    </div> {{-- modal-content --}}
  </div>
</div>
