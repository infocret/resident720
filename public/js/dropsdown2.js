$(document).ready(function(){
		$('#estado').change(function(){
			alert($(this).val());
			alert($('#estado option:selected').html());
			
			 $.get("{{ url('municipios')}}",
			 { option: $('#estado option:selected').html() },
			 function(data) {
			 	$('#municipio').empty();
			 	alert(data);
			 	$.each(data, function(key, element) {
			 		$('#proceso_id').append("<option value='" + key + "'>" + element + "</option>");
			 	});
			 });


		});
	});		