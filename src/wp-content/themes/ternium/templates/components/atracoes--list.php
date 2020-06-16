<?php
$atracoes = [
	[
		'img'   => get_template_directory_uri() .'/assets/img/atracao_01.png',
		'title' => 'Vamos festejar com o Molejão?',
		'text'  => '<p>Um dos grupos mais extrovertidos do Brasil com hits como "Paparico" e "Brincadeira de Criança". Um show onde todo mundo participa e se diverte, inclusive o grupo de funcionários da Ternium <strong style="color: #b1b1b1;">Sambaço</strong>, que fará uma participação mais que especial.<br><strong>Não importa se você sabe sambar ou não, o importante é balançar o corpo e ser feliz com Molejão!</strong></p>'
	],
	[
		'img'   => get_template_directory_uri() .'/assets/img/atracao_02.png',
		'title' => 'DJ Rico',
		'text'  => '<p>DJ Rico ficou famoso por produzir as melhores festas à fantasia do Brasil, no Castelo Barão de Itaipava.</p>
			<p><strong>Rico também comandará com toda sua energia e sinergia a nossa atividade voltada exclusivamente para nossos adolescentes DJ POR UM DIA!</strong></p>'
	],
];
?>

<!-- ATRACOES :: BEGIN -->
<?php foreach ($atracoes as $atracao): ?>
	<div class="row row-subtitle">
		<div class="col-12 col-md-12 box-title">
			<h4><?php echo $atracao['title']; ?></h4>
			<hr />
		</div>
	</div>
	<div class="row row-content">
		<div class="col-12 col-md-8 offset-md-2">
			<img class="img-atividade" src="<?php echo $atracao['img']; ?>" >
		</div>
	</div>
	<div class="row row-content">
		<div class="col-12 col-md-8 offset-md-2" style="text-align: center;">
			<?php echo $atracao['text']; ?>
		</div>
	</div>
<?php endforeach; ?>
<!-- ATRACOES :: END -->