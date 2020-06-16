<?php
/**
 * Template Name: Info Logísticas
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
				<h4 style="font-weight: 200;">Veículo<br />Próprio</h4>
				<hr />
				<div class="row">
					<div class="col-md-2 offset-md-2">
						<img src="<?php echo get_template_directory_uri() .'/assets/img/icon_carro.png'; ?>">
					</div>
					<div class="col-md-8">
						<p>O local contará com estacionamento e a Ternium arcará com o custo. Para receber a gratuidade, é necessário que o motorista troque o ticket de entrada de estacionamento por um abono de gratuidade. Essa troca será realizada em local específico sinalizado na festa.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-12">
				<img class="map-comochegar" src="<?php echo get_template_directory_uri() .'/assets/img/comochegar_mapa.png'; ?>" >
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-6 offset-md-3">
				<p style="text-align: center; margin-top: 1rem;">
					<img src="<?php echo get_template_directory_uri() .'/assets/img/pointer.png'; ?>" >
					Av. Salvador Allende, 6555 - Barra da Tijuca, Rio de Janeiro - RJ, 22783-127
				</p>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row row-content">
			<div class="col-12 col-md-12">
				<h4 style="font-weight: 200;">Transporte<br />Coletivo</h4>
				<hr />
				<div class="row">
					<div class="col-md-2 offset-md-2">
						<img src="<?php echo get_template_directory_uri() .'/assets/img/icon_onibus.png'; ?>">
					</div>
					<div class="col-md-8">
						<p><strong>Terá transporte no dia? Sim.</strong> As linhas e pontos de embarque serão os mesmos utilizados diariamente, mas os horários serão ajustados para atender a festa.</p>
						<p>Em sua inscrição você informou sua opção de transporte. Caso tenha optado por usar o transporte coletivo da empresa, <strong>em breve divulgaremos os horários que serão adotados nas datas da festa. As informações serão enviadas por e-mail pela Ternium.</strong></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php hm_get_template_part('templates/components/participe--confirm-form'); ?>
<?php hm_get_template_part('templates/components/footer'); ?>