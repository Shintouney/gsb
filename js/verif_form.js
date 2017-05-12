$(function(){
	//alert($("body").css("height")) ;
	$("form#incident").submit(function(event){

		if (!$("input:text").val() || !$("textarea").val() || !$("select").val()){
			alert("remplissez les champs texte");
			event.preventDefault();
		}
		
	} );

});