
    {{-- 
    +"asignado":0    
    +"id": 1
    +"tipo": "SE"
    +"ofrece": "Servicios"
    +"categoria": "Acabados" 
    --}}
<div class="form-group col-sm-4">
    <table class="table table-responsive" id="categorias-tableh">
        <thead>
            <H5>
                Asigne las categorias del proveedor
            </H5>
            <tr>         
            <th>Asignar</th>  
            <th>Que Ofrece</th>        
            </tr>
            <tr>
                <a id="unmark" href="#">
                <i class="fa fa-square-o"></i>
                <span>Desmarcar todo</span>
                </a>
            </tr>
        </thead>
    </table>  
      
    <div  id="div1" class="form-group col-sm-3">
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
