<table class="table table-responsive" id="medios-table">
    <thead>
        <tr>
        <th>Img</th>            
        <th>Ident</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Mask</th>
        <th>Imgfilename</th>        
        <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($medios as $medio)
        <tr>
            <td>
                <i class="{!! $medio->imgfilename !!}" style="color:grey"></i>
               {{--  <img width="16px" src="{!! Storage::Url($medio->imgfilename) !!}"  
                class="img-rounded" alt="fileimg">  --}}
            </td>
            <td>{!! $medio->ident !!} </td>
            <td>{!! $medio->nombre !!}</td>
            <td>{!! $medio->descripcion !!}</td>
            <td>{!! $medio->mask !!}</td>
            <td>{!! $medio->imgfilename !!}</td>
           
            <td>
                {!! Form::open(['route' => ['medios.destroy', $medio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('medios.show', [$medio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('medios.edit', [$medio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>