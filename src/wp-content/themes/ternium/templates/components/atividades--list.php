<?php
$atividades = [
	['img'   => get_template_directory_uri() .'/assets/img/atividade_01.png'],
	['img'   => get_template_directory_uri() .'/assets/img/atividade_02.png'],
	['img'   => get_template_directory_uri() .'/assets/img/atividade_03.png'],
	['img'   => get_template_directory_uri() .'/assets/img/atividade_04.png'],
	['img'   => get_template_directory_uri() .'/assets/img/atividade_05.png'],
	['img'   => get_template_directory_uri() .'/assets/img/atividade_06.png'],
];
?>

<!-- ATIVIDADES :: BEGIN -->
<div class="row">
	<div class="col-12 col-md-6 offset-md-3">
		<p style="text-align: center;">Para o nosso encontro Ternium 2019 preparamos muita diversão e brincadeiras para todas as idades. E este ano, algo especial: atividades exclusivas para os adolescentes. Tudo para transformarmos o seu dia e o de sua família em um dia inesquecível.</p>

		<h4 style="text-align: center; text-transform: none;">Confira e participe!<br>Bom é ser feliz e festejar.</h4>
	</div>
</div>

<?php foreach ($atividades as $atividade): ?>
	<div class="row row-content">
		<div class="col-12 col-md-6 offset-md-3">
			<img src="<?php echo $atividade['img']; ?>">
		</div>
	</div>
<?php endforeach; ?>
<!-- ATIVIDADES :: END -->