<?php
/**
 * Template Name: Atrações
 */

hm_get_template_part('templates/components/header',[
	'css' => 'template-atracoes.css',
]);
?>

<!-- home content -->
<div class="atractions-main-content">
	<div class="container">
		<!-- TITLE -->
		<div class="row row-title">
			<div class="col-12 col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>

		<?php hm_get_template_part('templates/components/atracoes--list'); ?>
	</div>
</div>

<?php hm_get_template_part('templates/components/participe--confirm-form'); ?>
<?php hm_get_template_part('templates/components/footer'); ?>