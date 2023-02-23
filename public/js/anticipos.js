/*!
 * anticipos.js
 * Version: 1.0.0
 *
 * Copyright 2022 InfoCret - Julio Buendia 
 * 
 * Script que llena select de concept services 
 * a partir de la unidad 
 */


$("#unid_id").change(function(event){
      //alert (this.value);
      $unidid = this.value;

     $.get(rutax+"/anticipos/gconcepts/"+ $unidid,
      function(conceptos,response){      
      $('#conceptserv_id').empty();     // vaciar select 
      $('#conceptserv_id').append("<option selected='selected' value=''>Seleccione concepto</option>"); //agrega place holder o primer opcion
          $.each(conceptos, function( index, obj ) {
              $('#conceptserv_id').append
                ("<option value='"+obj.id+"'>"+obj.cve+" - "+obj.name+"</option>");
          });
      
      });
});


$("#conceptserv_id").change(function(event){
  $concept = $('#conceptserv_id option:selected').html();
  document.getElementById("desc").value = $concept ;
});

$("#montoini").change(function(event){
 document.getElementById("saldo").value = this.value;
});