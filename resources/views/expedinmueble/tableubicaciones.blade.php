<table class="table table-responsive" id="personaDirs-table">
    <thead>
        <tr>   
        <th>Mapa</th>     
        <th>Ubicación</th>
        <th>Dirección</th>
        {{-- <th colspan="3">Action</th> --}}
        </tr>
    </thead>
    <tbody>
    @foreach($inmuDirs as $inmuDir)
        <tr>      
            <td>
                <a href="{!! $inmuDir->linkmapa !!}" class='btn btn-default btn-xs' target="_blank">
                    <i class="glyphicon fa fa-map" style="color:green"></i>
                </a>                 
            </td>     
            <td>{!! $inmuDir->nombre !!}</td>
            <td>{!! $inmuDir->dir !!}</td>
            {{-- <td>
                {!! Form::open(['route' => ['inmubicaciones.destroy', $inmuDir->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inmubicaciones.show', [$inmuDir->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inmubicaciones.pdfshow', [$inmuDir->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-save-file"></i></a>
                    <a href="{!! route('inmubicaciones.edit', [$inmuDir->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td> --}}
        </tr>
    @endforeach
    </tbody>
</table>