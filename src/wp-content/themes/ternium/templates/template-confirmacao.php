<?php

use Ternium\Plugin\Employee;
/**
 * Template Name: Confirmação
 */

hm_get_template_part('templates/components/header',[
	'css' => 'template-confirmacao.css',
]);


$employee  = Employee::byId($_SESSION['login']['employee']->info->id);

?>

<form action="">

<!-- home content -->
<div class="confirm-main-content">
	<div class="container">
		<!-- TITLE -->
		<div class="row row-title">
			<div class="col-12 col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>

		<!-- SEUS DADOS :: BEGIN -->
		<div class="row row-greeting">
			<div class="col-12 col-md-8 offset-md-2">
				<h2>Bem-vindo, <strong><?= $employee->info->nome ?></strong></h2>
				<h3>A sua festa será no dia <strong><?= $employee->info->data_festa ?> (<?= ((string) trim($employee->info->data_festa) == '7/12/2019')? 'sábado': 'domingo' ?>)</strong></h3>
			</div>

			<div class="col-12 col-md-8 offset-md-2 box-title">
				<h4>Seus dados</h4>
				<?php if (!$employee->info->confirmado): ?>
				<h5>Por favor, verifique e confirme seus dados abaixo:</h5>
				<?php endif; ?>

				<?php if ($employee->info->confirmado): ?>
				<h5>Seus dados já foram confirmados para a festa, caso haja divergência por favor entre em contato em <a href="mailto:encontroternium2019@diomkt.com">encontroternium2019@diomkt.com</a>.<h5>
				<?php endif; ?>

				<hr />
			</div>

			<!-- FORM :: BEGIN -->
			<div class="col-12 col-md-8 offset-md-2 box-title">
				<!-- <form action=""> -->
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="nome">Nome:</label>
								<input type="text" class="form-control" id="nome" name="nome" value="<?= $employee->info->nome; ?>" disabled
								 	style="text-transform: capitalize;"
								>
							</div>
						</div>

						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="cpf">CPF:</label>
								<input type="text" class="form-control" id="cpf" name="cpf" value="<?= $employee->info->cpf; ?>" disabled >
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="matricula">Matrícula:</label>
								<input type="text" class="form-control" id="matricula" name="matricula" value="<?= $employee->info->matricula ?>" disabled>
							</div>
						</div>

						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="codigo">8-ID:</label>
								<input type="text" class="form-control" id="codigo" name="codigo" value="<?= $employee->info->id_8 ?>" disabled>
							</div>
						</div>
					</div>
				<!-- </form> -->
			</div>
			<!-- FORM :: END -->
		</div>
		<!-- SEUS DADOS :: END -->


		<!-- DEPENDENTES :: BEGIN -->
		<div class="row row-guests">
			<div class="col-12 col-md-8 offset-md-2 box-title">
				<h4>Dados dos dependentes</h4>
				<?php if (!$employee->info->confirmado): ?>
				<h5>Por favor, verifique abaixo os dados de seus dependentes e, caso haja divergência nas informações, informe-as no campo Observações e Solicitações:</h5>
				<?php endif; ?>

				<?php if ($employee->info->confirmado): ?>
				<h5>Vocẽ já confirmou seus dependentes, caso haja divergência nas informações por favor entre em contato por <a href="mailto:encontroternium2019@diomkt.com">encontroternium2019@diomkt.com</a>.</h5>
				<?php endif; ?>

				<hr />
			</div>

			<!-- FORM :: BEGIN -->
			<div class="col-12 col-md-12 box-title">
				<input type="hidden" id="employee_id" value="<?php echo $employee->info->id; ?>">

				<?php if (!empty($employee->dependents)): ?>
					<?php foreach($employee->dependents as  $dependent): ?>
						<div class="row row-dependent">
							<input type="hidden" class="dependent_id" value="<?php echo $dependent->id; ?>">

							<div class="col-12 col-md-3">
								<div class="form-group">
									<label for="nome">Nome:</label>
									<input style="text-transform: capitalize;" type="text" class="form-control" id="nome" name="nome" value="<?= $dependent->nome ?>" disabled>
								</div>
							</div>

							<div class="col-12 col-md-3">
								<div class="form-group">
									<label for="parentesco">Parentesco:</label>
									<input type="text" class="form-control" id="parentesco" name="parentesco" value="<?= $dependent->parentesco ?>" disabled>
								</div>
							</div>

							<div class="col-12 col-md-3">
								<div class="form-group">
									<label for="idade">Idade:</label>
									<?php
										try {
											list($dia, $mes, $ano) = explode('/', $dependent->data_nascimento);
											$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
											$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
											$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
										} catch (\Throwable $th) {
											$idade = $dependent->data_nascimento;
										}
									?>
									<input type="text" class="form-control" id="idade" name="idade" value="<?= $idade ?>" disabled>
								</div>
							</div>

							<div class="col-12 col-md-3">
								<div class="form-group">
									<label for="vai_comparecer">Irá na festa:</label>
									<br>
									<div class="form-check form-check-inline">
										<input data-dependent_id="<?= $dependent->id ?>" class="form-check-input radio-dependente" type="radio" name="vai_comparecer_<?= $dependent->id; ?>" value="1"
											<?= (( trim($dependent->parentesco) == 'filho/a'  && $idade >= 21)? 'disabled': ''); ?>
											<?= (($employee->info->confirmado)? 'disabled': '') ?>
											<?= (($dependent->confirmacao)? 'checked': '') ?>
										/>
										<label class="form-check-label" for="vai_comparecer">Sim</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input radio-dependente" type="radio" name="vai_comparecer_<?= $dependent->id; ?>" value="0"
											<?= ((trim($dependent->parentesco) == 'filho/a' && $idade >= 21)? 'disabled': ''); ?>
											<?= (($employee->info->confirmado)? 'disabled': '') ?>
											<?= ((!$dependent->confirmacao)? 'checked': '') ?>
										/>
										<label class="form-check-label" for="vai_comparecer">Não</label>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="row row-dependent-new">
							<input type="hidden" class="dependent_id" value="<?php echo $dependent->id; ?>">

							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="nome">Nome:</label>
									<input type="text" class="form-control" id="dependente_nome" name="nome" value="<?= $employee->dependents[0]->nome ?>" <?php (($employee->info->confirmado)? 'disabled': '') ?>>
								</div>
							</div>

							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="parentesco">Parentesco:</label>
									<input type="text" class="form-control" id="dependente_parentesco" name="parentesco" value="<?= $employee->dependents[0]->parentesco ?>" <?php (($employee->info->confirmado)? 'disabled': '') ?>>
								</div>
							</div>

							<div class="col-12 col-md-4">
								<div class="form-group">
									<label for="idade">Idade:</label>
									<?php
										if (isset($employee->dependents[0])) {
											try {
												list($dia, $mes, $ano) = explode('/', $employee->dependent[0]->data_nascimento);
												$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
												$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
												$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
											} catch (\Throwable $th) {
												$idade = $employee->dependent[0]->data_nascimento;
											}
										}
									?>
									<input type="text" class="form-control" id="dependente_idade" name="idade" value="<?= $idade ?>" <?php (($employee->info->confirmado)? 'disabled': '') ?>>
								</div>
							</div>
						</div>
				<?php endif; ?>

				<div class="row">
					<div class="col-12 col-md-12">
						<p class="form-obs">*Todos os campos acima são de preenchimento obrigatório.</p>

						<p class="obs-title">Observações e Solicitações</p>
						<p class="obs-desc">Se houver alguma divergência nos dados dos seus dependentes, favor informar no campo abaixo.<br />As informações fornecidas serão analisadas e respondidas posteriormente.<br />Favor informar seu endereço de e-mail e número de celular para retorno.</p>
					</div>

					<div class="col-12 col-md-12">
						<div class="form-group">
							<textarea class="form-control" id="observacoes" name="observacoes" rows="3"
								<?= (($employee->info->confirmado)? 'disabled': '') ?>
							>
								<?= (isset($employee->info->obs))? $employee->info->telefone: ''; ?>
							</textarea>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-4 offset-md-2">
						<div class="form-group">
							<label for="observacoes_email">E-mail*:</label>
							<input type="text" class="form-control" id="observacoes_email" name="observacoes_email" placeholder=""
								value="<?= (isset($employee->info->telefone))? $employee->info->email: ''; ?>"
								<?= (($employee->info->confirmado)? 'disabled': '') ?>
							>
						</div>
					</div>

					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="observacoes_telefone">Telefone*:</label>
							<input type="text" class="form-control" id="observacoes_telefone" name="observacoes_telefone" placeholder=""
								value="<?= (isset($employee->info->telefone))? $employee->info->telefone: ''; ?>"
								<?= (($employee->info->confirmado)? 'disabled': '') ?>
							>
						</div>
					</div>
				</div>

				<div class="row">
					<p class="form-obs">*Obrigatório para quem preencheu o campo Observações e Solicitações.</p>
				</div>

			</div>
			<!-- FORM :: END -->
		</div>
		</div>
		<!-- DEPENDENTES :: END -->

		<!-- TRANSPORTE :: BEGIN -->
		<div class="row row-transport">
			<div class="col-12 col-md-6 offset-md-3 box-title">
				<h4>Transporte</h4>
				<hr />
			</div>

			<!-- FORM :: BEGIN -->
			<div class="col-12 col-md-6 offset-md-3">
				<div class="row row-transporte">
					<div class="col-12 col-md-4">
						<label for="transporte">Como pretende ir ao evento?*</label>
					</div>

					<div class="col-12 col-md-4">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="transporte" value="1"
								<?= (($employee->info->confirmado)? 'disabled': '') ?>
								<?= (($employee->info->onibus)? 'checked': '') ?>
							>
							<label class="form-check-label" for="onibus">Com o ônibus do evento</label>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="transporte" value="0"
								<?= (($employee->info->confirmado)? 'disabled': '') ?>
								<?= ((!$employee->info->onibus)? 'checked': '') ?>
							>
							<label class="form-check-label" for="transporte">Com veículo próprio</label>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-12">
						<p class="form-obs">*Campo acima de preenchimento obrigatório.</p>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-1">
						<img src="<?php echo bloginfo('template_url'); ?>/assets/img/icon_bus.png" >
					</div>
					<div class="col-12 col-md-11">
						<p>As linhas e pontos de embarque serão os mesmos utilizados diariamente, mas os horários serão ajustados para atender a festa. Caso tenha optado por usar o transporte coletivo da empresa, <strong>em breve divulgaremos os horários que serão adotados nas datas da festa. As informações serão enviadas por e-mail pela Ternium.</strong></p>
					</div>
				</div>

						<?php if (!$employee->info->confirmado): ?>
				<div class="row row-confirm">
					<div class="col-12 col-md-12">
						<p>Clicando no botão <strong>confirmar participação</strong> você estará automaticamente concordando com os <a id="modal-confirmation-trigger" data-fancybox data-src="#modal-confirmation" href="javascript:;">Termos da Participação</a>. Você também estará confirmando os dados de seus dependentes.</p>

						<p>* Para que todas as equipes participem do evento, a troca de turno será feita nos dias 04/12 e 08/12, sem o pagamento de hora extra.</p>
						<button class="button-blue" id="button-confirm">Confirmar Participação</button>
					</div>
				</div>
						<?php endif; ?>
				<br>
				<br>
				<br>
				<br>
			</div>
		</div>
		<!-- TRANSPORTE :: END -->
	</div>
