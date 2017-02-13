$(function(){
    var $trigger = $('#code_postal');
    var $target = $('#commune');
    var value = $trigger.val();

    generate_communes_selector(value, $target);

    $trigger.change(function(){
        generate_communes_selector($(this).val(), $target);
    });

    function generate_communes_selector(value, $target)
    {
        var url = 'index.php?app=user&action=displayCommuneByCodePostal&id=';
        var errormsg = 'Code postal non valide';
        generate_selector(url, value, $target, errormsg);
    }

    /* genere un select html a partir d'un autre champ du formulaire */
    function generate_selector(url, value, $target, errormsg)
    {
        if (!!value) {
            $target.siblings('span').hide();
            $target.css('visibility', 'visible');
            $.ajaxSetup({async: false});
            $target.load(url + value);
            if ($target.children('option').length == 0) {
                alert(errormsg);
                $target.css('visibility', 'hidden');
                $target.siblings('span').show();
            }
        } else {
            $target.siblings('span').show();
            $target.css('visibility', 'hidden');
        }
    }
    /* date picker calendrier */
    var defaultDate = $('#date_embauche').val();
    $('.datepicker').datepick({dateFormat: 'dd/mm/yyyy', alignment: 'top', defaultDate: defaultDate});


    /* confirm suppression */
    var msg = 'Voulez-vous supprimer cette utilisateur?';
    $('.delete').on('click',{msg : msg}, function(e){
        var answer=confirm(msg);
        if(!answer){
            e.preventDefault();
        }
    });
});
$(function(){
	function readFile(input) {
		var files = input.files ? input.files : input.currentTarget.files
		if (files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$("img#preview").attr('src', e.target.result);
				$("img#preview").show();
			}
			if (reader.readAsDataURL) {reader.readAsDataURL(files[0]);}
			else if (reader.readAsDataurl) {reader.readAsDataurl(files[0]);}
		}
	}
	$("#image").change(function(){
		readFile(this);
	});
});

