{{--    +"asgnacion": "Inquilino"
    +"inmuebleid": 5
    +"inmuebletipo": 2
    +"inmuebletiponom": "Departamento"
    +"inmueblecve": "13803"
    +"inmueblenombre": "Depto 103 Grand Sta Fe"
    +"inmuebledesc": "Deptartamento 103 Grand Sta Fe"
    +"personaid": 8
    +"personanombre": "Jose"
    +"personapaterno": "Morelos"
    +"personmaterno": "Pavon"
    +"celular": null
    +"emailwork": null
    +"emailpers": "pavon@correo.com"
    +"teloffice": null
    +"reltipoid": 2 --}}
<table class="table table-responsive" id="inmuebles-table">
    <thead>
        <tr>
        <th>Exped</th>
        {{-- <th>Tipo</th>  --}}
        <th>Clave</th>
        {{-- <th>Ident</th> --}}
        <th>Asignación</th>
        {{-- <th>Expediente</th>  --}}
        <th>Nombre</th>                      
        {{-- <th>Paterno</th>
        <th>Materno</th> --}}
        <th>Contacto</th>

       {{--  <th>Celular</th>
        <th>Correo Trabajo</th>
        <th>Correo Personal</th>
        <th>Telefono</th> --}}
        {{-- <th colspan="3">Action</th> --}}
        </tr>
    </thead>
    <tbody>
    @foreach($condominos as $condomino)
        <tr>
            <td> 
               @if($condomino->personaid > 0)           
                <a href="{!! route('personaexp.index', [$condomino->personaid]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-folder-open"></i></a>
                @else
                 <i class="glyphicon glyphicon-folder-open"></i>
                @endif
            </td>
            {{--
            <td>                
                <a href="{!! route('propertyexp.index', [$condomino->inmuebleid]) !!}" 
                class='btn btn-default btn-xs'>
                <i class="glyphicon glyphicon-folder-open"></i></a>
            </td> 
            <td>{!! $condomino->inmuebletiponom !!}</td> 
            --}}
            <td>{!! $condomino->inmueblecve !!}</td>
            {{--<td>{!! $condomino->inmueblenombre !!}</td> --}}
            <td>{!! $condomino->asgnacion !!}</td>            
            <td>{!! $condomino->personanombre." ".
            $condomino->personapaterno." ".
            $condomino->personmaterno !!}</td>
            {{--   <td>{!! $condomino->personapaterno !!}</td>
            <td>{!! $condomino->personmaterno !!}</td> --}}
<td>
            <table cellspacing="2" cellpadding="2" > 
            <tr> 
            <td>
                @if (isset ($condomino->celular))                
                Sin Cel.
                @else
                {!! "Cel: ".$condomino->celular !!}                 
                @endif     
            </td> 
            <td>
                @if (isset ($condomino->teloffice))  
                Sin Tel.
                @else
                {!! "Tel: ".$condomino->teloffice !!}
                @endif    
            </td> 
            </tr> 
            <tr>
            <td>
                @if (isset ($condomino->emailwork))
                Sin e-Mail
                @else
                e-Mail:
                <a href="{!! "mailto:".$condomino->emailwork !!}">
                {{ $condomino->emailwork }}></a>                  
                @endif          

            <td>
            <td>  
                @if (isset($condomino->emailwork))
                Sin e-Mail
                @else
                e-Mail:
                <a href="{!! "mailto:".$condomino->emailpers !!}">
                {{ $condomino->emailpers }}</a>                 
                @endif              
            <td> 
            </tr> 
            </table> 
</td>
{{-- 
            <td>{!! $condomino->celular !!}</td>
            <td>{!! $condomino->emailwork !!}</td>
            <td>{!! $condomino->emailpers !!}</td>
            <td>{!! $condomino->teloffice !!}</td> --}}

          {{--   <td>
                {!! Form::open(['route' => ['inmuebles.destroy', $condomino->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inmuebles.show', [$condomino->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inmuebles.edit', [$condomino->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td> --}}
        </tr>
    @endforeach
    </tbody>
</table>