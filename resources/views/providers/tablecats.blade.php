
    {{-- 
    +"asignado":0    
    +"id": 1
    +"tipo": "SE"
    +"ofrece": "Servicios"
    +"categoria": "Acabados" 
    --}}
<div class="form-group col-sm-12">
    <table class="table table-responsive" id="categorias-tableh">
        <thead>
            <tr>         
            <th>Asignar</th>  
            <th>Que Ofrece</th>   
            <th><a id="unmark" href="#">
                <i class="fa fa-square-o"></i>
                <span>Desmarcar todo</span>
                </a>
            </th>
            </tr>            
        </thead>
    </table>  
      
    <div  id="div1" class="form-group col-sm-12">
    <table class="table table-responsive" id="categorias-table">   
        <tbody>
        @foreach($categorias as $cat)
            <tr>   
             <td>{{ Form::checkbox('cat[]',$cat->id,$cat->asignado) }}</td>             
             <td>{!! $cat->ofrece ." - ".$cat->categoria  !!}</td> 
            </tr>
        @endforeach
        </tbody>
    </table>

    </div>
    
</div>
