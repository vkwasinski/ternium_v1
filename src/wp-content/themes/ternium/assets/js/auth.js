(function ($) {
	$(document).ready(function () {
		$('input#login').mask('000.000.000-00', {reverse: true});

		/**
		 * Recover
		 */
		$('button.button-send-recovery').on('click', function () {
			var login = $('input#login').val().replace(/\D+?/g,""),
				id_8  = $('input#password').val().replace(/\D+?/g,"");

			$.ajax({
				method: 'POST',
				url: $('#wpurl').val() + 'employee/signin',
				data: {
					cpf: login,
					id_8: id_8
				},
				beforeSend: function (xhr) {
					xhr.setRequestHeader( 'X-WP-Nonce', $('#nonce').val() );
				},
				success: function(data) {
					console.log(data);
					if (data.success) {
						var passwd = data.data.password,
							name   = data.data.name,
							cpf    = data.data.cpf;

						$('#password-modal #user-cpf').text(cpf);
						$('#password-modal #user-name').text(name);
						$('#password-modal #user-passwd').text(passwd);
						$('#password-modal-trigger').trigger('click');
					}
				},
				error: function(data) {
					swal.fire({
						title: 'Erro',
						text: data.error || 'Usuário não encontrado!',
						type: 'error'
					});
				}
			});
		});

		/**
		 * Login
		 */
		$('button.button-login').on('click', function () {
			var login  = $('input#login').val().replace(/\D+?/g,""),
				passwd = $('input#password').val();

			$.ajax({
				method: 'POST',
				url: $('#wpurl').val() + 'employee/login',
				data: {
					cpf: login,
					password: passwd
				},
				beforeSend: function (xhr) {
					xhr.setRequestHeader( 'X-WP-Nonce', $('#nonce').val() );
				},
				success: function(data) {
					if (data.success) {
						window.location.href = $('#homelink').val();
					}
				},
				error: function(data) {
					swal.fire({
						title: 'Erro',
						text: data.error || 'Usuário/senha não encontrados!',
						type: 'error'
					});
				}
			});
		});


		/**
		 * Login after Recovery
		 */
		$('button.button-goto-login').on('click', function () {
			window.location.href = 'home';
		});


		$('button.button-makepass').on('click', function () {
			window.location.href = $('#recoverlink').val();
		});

	});
})(jQuery);