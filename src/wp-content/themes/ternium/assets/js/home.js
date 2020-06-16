(function ($) {
	$(document).ready(function () {

		var accepted = sessionStorage.getItem('clicked');

		if (accepted !== null || accepted !== '') {
			$('#modal-legal-terms-trigger').trigger('click');
			sessionStorage.setItem('clicked', 1);
		}

		$('.button-register').on('click', function () {
			$.fancybox.close();
		});

	});
})(jQuery);