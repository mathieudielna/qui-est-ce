function handleDeleteButtons (){
	$('a.del').confirm({
		title: 'Attention',
		content: 'Cette action sera définitive. Voulez vous vraiment supprimer cet élément ?',
		buttons: {
			supprimer: function () {
			   location.href = this.$target.attr('href');
			},
			annuler: function () {
				'Rester sur la page'
			}    
		}
	});
}
handleDeleteButtons();



		