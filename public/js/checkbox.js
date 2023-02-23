$('#unmark').click(function (event)
{
    //alert("Hola Mundo");
    uncheck();
});

function uncheck(){
	var cf = document.getElementsByName('cat[]');
	for (i=0; i<cf.length; i++){
	if(cf[i].checked = true){
	cf[i].checked = false;
	}
	}
}

