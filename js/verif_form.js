$(function(){
	//alert($("body").css("height")) ;
	$("form#obligatoire").submit(function(event){

		if (!$("input:text").val() || !$("textarea").val() || !$("select").val() ){
			alert("Remplissez tous les champs");
			event.preventDefault();
		}
	} );
});

