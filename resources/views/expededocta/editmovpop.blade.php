<div class="modal fade" id="editmovpop" 
     tabindex="-1" role="dialog" 
     aria-labelledby="cmovpopLabel">
  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">
      {!! Form::open(['route' => 'inmovto.apliupdate']) !!}

      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="background: #6aad90" 
        id="creapopLabel" align="center">Editar movimiento</h4>
<!--         <p> - Se reversará un movimiento de cancelación o devolución </p>
        <p> - Se restaurará el movimiento de abono / pago </p>
        <p> - Se atualizará el saldo y estatus del concepto / servicio </p>   -->      
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
                      {!! Form::date('moddate', \Carbon\Carbon::now(), ['class' => 'form-control','id' => 'moddate']) !!}   
                     </td>
                     <td>       
                        <select name="modconcep" id="modconcep" 
                          class="form-control" required>
                        <option value="">Seleccione concepto:</option>
                        </select>
                      </td>
                      <th>$</th>
                      <td>
                        {!! Form::number('modmonto',0, ['class' => 'form-control','id' => 'modmonto','step' => 'any' ]) !!}
                      </td>
                </tr>
                </tbody>
              </table>          

              <div class="form-group col-sm-12" style="background: #eeeeee" >            
                <input type="hidden" name="modconcepserv_id" id="modconcepserv_id" value="{{$cservid}}">
                <input type="hidden" name="modinmuch_id" id="modinmuch_id" value="{{$charge->chrid}}">
                <input type="hidden" name="modmovto_id" id="modmovto_id" value="0">
                <input type="hidden" name="origmonto" id="origmonto" value="0">
                <input type="hidden" name="moddfrom" id="moddfrom" value="{{$dfrom}}">
                <input type="hidden" name="moddto" id="moddto" value="{{$dto}}">              
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