</div>

</form>

<div style="display: none; text-align: center;" id="modal-confirmation">
	<h3><strong>Não perca tempo!</strong> Confirme sua presença e de seus confidados no Encontro Ternium 2019!</h3>

	<p style="margin-top: 3rem;"><strong>REGRAS DE CONFIRMAÇÃO DE PARTICIPAÇÃO:</strong></p>
	<p><strong>1. CONDIÇÕES</strong></p>
	<p>Ao acessar o sistema com seu CPF, a data de sua participação já estará definida. Pedimos para conferir seus dados e de seus acompanhantes antes de confirmar sua adesão à festa.</p>

	<p><strong>2. REGRAS DE PARTICIPAÇÃO</strong></p>
	<p>O prazo para adesão à festa via site será até 06/12/2019 até 14h.</p>
	<p>O site poderá ser acessado de qualquer computador com internet.</p>
	<p>Ao finalizar sua inscrição, não esqueça de fotografar ou imprimir sua confirmação e, ao finalizar, clique em "Sair".</p>
	<p>De 25/11 a 06/12/2019, as pulseiras-convite para funcionários e acompanhantes que se cadastraram via site serão entregues na Ternium (prédio de Treinamento, sala 01) por uma equipe do evento.</p>
	<p>Para retirada das pulseiras-convite, será necessário documento original com foto do funcionário.</p>
	<p>É primordial que o funcionário faça sua adesão ao evento com antecedência, para que retire sua pulseira com tranquilidade.</p>
	<p>Por tratar-se de um evento com a presença de menores de 18 anos, não teremos bebidas alcóolicas em nosso cardápio, assim como não será permitida a entrada das mesmas.</p>

	<p><strong>3. ATENÇÃO</strong></p>
	<p>As pulseiras deverá ser colocadas apenas no dia da festa. Pulseiras violadas antes do evento não serão trocadas.</p>
</div>

<?php hm_get_template_part('templates/components/footer', [
	'js' => 'confirm.js'
]); ?>