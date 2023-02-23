<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kali</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
 
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style >
 /*Titulos de campo*/
#dirl,
#ref1l,
#ref2l,
#obsl
 {

  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  margin: 4px;
  padding: 4px 4px 4px 9px;
  border: none;
  font: normal normal bold 15px/1 Arial, Helvetica, sans-serif;
  color: rgba(0,0,0,1);
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
  text-shadow: 2px 2px 3px rgba(0,0,0,0.5) ;
  width:70%;
}

 /*Titulos de campo
#dird,
#ref1d,
#ref2d,
#obsd */
p
 {
 -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  margin: 2px;
  padding: 4px 4px 4px 10px;
  border: 1px solid rgba(104,99,99,1);
  -webkit-border-radius: 10px;
  border-radius: 10px;
  font: normal normal bold 14px/1 Arial, Helvetica, sans-serif;
  color: rgba(0,0,0,1);
   -o-text-overflow: ellipsis;
  text-overflow: ellipsis; 
  background: #ecf0f1;
  -webkit-box-shadow: 4px 4px 6px 1px rgba(0,0,0,0.4) ; 
  box-shadow: 4px 4px 6px 1px rgba(0,0,0,0.4) ;
  width:85%;
 
 
}

#dirdiv{
 width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 30px;
  border: 3px solid rgba(104,99,99,1);

}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 30px;
  border: 3px solid rgba(104,99,99,1);
}

table th,
table td {
  text-align: center;
  border: 3px solid rgba(104,99,99,1);
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}



table td {
  padding: 20px;
  text-align: left;
}

</style>





</head>

<body >
        <!-- Content Wrapper. Contains page content -->
   
              <section class="content-header">
                    <h1>
                        {{-- <p>{{url(env('PATH_IMGIDS')).'/'.Session::get('imgeidexp') }}</p> --}}
                         <img src="{{url(env('PATH_IMGIDS')).'/'.Session::get('imgeidexp') }}" width="60"  > - 
                        
                         {!! Session::get('nomexp') !!} - 
                        Ubicación - {!! $personaDir->pais !!} - {!! $personaDir->nombre !!} - 
                         <img src="img/adplogo_110.png" width="110">
                        
                    </h1>
                </section> 
        <!-- dir Field -->
  <div id="dirdiv" class="form-group">
      {!! Form::label('dir', 'Dirección:',['id'=>'dirl']) !!}
      {{-- {!! Form::label('dird', $personaDir->dir,['id'=>'dird']) !!} --}}
        <p>{!! $personaDir->dir !!}</p> 
  </div>

<table class="table table-responsive" id="personaubicshow-table">

<tr>       
  <td>
      <!-- Referencia1 Field -->
      <div class="form-group">
          {!! Form::label('referencia1', 'Referencia1:',['id'=>'ref1l']) !!}
         {{--  {!! Form::label('ref1d', $personaDir->referencia1,['id'=>'ref1d']) !!} --}}
           <p>{!! $personaDir->referencia1 !!}</p> 

      </div>
  </td>
  <td>
  <!-- Referencia2 Field -->
  <div class="form-group">
      {!! Form::label('referencia2', 'Referencia2:',['id'=>'ref2l']) !!}
    {{--   {!! Form::label('ref2d', $personaDir->referencia2 ,['id'=>'ref2d']) !!} --}}
       <p>{!! $personaDir->referencia2 !!}</p> 
  </div>
  </td>
</tr>

<tr>
  <td>
  <!-- Observaciones Field -->
  <div class="form-group">
      {!! Form::label('observaciones', 'Observaciones:',['id'=>'obsl']) !!}
      {{-- {!! Form::label('obsd',$personaDir->observaciones,['id'=>'obsd']) !!} --}}
       <p>{!! $personaDir->observaciones !!}</p> 
  </div>
  </td>

  <td>
  <!-- Linkmapa Field -->
  <div class="form-group">
      {!! Form::label('linkmapa', 'Mapa:',['id'=>'lmapl']) !!}
  </div>
  <div>
    @if (is_null($personaDir->linkmapa) || $personaDir->linkmapa == "N/A" || $personaDir->linkmapa == "n/a")
      <a href="{!! env('Gmaps_Search2').$personaDir->dir !!}" class='btn btn-default btn-xs' target="_blank">
      Link a Mapa
      </a>    
    @else
      <a href="{!! $personaDir->linkmapa !!}" class='btn btn-default btn-xs' target="_blank">
      {!! $personaDir->linkmapa !!}
      </a>    
    @endif  

  </div>
  </td>
</tr>

</tbody>
</table>

<!-- Imagenmapa Field -->
<div>  
  @if (is_null($personaDir->imagenMapa) || $personaDir->imagenMapa == "N/A" || $personaDir->imagenMapa == "n/a")
     <img src="img/sinmapa.png" height="85" width="200" alt="imgsmap"/>
  @else
     <img src="{{ "box/imgmaps/".$personaDir->imagenMapa }}" 
     height="300" width="700" alt="imgmap"/>
  @endif 
</div>
<div>
  {{ $personaDir->imagenMapa }} 
</div>


        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2018 <a href="www.infocret.com">InfoCret</a>.</strong> All rights reserved.
        </footer>


</body>
</html>