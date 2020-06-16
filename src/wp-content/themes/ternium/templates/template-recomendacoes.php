<?php
/**
 * Template Name: Recomendações
 */

hm_get_template_part('templates/components/header',[
	'css' => 'template-comochegar.css',
]);
?>

<!-- home content -->
<div class="comochegar-main-content">
	<div class="container">
		<!-- TITLE -->
		<div class="row row-title">
			<div class="col-12 col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="row row-content">
			<div class="col-12 col-md-12">
				<h4 style="font-weight: 200;">Vestuário</h4>
				<hr />
				<div class="row">
					<div class="col-md-2 offset-md-2">
						<img src="<?php echo get_template_directory_uri() .'/assets/img/rec_01.png'; ?>">
					</div>
					<div class="col-md-8">
						<p>Use roupas leves e cômodas. É proibida a entrada de pessoas (adultos ou crianças) sem camisa, de chinelo ou em trajes de banho.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row row-content">
			<div class="col-12 col-md-12">
				<h4 style="font-weight: 200;">Acessórios</h4>
				<hr />
				<div class="row">
					<div class="col-md-2 offset-md-2">
						<img src="<?php echo get_template_directory_uri() .'/assets/img/rec_02.png'; ?>">
					</div>
					<div class="col-md-8">
						<p>Haverá um guarda volumes onde você poderá deixar pertences que não queira carregar durante o evento.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row row-content">
			<div class="col-12 col-md-12">
				<h4 style="font-weight: 200;">Bebidas</h4>
				<hr />
				<div class="row">
					<div class="col-md-2 offset-md-2">
						<img src="<?php echo get_template_directory_uri() .'/assets/img/rec_03.png'; ?>">
					</div>
					<div class="col-md-8">
						<p>É expressamente proibida a entrada com bebidas alcoólicas.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row row-content">
			<div class="col-12 col-md-12">
				<h4 style="font-weight: 200;">Segurança</h4>
				<hr />
				<div class="row">
					<div class="col-md-2 offset-md-2">
						<img src="<?php echo get_template_directory_uri() .'/assets/img/rec_04.png'; ?>">
					</div>
					<div class="col-md-8">
						<p>O cuidado com as crianças é responsabilidade exclusiva dos pais e/ou responsáveis. O local da festa contará com posto médico, banheiros, fraldário e área para mães com crianças pequenas. Respeite as normas de segurança. O evento vai acontecer em um pavilhão fechado. Siga rigorosamente as orientações do local e circule somente pelas áreas comuns da festa. Evite acidentes e incidentes.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row row-content">
			<div class="col-12 col-md-12">
				<h4 style="font-weight: 200;">Limpeza</h4>
				<hr />
				<div class="row">
					<div class="col-md-2 offset-md-2">
						<img src="<?php echo get_template_directory_uri() .'/assets/img/rec_05.png'; ?>">
					</div>
					<div class="col-md-8">
						<p>Cuidar do espaço da festa é responsabilidade de todos. Jogue o lixo nas lixeiras e nos recipientes para reciclagem de copos e garrafas.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row row-content">
			<div class="col-12 col-md-12">
				<h4 style="font-weight: 200;">Estacionamento</h4>
				<hr />
				<div class="row">
					<div class="col-md-2 offset-md-2">
						<img src="<?php echo get_template_directory_uri() .'/assets/img/rec_06.png'; ?>">
					</div>
					<div class="col-md-8">
						<p>O local contará com estacionamento e a Ternium arcará com o custo. Para receber a gratuidade, é necessário que o motorista troque o ticket de entrada de estacionamento por um abono de gratuidade. Essa troca será realizada em local específico sinalizado na festa.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row row-content">
			<div class="col-12 col-md-12">
				<h4 style="font-weight: 200;">Ingresso</h4>
				<hr />
				<div class="row">
					<div class="col-md-2 offset-md-2">
						<img src="<?php echo get_template_directory_uri() .'/assets/img/rec_07.png'; ?>">
					</div>
					<div class="col-md-8">
						<p><strong>A pulseira-convite será distribuída entre os dias de 25 de novembro a 06 de dezembro, na Ternium (prédio de Treinamento, sala 01), das 8h às 17h.</strong> Cada funcionário tem direito de levar seu cônjuge e dependentes cadastrados no plano de saúde até 21 anos. Funcionários sem dependentes podem levar um (1) convidado.</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<?php hm_get_template_part('templates/components/participe--confirm-form'); ?>
<?php hm_get_template_part('templates/components/footer'); ?>