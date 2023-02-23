  <!-- dir Field -->
  <div class="form-group">
      {!! Form::label('dir', 'Dirección:',['id'=>'dirl']) !!}
      {!! Form::label('dird', $personaDir->dir,['id'=>'dird']) !!}
       {{--  <p>{!! $personaDir->dir !!}</p> --}}
  </div>

<table class="table table-responsive" id="personaubicshow-table">

<tr>       
  <td>
      <!-- Referencia1 Field -->
      <div class="form-group">
          {!! Form::label('referencia1', 'Referencia1:',['id'=>'ref1l']) !!}
          {!! Form::label('ref1d', $personaDir->referencia1,['id'=>'ref1d']) !!}
         {{--  <p>{!! $personaDir->referencia1 !!}</p> --}}

      </div>
  </td>
  <td>
  <!-- Referencia2 Field -->
  <div class="form-group">
      {!! Form::label('referencia2', 'Referencia2:',['id'=>'ref2l']) !!}
      {!! Form::label('ref2d', $personaDir->referencia2 ,['id'=>'ref2d']) !!}
      {{-- <p>{!! $personaDir->referencia2 !!}</p> --}}
  </div>
  </td>
</tr>

<tr>
  <td>
  <!-- Observaciones Field -->
  <div class="form-group">
      {!! Form::label('observaciones', 'Observaciones:',['id'=>'obsl']) !!}
      {!! Form::label('obsd',$personaDir->observaciones,['id'=>'obsd']) !!}
      {{-- <p>{!! $personaDir->observaciones !!}</p> --}}
  </div>
  </td>

  <td>
  <!-- Linkmapa Field -->
  <div>
      {!! Form::label('linkmapa', 'Mapa:',['id'=>'lmapl']) !!}
  </div>
  <div>
    @if (is_null($personaDir->linkmapa) || $personaDir->linkmapa == "N/A" || $personaDir->linkmapa == "n/a")
        <a href="{!! env('Gmaps_Search2').$personaDir->dir !!}" class='btn btn-default btn-xs' target="_blank">
          <i class="glyphicon fa fa-map" style="color:green"></i>
        </a> 
    @else
        <a href="{!! $personaDir->linkmapa !!}" class='btn btn-default btn-xs' target="_blank">
         <i class="glyphicon fa fa-map" style="color:green"></i>
        </a>  
    @endif    
  </div>
  </td>
</tr>

</tbody>
</table>

<!-- Imagenmapa Field -->
<div >
  @if (is_null($personaDir->imagenMapa) || $personaDir->imagenMapa == "N/A" || $personaDir->imagenMapa == "n/a")
     <img src="/img/sinmapa.png" height="85" width="200" alt="imgmap"/>
  @else
     <img src="{{ env('PATH_IMGMAPS').$personaDir->imagenMapa }}" 
     height="500" width="1000" alt="imgmap"/>     
  @endif
</div>

{{-- array:1 [▼
  0 => {#365 ▼
    +"id": 1
    +"nombre": "Hogar"
    +"dir": "Retorno 7 de Sur 20 Num. 20 Int. 5 Piso 2 Colonia Agrícola Oriental, Iztacalco, Ciudad de México. CP 08500"
    +"pais": "México"
    +"referencia1": "Entre av sur 16 , av sur 20 , ote. 253 y ote 257"
    +"referencia2": "Al lado de primaria "Juan B. Molina", Espaldas de Kinder , 2 calles de Panad Esperanza"
    +"imagenMapa": "img"
    +"linkmapa": "https://goo.gl/maps/D596SUAw3Cw"
    +"observaciones": "Nada"
  }
] --}}
