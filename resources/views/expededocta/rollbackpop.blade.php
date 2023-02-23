<div class="modal fade" id="rollbackpop" 
     tabindex="-1" role="dialog" 
     aria-labelledby="cmovpopLabel">
  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">
      {!! Form::open(['route' => 'inmovto.aplirback']) !!}

      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="background: #6aad90" 
        id="creapopLabel" align="center">Reversar una cancelación / devolución</h4>
        <p> - Se reversará un movimiento de cancelación o devolución </p>
        <p> - Se restaurará el movimiento de abono / pago </p>
        <p> - Se atualizará el saldo y estatus del concepto / servicio </p>        
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
                      <th class="tit1"> Folio</th>
                      <th class="tit1"> -</th>  
                      <th class="tit1"> Monto</th>                                    
                      </tr>
                </thead>
                <tbody>     
                <tr>           
                    <td>
                        {!! Form::label('cafecha', 'x',['id'=>'cafecha']) !!}
                    </td>
                    <td> 
                     <i class="glyphicon glyphicon-remove"></i>      
                        {!! Form::label('caconcept', 'x',['id'=>'caconcept']) !!}
                    </td>
                    <td>
                        {!! Form::label('cafolio', 'x',['id'=>'cafolio']) !!}
                    </td>
                    <td>$</td>
                    <td>
                        {!! Form::label('camonto', 'x',['id'=>'camonto']) !!}
                    </td>
                </tr>                    
                <tr>           
                    <td>
                        {!! Form::label('pafecha', 'x',['id'=>'pafecha']) !!}
                    </td>
                    <td> 
                        <i class="glyphicon glyphicon-ok"></i>        
                        {!! Form::label('paconcept', 'x',['id'=>'paconcept']) !!}
                    </td>
                    <td>
                        {!! Form::label('pafolio', 'x',['id'=>'pafolio']) !!}
                    </td>
                    <td>$</td>
                    <td>
                        {!! Form::label('pamonto', 'x',['id'=>'pamonto']) !!}
                    </td>
                </tr>
                </tbody>
              </table>
              <div class="form-group col-sm-12" style="background: #eeeeee" >
            
                <input type="hidden" name="roncepserv_id" id="roncepserv_id" value="{{$cservid}}">
                <input type="hidden" name="rinmuch_id" id="rinmuch_id" value="{{$charge->chrid}}">
                <input type="hidden" name="rmovcancel_id" id="rmovcancel_id" value="0">
                <input type="hidden" name="rmovto_id" id="rmovto_id" value="0">
                <input type="hidden" name="rdfrom" id="rdfrom" value="{{$dfrom}}">
                <input type="hidden" name="rdto" id="rdto" value="{{$dto}}">              

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
