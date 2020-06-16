<?php
/**
 * Template Name: Home
 */

hm_get_template_part('templates/components/header', [
	'css' => 'template-home.css',
]);
?>

<!-- home content -->
<div class="home-main-content">
	<div class="container">
		<div class="row row-event-big">
			<div class="col-12 col-md-6 offset-md-3">
				<img class="event-big" src="<?php echo bloginfo('template_url'); ?>/assets/img/home_top_event.png" alt="">
			</div>
		</div>

		<div class="row row-event-sub">
			<div class="col-12 col-md-6 offset-md-3">
				<p><span>07</span> e <span>08</span> de Dezembro</p>
				<p>11 às 16h // Riocentro - Pavilhão 2</p>
			</div>
		</div>

		<div class="row row-confirmar">
			<div class="col-12 col-md-6 offset-md-3">
				<p>Para participar, é necessário a confirmação da sua presença no evento:</p>
				<button onclick="window.location.href = '<?= get_permalink( get_page_by_path( 'confirmacao' ) )   ?>'" class="button-blue">Inscreva-se</button>
			</div>
		</div>
	</div>
</div>

<div style="display: none; text-align: left;" id="modal-legal-terms">
	<h3><strong>Não perca tempo!</strong> Confirme sua presença e de seus convidados no Encontro Ternium 2019!</h3>

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
	<p>As pulseiras deverão ser colocadas apenas no dia da festa. Pulseiras violadas antes do evento não serão trocadas.</p>

	<button class="button-blue btn-full button-register" data-url="<?php echo get_permalink(get_page_by_path('confirmacao')); ?>">Concordo com as Regras</button>
</div>

<a style="display: none;" id="modal-legal-terms-trigger" data-fancybox data-src="#modal-legal-terms" href="javascript:;">

<?php hm_get_template_part('templates/components/footer', [
	'js' => 'home.js'
]); ?>