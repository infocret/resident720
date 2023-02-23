<div class="modal fade" id="creamovpop" 
     tabindex="-1" role="dialog" 
     aria-labelledby="cmovpopLabel">
  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">
      {!! Form::open(['route' => 'inmovto.storemovc']) !!}

      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="background: #6aad90" 
        id="creapopLabel" align="center">Aplicar movimiento</h4>
      </div>

      <div class="modal-body">       

        @include('adminlte-templates::common.errors')

          <div class="box-body"> 
              <div class="row">
            
              <table class="table table-responsive" style="background: #eeeeee" >
                <thead>
                      <tr>
                      <th class="tit1">Fecha</th> 
                      <th class="tit1"> Cve - Concepto</th>
                      <th class="tit1"> -</th>  
                      <th class="tit1"> Monto</th>                                    
                      </tr>
                </thead>
                <tbody>     
                <tr>           
                     <td>
                     {!! Form::label('cfechapa', 'x',['id'=>'cfechapa']) !!}
                     </td>
                     <td>       
                       {!! Form::label('cconceptpa', 'x',['id'=>'cconceptpa']) !!}
                      </td>
                      <th>$</th>
                      <td>
                       {!! Form::label('cmontopa', 'x',['id'=>'cmontopa']) !!}
                      </td>
                </tr>             
                <tr>           
                     <td>
                      {!! Form::date('date', 
                      \Carbon\Carbon::now(), ['class' => 'form-control']) !!}   
                     </td>
                     <td>       
                        <select name="smovto" id="smovto" 
                          class="form-control" required>
                        <option value="">Seleccione concepto:</option>
                        </select>
                      </td>
                      <th>$</th>
                      <td>
                        {!! Form::number('monto',0, ['class' => 'form-control','id' => 'mmonto','step' => 'any' ]) !!}
                      </td>
                </tr>
                </tbody>
              </table>
              <div class="form-group col-sm-12" style="background: #eeeeee" >
                {!! Form::label('lobserv', 'Observaciones:') !!}
                {!! Form::text('tobserv', 'N/A',        
                [
                'class' => 'form-control',
                'minlength'=>'1',
                'maxlength'=>'250',
                'required' => 'required'
                ]) !!}
                
                <input type="hidden" name="concepserv_id" id="concepserv_id" value="{{$cservid}}">
                <input type="hidden" name="cinmuch_id" id="cinmuch_id" value="{{$charge->chrid}}">
                <input type="hidden" name="inmovto_id" id="inmovto_id" value="0">
                <input type="hidden" name="cdfrom" id="cdfrom" value="{{$dfrom}}">
                <input type="hidden" name="cdto" id="cdto" value="{{$dto}}">               

              </div>

                          
              </div> <!-- row -->          
          </div>   <!-- body -->  
      </div> <!-- modal-body --> 

      <div class="modal-footer">
        <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Cancelar</button>
        <span class="pull-right">
        {!! Form::submit('Aplicar', ['class' => 'btn btn-primary']) !!}         
        </span>
      </div>

      {!! Form::close() !!}

    </div> {{-- modal-content --}}
  </div>
</div>
