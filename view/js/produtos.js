$( document ).ready( function(){

	$('tr[id*="produto_"]').click( function(){

		var id = $(this).attr('id');
		var pdt = id.substr(id.indexOf('_')+1);

		window.location.href = 'produto.php?pdt='+pdt;

	});


});
