/*!
 * dropdown.js
 * Version: 1.0.0
 *
 * Copyright 2018 InfoCret - Julio Buendia 
 * 
 */
 //$(document).ready(function(){
 	//$('#municipio').hide();
 	// $("#continente").val('1')
 //};
 //
 //
 $( document ).ready(function() {
    //console.log( "ready!" );
      	
    	document.getElementById("agregarch").checked = false;
    	document.getElementById("lshortname").style.display = "none";		
		document.getElementById("shortname").style.display = "none";	
		document.getElementById("lfullname").style.display = "none";	
		document.getElementById("fullname").style.display = "none";	
		document.getElementById("ldescriptionch").style.display = "none";	
		document.getElementById("descriptionch").style.display = "none";	
		document.getElementById("lstart").style.display = "none";	
		document.getElementById("start").style.display = "none";	
		document.getElementById("lend").style.display = "none";	
		document.getElementById("end").style.display = "none";							
    

    if (action=='edit') {  
    	document.getElementById("agregarch").style.display = "none";	
    	document.getElementById("lagregarch").style.display = "none";	
    }
    //alert(action);
});

$('#agregarch').on('change',function(){
	if ( $(this).is(':checked')){
	document.getElementById("lshortname").style.display = "block";		
	document.getElementById("shortname").style.display  = "block";
	document.getElementById("lfullname").style.display = "block";	
	document.getElementById("fullname").style.display = "block";	
	document.getElementById("ldescriptionch").style.display = "block";	
	document.getElementById("descriptionch").style.display = "block";	
	document.getElementById("lstart").style.display = "block";	
	document.getElementById("start").style.display = "block";	
	document.getElementById("lend").style.display = "block";	
	document.getElementById("end").style.display = "block";

	}
	else{
		document.getElementById("lshortname").style.display = "none";		
		document.getElementById("shortname").style.display = "none";	
		document.getElementById("lfullname").style.display = "none";	
		document.getElementById("fullname").style.display = "none";	
		document.getElementById("ldescriptionch").style.display = "none";	
		document.getElementById("descriptionch").style.display = "none";	
		document.getElementById("lstart").style.display = "none";	
		document.getElementById("start").style.display = "none";	
		document.getElementById("lend").style.display = "none";	
		document.getElementById("end").style.display = "none";		
	}


});

