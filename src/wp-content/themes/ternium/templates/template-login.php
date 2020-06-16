<?php
/**
 * Template Name: Login
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
							<p>Para seu primeiro acesso ao site, insira seu CPF ou passaporte (apenas para estrangeiros que não possuam CPF) no campo solicitado e clique no botão criar senha. O sistema gerará, automaticamente, uma senha exclusiva para você. <strong>Guarde sua senha para acessos futuros.</strong></p>
							<p>Sempre digite seus dados em letras minúsculas, sem espaço e nunca em negrito.<br />Confira sua digitação no ícone visualização.</p>
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
								<label for="password">Senha:</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Insira sua senha">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-12" style="text-align: center;">
							<p>Esqueceu sua senha? <a class="forgot" href="<?php echo get_permalink( get_page_by_path( 'signin' ) )   ?>">Clique aqui</a></p>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-8 offset-md-2" style="text-align: center;">
							<button class="button-blue btn-full button-login">ENTRAR</button>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-8 offset-md-2" style="text-align: center;">
							<button class="button-white btn-full button-makepass">CRIAR SENHA</button>
						</div>
					</div>

					<br/>
					<br/>

					<div class="row">
						<div class="col-12 col-md-12" style="background: #e8e4e4;border-radius: 30px;">
							<p>Em caso de dúvidas ou dificuldades no acesso ao site, entre em contato através do e-mail <a href="mailto:encontroternium2019@diomkt.com">encontroternium2019@diomkt.com</a> informando o ocorrido, seu nome completo, CPF, 8-ID, e-mail e telefone para contato, que retornaremos em até 24h.</p>
							<p>*Horário de atendimento de 8h às 18h, de segunda à sexta. Mensagens enviadas fora do horário de atendimento e/ou aos finais de semana serão respondidas em 24h a contar das 8h do primeiro dia útil após o envio da mensagem.</p>
						</div>
					</div>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
				</div>
			</div>
		</div>
	</div>

	<input type="hidden" id="nonce" value="<?php echo wp_create_nonce( 'wp_rest' ); ?>">
	<input type="hidden" id="wpurl" value="<?php echo site_url('/wp-json/api/v1/'); ?>">
	<input type="hidden" id="homelink" value="<?php echo get_permalink( get_page_by_path( 'home' ) )   ?>">
	<input type="hidden" id="recoverlink" value="<?php echo get_permalink( get_page_by_path( 'signin' ) )   ?>">

	<!-- scripts -->
	<script src="<?php echo bloginfo('template_url'); ?>/assets/vendor/jquery/jquery-3.4.1.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/vendor/fancybox/jquery.fancybox.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/js/vendor/sweetalert2.all.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/js/vendor/jquery.mask.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/js/auth.js"></script>
</body>
</html>