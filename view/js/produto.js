$( document ).ready( function(){


	$('#enviarImagem').click( function(){

		$('input[name="file"]').click();

	});


	$('input[name="file"]').change( function(){

		$('#fildArquivo').find('p').remove();
		$('#fildArquivo').append('<p>' + $('input[name="file"]')[0].files[0].name + '</p>');

	});



});
