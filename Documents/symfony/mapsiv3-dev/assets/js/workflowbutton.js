//Vérification des modifications du form pour affichage des boutons adéquates
	var $form = $('form'),origForm = $form.serialize();
	// Enable or disable button
	$('form :input').on('change input', function() {
		$('.change-message').toggle($form.serialize() !== origForm);
		$('.adisab').addClass('disabled');
	});

	// //Prevent leave if unsaved change
	// var isSubmitting = false
	// $('form').submit(function(){isSubmitting = true})
	// $('form').data('initial-state', $('form').serialize());
	// $(window).on('beforeunload', function() {
	// 	if (!isSubmitting && $('form').serialize() != $('form').data('initial-state')){
	// 	return 'Vous avez des modifications qui ne seront pas enregistrées si vous quittez cette page'
	// 	}
	// });