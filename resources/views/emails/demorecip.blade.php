<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Adprocon - EdoCta</title>
    {{-- <link rel="stylesheet" 
     href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="{{ url('/').'/css/pdfrecip.css' }}" media="all" />  --}}

    <style type="text/css">

    html {
    margin: 0;
    }
    body {
    margin: 2mm 15mm 2mm 2mm;  /*este margen ajusta el diseño en el render de domPDF a tamaño carta*/
    }
    /*  *****************     Logotipo ******************* */
    #logo {
      text-align: center;
      margin-bottom: 10px;
    }

    #logo img {
      width: 150px;           /* Ancho del logotipo */
    }
    /* *******************   El titulo de "recibo" *********** */
    .titulo  {
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 15px;
      font-weight: bold;
      font-style: italic;
      color: #ffffff;
      text-align: center; 
      background: #DCDEE0;
      padding: 2px ;
    }
    /*  *****************   Condominio, Proveedor ******************* */
    .datpc{
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 12px; 
      font-style: italic; 
      color: #000000;
      text-align: center;   
      padding: 2px ;
    }
    /*  *****************  General para todas las tablas ******************* */
    table{
    width:106%;   /* Este ancho se ajusta a el diseño dom PDF tamaño carta */
    height:auto;
    border-collapse:collapse;
    text-align:center;
    }
    /* Este CSS asigna un color diferente a a cada fila [tr] 
    de la tabla puede invertir el orden con even en lugar de odd*/
    tr:nth-child(odd) {  
      background-color: #f2f2f2;
    }
    /*  *****************  Diseño para las cabeceras ******************* */
    th.tit1 {
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 13px;
      font-weight: bold;
      color: #000000;
      text-align: center; 
      background: #DCDEE0;
      padding: 4px 10px;
      border: 2px solid white;
    }
    /*  *****************  Diseño para los Datos ******************* */
    td.dat1 {
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 12px;
      color: #000000;
      text-align: center;   
      padding: 4px 10px; 
    }
    /*  *****************  Diseño para las cabeceras de la tabla detalle ******************* */
    th.tit2 {
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 11px;
      font-weight: bold;
      color: #000000;
      text-align: center; 
      background: #DCDEE0;
      padding: 4px 10px;
      border: 2px solid white;
    }
    /*  *****************  Diseño para los Datos de detalle******************* */
    td.dat2l {
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 10px;
      color: #000000;
      text-align: left;   
      padding: 4px 10px;   
      /*border: 1px solid black;*/
      border-bottom: 1px solid black;
    }

    td.dat2c {
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 10px;
      color: #000000;
      text-align: center;   
      padding: 4px 10px;   
      /*border: 1px solid black;*/
      border-bottom: 1px solid black;
    }

    td.dat2r {
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 10px;
      color: #000000;
      text-align: right;   
      padding: 4px 10px;   
      /*border: 1px solid black;*/
      border-bottom: 1px solid black;
    }
    /*  ***************** Folio ******************* */
    td.dat3 {
      font-family: Tahoma, Geneva, sans-serif;
      font-size: 10px;
      font-style: italic;
      color: #000000;
      text-align: center;   
      padding: 4px 10px;     
    }

    </style>

  </head>


  <body>
    <header> 
      <table> {{--  *****************     Logo condominio proveedor ******************* --}}
        
        <tr>
          <td id="logo" rowspan="4">        
          {{--  <img src="{{ url('/').'/img/adplogo_200h.png' }}"> --}}

          <img src="data:image/png;base64,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" alt="FolioBbarCode"   />

          </td>
        </tr>

        <tr>
          <td class="titulo">
           Estado de Cuenta
          </td>
        </tr>
        
        <tr>
          <td class="datpc">        
             Condominio Vista al SOL
          </td>
        </tr>

        <tr>
          <td class="datpc">
             ADP Adprocom S.A de C.V.         
          </td>
        </tr>

       </table>
    </header>

    <main>

    <table> {{--  *****************     Unidad, Propietario ******************* --}}
    <thead>
        <tr>
            <th class="tit1">
                Unidad
            </th>
            <th class="tit1">
                Propietario
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="dat1">
                cve 101 departamento 101 
            </td>
            <td class="dat1">
               Homero Simpsom Ruiz
            </td>
        </tr>   
    </tbody>
    </table>

    <table>{{--  *****************     Unidad, Propietario ******************* --}}
        <thead>
        <tr>
            <th class="tit1">
                Area
            </th>
            <th class="tit1">
               Folio
            </th>
            <th class="tit1">
               Movto Id
            </th> 
            <th class="tit1">
               Movto Tipo
            </th>       
            <th class="tit1">
               Fecha Aplicación
            </th>                   
        </tr>
        </thead>

        <tbody>
        <tr>
            <td class="dat1">
               Administración
            </td>
            <td class="dat1">
               123456789012345678
            </td>
            <td class="dat1">
              1
            </td>
            <td class="dat1">
                I
            </td>
            <td class="dat1">
               29/01/2019
            </td>            
        </tr>   
        </tbody>
    </table>


    <div style="clear:both; margin:10px" > </div> {{-- Separador --}}

    <table>         {{--  *****************  Detalles ******************* --}}

    <thead>
        <tr>
        <th class="tit2">Cant.</th>
        <th class="tit2">U.</th>
        <th class="tit2">Cve</th>
        <th class="tit2">Mov</th>
        <th class="tit2">Desc.</th>
        <th class="tit2">P.Unit.</th>    
        <th class="tit2">Subt.</th>
        </tr>
    </thead>

    <tbody>
   {{--  @foreach($details as $detail) --}}

        <tr>
        <td class="dat2c">1</td>
        <td class="dat2l">{serv</td>
        <td class="dat2c">401</td>
        <td class="dat2l">Administratcion</td>
        <td class="dat2l">Cuota administración</td>
        <td class="dat2r">{{ '$ '.number_format(2578, 2, '.', ',') }}</td>    
        <td class="dat2r">{{ '$ '.number_format(2478, 2, '.', ',') }}</td>
        </tr>

	{{-- @endforeach --}}
    </tbody>

    </table>

    <div style="clear:both; margin:10px" > </div> {{-- Separador --}}

    <table>   {{--  *****************     Estatus, Subtotal, IVA, Total ******************* --}}

        <thead>
        <tr>
            <th class="tit1">
                Estatus
            </th>
            <th class="tit1">
               Subtotal
            </th>
            <th class="tit1">
               I.V.A.
            </th> 
            <th class="tit1">
               Total
            </th>                        
        </tr>
        </thead>
        
        <tbody>
        <tr>
            <td class="dat1">
              GENERADO
            </td>
            <td class="dat1">
              {{ '$ '.number_format(2578, 2, '.', ',') }}
            </td>
            <td class="dat1">
               {{ '$ '.number_format(0, 2, '.', ',') }}
            </td>
            <td class="dat1" style="font-weight: bold;">
                {{ '$ '.number_format(2578, 2, '.', ',') }}
            </td>           
        </tr>   
    </tbody>

    </table>

    <table> {{--  ***************** Folio - Codigo de Barras  ******************* --}}
    
    <div style="clear:both; margin:10px" > </div> {{-- Separador --}}

    <tr>
        <td>
        	123456789012345678
        </td>
    </tr>
    <tr>
        <td class="dat3">123456789012345678</td>
    </tr>

    </table>

    </main>

    <footer>   
    <p class="datpc"> Recuerde realizar su pago dentro de los 10 primeros dias del mes.</p>  
    </footer>

  </body>
</html>




