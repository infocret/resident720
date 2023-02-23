/*!
 * dropsdownctas.js
 * Version: 1.0.0
 *
 * Copyright 2018 InfoCret - Julio Buendia 
 * 
 */

 $( document ).ready(function() {
    //console.log( "ready!" );
    if (action=='create') {    	

    };
    if (action=='edit' && bank!=0 ) {    	
		// $("#bank_id > option[value="+bank+"]").attr("selected",true);
		// $('#bank_id').trigger('change');
		//alert('bankid: '+bank);
		// Realiza consulta que llena el select de cuentas 
		// y deja seleccionado el correspondiente que llega en la variable [account]
		// desde la vista providers.edit
		$.get(rutax+"/baccnts/"+bank,
		function(accounts,response){		 	
		$('#bankaccount_id').empty();			// vaciar select 
		$('#bankaccount_id').append("<option  value=''>Seleccione Cuenta</option>"); //agrega place holder o primer opcion
				$.each(accounts, function( index, value ) {
				if (index == account){
					$('#bankaccount_id').append
  					("<option selected='selected' value='"+index+"'>"+value+"</option>");
				}
				else {	
  					$('#bankaccount_id').append
  					("<option value='"+index+"'>"+value+"</option>");
				}
			});					
		 	});
		// Realiza consulta que llena el select de chequeras 
		// y deja seleccionado el correspondiente que llega en la variable [checkbook]
		// desde la vista providers.edit
		 $.get(rutax+"/bchecks/"+account,
		 	function(accounts,response){		 	
		 	$('#checkbook_id').empty();			// vaciar select 
		 	$('#checkbook_id').append("<option selected='selected' value=''>Seleccione Chequera</option>"); //agrega place holder o primer opcion
		 		$.each(accounts, function( index, value ) {
		 		if (index == checkbook){
					$('#checkbook_id').append
  					("<option selected='selected' value='"+index+"'>"+value+"</option>");
				}	
				else{
  					$('#checkbook_id').append
  					("<option value='"+index+"'>"+value+"</option>");
  				}

					});			
		 	});

    	};
    //alert(action);
});

$("#bank_id").change(function(event){
	//alert("http://testc1.me/baccnts/"+document.getElementById("bank_id").value);  
	//alert(rutax);
		// $.get("http://testc1.me/baccnts/"+$('#bank_id option:selected').html()+"",
		 $.get(rutax+"/baccnts/"+document.getElementById("bank_id").value,
		 	function(accounts,response){		 	
		 	$('#bankaccount_id').empty();			// vaciar select 
		 	$('#bankaccount_id').append("<option selected='selected' value=''>Seleccione Cuenta</option>"); //agrega place holder o primer opcion
		 			$.each(accounts, function( index, value ) {
  						$('#bankaccount_id').append
  						("<option value='"+index+"'>"+value+"</option>");
					});			
				//var contvalue = document.getElementById("bank_id").value;		
			  	//alert("-"+contvalue+"-");
			  	//var contkey=$('#bank_id option:selected').html()+"";
		 	});
	$('#checkbook_id').empty();			// vaciar select de chequeras
	$('#checkbook_id').append("<option selected='selected' value=''>Seleccione Chequera</option>"); //agrega place holder o primer opcion
});

$("#bankaccount_id").change(function(event){
	//alert("http://testc1.me/bchecks/"+document.getElementById("bankaccount_id").value);  
	//alert(rutax);
		// $.get("http://testc1.me/baccnts/"+$('#bankaccount_id option:selected').html()+"",
		 $.get(rutax+"/bchecks/"+document.getElementById("bankaccount_id").value,
		 	function(accounts,response){		 	
		 	$('#checkbook_id').empty();			// vaciar select 
		 	$('#checkbook_id').append("<option selected='selected' value=''>Seleccione Chequera</option>"); //agrega place holder o primer opcion
		 	$('#checkbook_id').append("<option value='0'>Ninguna</option>");
		 			$.each(accounts, function( index, value ) {
  						$('#checkbook_id').append
  						("<option value='"+index+"'>"+value+"</option>");
					});			
		 	});
});

