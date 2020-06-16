<?php
/**
 * Template Name: Como Chegar
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
			<div class="col-12 col-md-8 offset-md-2">
				<h4>Venha para nossa festa!</h4>
				<h3>Estamos esperando por você!</h3>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-12">
				<img class="map-comochegar" src="<?php echo get_template_directory_uri() .'/assets/img/comochegar_mapa.png'; ?>" alt="">
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
</div>

<?php hm_get_template_part('templates/components/participe--confirm-form'); ?>
<?php hm_get_template_part('templates/components/footer'); ?>