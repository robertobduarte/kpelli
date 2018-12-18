$( document ).ready( function(){

	$('tr[id*="pessoa_"]').click( function(){

		var id = $(this).attr('id');
		var pessoa_id = id.substr(id.indexOf('_')+1);

		window.location.href = 'pessoa.php?id='+pessoa_id;

	});


});
