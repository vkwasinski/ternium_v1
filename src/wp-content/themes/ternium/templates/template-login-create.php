<?php
/**
 * Template Name: Criar Senha
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ternium</title>
	<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/vendor/bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/vendor/fancybox/jquery.fancybox.min.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/js/vendor/sweetalert2.min.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/css/auth.css">
</head>
<body>

	<div class="main-login">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-8 offset-md-2">

					<div class="row">
						<div class="col-12 col-md-12">
							<img class="login-logo" src="<?php echo bloginfo('template_url'); ?>/assets/img/logo_ternium.png" >
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-12" style="text-align: center;">
							<p>Para receber sua senha do sistema,<br />confirme os dados abaixo e clique no botão enviar:</p>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-8 offset-md-2">
							<div class="form-group">
								<label for="login">Login:</label>
								<input type="text" class="form-control" id="login" name="login" placeholder="Insira seu CPF ou passaporte (para estrangeiros)">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-8 offset-md-2">
							<div class="form-group">
								<label for="password">Insira seu 8-ID:</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Insira seu 8-ID">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-8 offset-md-2" style="text-align: center;">
							<button class="button-blue btn-full button-send-recovery">ENVIAR</button>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-8 offset-md-2">
							<p><a class="forgot" href="<?php echo get_permalink( get_page_by_path( 'login' ) )   ?>">&lt; VOLTAR</a></p>
						</div>
					</div>
					<br>
					<br>

					<div class="row">
						<div class="col-12 col-md-12" style="background: #e8e4e4;border-radius: 30px;">
							<p>Em caso de dúvidas ou dificuldades no acesso ao site, entre em contato através do e-mail <a href="mailto:encontroternium2019@diomkt.com">encontroternium2019@diomkt.com</a> informando o ocorrido, seu nome completo, CPF, 8-ID, e-mail e telefone para contato, que retornaremos em até 24h.</p>
							<p>*Horário de atendimento de 8h às 18h, de segunda à sexta. Mensagens enviadas fora do horário de atendimento e/ou aos finais de semana serão respondidas em 24h a contar das 8h do primeiro dia útil após o envio da mensagem.</p>
						</div>
					</div>
					<br>
					<br>
					<br>
					<br>
					<br>
				</div>
			</div>
		</div>
	</div>

	<div style="display: none; text-align: center;" id="password-modal">
		<input type="hidden" id="user-cpf" value="">
		<p style="text-transform: capitalize;"><strong id="user-name">Fulano</strong>, sua senha gerada é</p>
		<span id="user-passwd">IDDQD</span>
		<p>Anote sua senha ou fotografe esta tela para futuros acessos.</p>
		<button class="button-blue btn-full button-goto-login">FAZER LOGIN</button>
	</div>

	<a style="display: none;" id="password-modal-trigger" data-fancybox data-src="#password-modal" href="javascript:;">
	<input type="hidden" id="homelink" value="<?php echo get_permalink('home'); ?>">

	<input type="hidden" id="nonce" value="<?php echo wp_create_nonce( 'wp_rest' ); ?>">
	<input type="hidden" id="wpurl" value="<?php echo site_url('/wp-json/api/v1/'); ?>">

	<!-- scripts -->
	<script src="<?php echo bloginfo('template_url'); ?>/assets/vendor/jquery/jquery-3.4.1.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/vendor/fancybox/jquery.fancybox.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/js/vendor/sweetalert2.all.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/js/vendor/jquery.mask.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/js/auth.js"></script>
</body>
</html>