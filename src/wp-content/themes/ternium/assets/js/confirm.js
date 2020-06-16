(function ($) {
	$(document).ready(function () {
		$('input#cpf').mask('000.000.000-00', {reverse: true});

		/**
		 * Confirmar
		 */
		$('button#button-confirm').on('click', function (e) {
			e.preventDefault();

			if ($('.radio-dependente').length
					&& ($('.radio-dependente:checked').length != ($('.radio-dependente').length / 2)) ) {
				return swal.fire({
					title: 'Atenção',
					text: 'É necessário informar se os dependentes comparecerão ou não.',
					type: 'warning'
				});
			}

			if ( !$('[name=transporte]:checked').length ) {
				return swal.fire({
					title: 'Atenção',
					text: 'É necessário informar como pretende ir ao evento.',
					type: 'warning'
				});
			}

			var formData = {
				employee_id: $('#employee_id').val(),
				onibus: $("input[name='transporte']").val(),
				dependents_id: [],
				obs: $("textarea[name='observacoes']").val(),
				email: $("#observacoes_email").val(),
				telefone: $("#observacoes_telefone").val(),

				dependente_nome: $("#dependente_nome").val(),
				dependente_parentesco: $("#dependente_parentesco").val(),
				dependente_idade: $("#dependente_idade").val(),
			};

			$("[name^='vai_comparecer_']:checked").each(function(i){
				if ($(this).val() == '1') {
					formData.dependents_id.push($(this).data('dependent_id'));
				}
			})

			console.log(formData);

			$.ajax({
				method: 'POST',
				url: $('#wpurl').val() + 'employee/confirm',
				data: formData,
				beforeSend: function (xhr) {
					xhr.setRequestHeader( 'X-WP-Nonce', $('#nonce').val() );
				},
				success: function(data) {
					console.log(data);
					if (data.success) {
						swal.fire({
							title: 'Sucesso!',
							text: 'Sua presença foi confirmada!',
							type: 'success'
						}).then(function(){

							window.location.href = 'home';
						});
					}
				},
				error: function(data) {
					swal.fire({
						title: 'Erro',
						text: data.error || 'Ocorreu um erro ao tentar confirmar a participação! Por favor, tente novamente mais tarde.',
						type: 'error'
					});
				}
			});
		});
	});
})(jQuery);