  <tfoot>
        <tr>               {{--  SubTotal   --}}
          <td>&nbsp;</td>       
          <td>&nbsp;</td>   
          <td>&nbsp;</td>  
          <td>&nbsp;</td>        
          <td style="text-align:right;">SubTotal</td>
          <td style="text-align:right;" >
             {!! Form::label('lstotal', '$ 0.00',
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
              {!! Form::label('liiva', '$ 0.00',
              ['style' => 'font-size:13pt','id' => 'iliiva']) !!}  
          </td>
          <td>&nbsp;</td>                   
        </tr>

        <tr>               {{--  GTotal   --}}  
          <td>&nbsp;</td>                                       
          <td>&nbsp;</td>    
          <td>&nbsp;</td>
          <td>&nbsp;</td>            
          <td style="text-align:right;">Total</td>
          <td style="text-align:right;" >
              {!! Form::label('lgtotal', '$ 0.00',
              ['style' => 'font-size:13pt','id' => 'ilgtotal']) !!}
          </td>  
          <td>
          <button type="button" class="btn btn-info btn-xs" onclick="total();">
             <span title="Recalcular" class=" glyphicon glyphicon-play "></span>
          </button>
          </td>                        
        </tr>
        
    </tfoot>