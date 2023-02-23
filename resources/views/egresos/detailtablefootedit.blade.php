  <tfoot>
        <tr>               {{--  SubTotal   --}}
          <td>&nbsp;</td>       
          <td>&nbsp;</td>   
          <td>&nbsp;</td>  
          <td>&nbsp;</td>        
          <td style="text-align:right;">SubTotal</td>
          <td style="text-align:right;" >
             {!! Form::label('lstotal', '$ '.round($headmov->stotal,2),
              ['style' => 'font-size:13pt','id' => 'ilstotal']) !!}  
          </td>  
          <td> 
            <button type="button" class="btn btn-danger btn-xs" onclick="ClearAll();">
                <span title="Reiniciar" class="glyphicon glyphicon-refresh "></span>
            </button>
          </td>               
        </tr>

        <tr>               {{--  IVA   --}}
          <td>&nbsp;</td>       
          <td>&nbsp;</td>   
          <td>&nbsp;</td>  
          <td>&nbsp;</td>
          <td style="text-align:right;"><input type="checkbox" id="ichiva"  
              onclick="alteriva()" checked="true">IVA
          </td>
          <td style="text-align:right;" >
              {!! Form::label('liiva', '$ '.round($headmov->iva,2),
              ['style' => 'font-size:13pt','id' => 'iliiva']) !!}  
          </td>
          <td>&nbsp;</td>                   
        </tr>

        <tr>               {{--  GTotal   --}}  
          <td>&nbsp;</td>                                       
          <td>            
            <div  id = "idivcancel" class="form-group col-sm-12" > 
            <button  id="icanceldel" type="button" class="btn btn-info btn-xs"
             onclick="canceldeletefile()" >
            <span  title="Recuperar Archivo"
            class="fa fa-reply"></span>
            </button> 
            </div>
          </td>    
          <td>
            <button id="idellink" type="button" class="btn btn-danger btn-xs"
             onclick="deletefile()" >
            <span  title="Eliminar archivo PDF"
            class="glyphicon glyphicon-trash fa-1g"></span>
            </button> 
          </td>
          <td>             
            <img id="iimgpdf"width="32px" src="/img/pdf_42.png"  
              class="img-rounded" alt="/img/pdf_42.png">  
            <a id="ilinkfile"
              href="{{ $headmov->doc }}" target="_blank">
              Documento orignal nota/factura 
            </a>
          </td>            
          <td style="text-align:right;">Total</td>
          <td style="text-align:right;" >
              {!! Form::label('lgtotal',  '$ '.round($headmov->gtotal,2),
              ['style' => 'font-size:13pt','id' => 'ilgtotal']) !!}
          </td>  
          <td>
          <button type="button" class="btn btn-info btn-xs" onclick="total();">
             <span title="Recalcular" class=" glyphicon glyphicon-play "></span>
          </button>
          </td>                        
        </tr>
        
    </tfoot>